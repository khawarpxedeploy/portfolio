<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Order;
use App\Models\Post;
use App\Models\Tenant;
use App\Models\Category;
use App\Models\User;
use App\Models\Useroption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Session;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
       
        $tenant_data = Tenant::with('orderwithplan')->where('user_id', Auth::id())->first();

        $name         = $tenant_data->orderwithplan->plan->name ?? '';

        return view('user.dashboard', compact('tenant_data','name'));
    }

    public function qrcodeChange(Request $request)
    {
        if($request->qrcode_id)
        {
            $domain = Domain::find($request->qrcode_id);
            if(!$domain)
            {
                $tenant_id = Tenant::where('user_id',Auth::User()->id)->first();
               return  QrCode::size(300)->generate(env('APP_URL_WITH_TENANT').$tenant_id->id);
            }
            return QrCode::size(300)->generate(env('APP_PROTOCOL').$domain->domain);
        }

        if($request->vcard_id)
        {
            
            $domain = Domain::where('domain',$request->vcard_id)->first();
            if($domain)
            {
                return QrCode::size(300)->generate(env('APP_PROTOCOL').$domain->domain.'/vcard');
            }else{
                return QrCode::size(300)->generate($request->vcard_id);
            }

        }
    }

    public function move_file($path, $to)
    {
        if (copy($path, $to)) {
            unlink($path);
            return true;
        } else {
            return false;
        }
    }

    public function qrDownload()
    {
        $path = 'uploads/' . Auth::id() . '/qrmenu/domain_qrcode.png';
        if (file_exists($path)) {
            // return 'hi';
            return response()->download($path);
        } else {
            $msg['errors']['error'] = "Error Occurred!";
        }
    }
    public function vcardDownload()
    {
        $vcardpath = 'uploads/' . Auth::id() . '/qrmenu/vcard_qrcode.png';
        return response()->download($vcardpath);
    }

    public function stats()
    {
        $useroption       = Useroption::where([['user_id', Auth::id()], ['key', 'vcard']])->first() ?? '';
        $useroptiondata   = $useroption ? json_decode($useroption->value) : '';
        $data['blogs']    = Post::with('thum_image')->where([['type', 'blog'], ['user_id', Auth::id()]])->latest()->limit(5)->get();
        $data['projects'] = Post::with('link')->where([['type', 'project'], ['user_id', Auth::id()]])->latest()->limit(10)->get();
        $tenant   = Tenant::where('user_id', Auth::id())->firstOrFail();
        $name             = $tenant->name;
      
        $data['totalProject']    = count($data['projects']) ?? 0;
        $data['totalBlog']       = count($data['blogs']) ?? 0;
        $data['portolioTheme']   = $tenant->theme ? ucwords(basename($tenant->theme)) : '';
        $data['vcardTheme']      = $useroptiondata ? ucwords(basename($useroptiondata->theme)) : '';
        $data['themeScreenshot'] = url($tenant->theme ?? '' . "/screenshot.png");
        $data['vcardScreenshot'] = $useroptiondata ? url($useroptiondata->theme . "/screenshot.png") : '';
        $data['storageUsed']     = number_format(folderSize('uploads/' . Auth::id()), 2).' -- '.number_format($data['tenant']->storage_size ?? 00,2).'MB';
        $posts = Post::where('user_id', Auth::id())->count()+Category::where('user_id', Auth::id())->count();
        $data['total_posts']=$posts.' -- '.$tenant->postlimit; 
        return response()->json($data);
    }
}
