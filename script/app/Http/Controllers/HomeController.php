<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Plan;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Useroption;
use Illuminate\Http\Request;
use Newsletter;
use App\Models\Term;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         if (filter_protocol(url('/')) == env('APP_PROTOCOLESS_URL')) {
            \Config::set('cache.default','array');
            $seo=get_option('seo_home');

            JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
            JsonLdMulti::setDescription($seo->matadescription ?? null);
            JsonLdMulti::addImage(asset('uploads/logo.png'));

            SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
            SEOMeta::setDescription($seo->matadescription ?? null);
            SEOMeta::addKeyword($seo->tags ?? null);

            SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
            SEOTools::setDescription($seo->matadescription ?? null);
            SEOTools::setCanonical(url('/'));
            SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
            SEOTools::opengraph()->addProperty('image', asset('uploads/logo.png'));
            SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
            SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
            SEOTools::jsonLd()->addImage(asset('uploads/logo.png'));
            return view('main.welcome');
         }

         abort_if(!planData('portfolio_builder'),403);
         $option=$this->useroption();
         $info=json_decode($option->value ?? '');

         $tags='';

         foreach ($info->tagline ?? [] as $key => $value) {
            $tags .= $value.', ';
        }

        

        JsonLdMulti::setTitle($info->full_name ?? env('APP_NAME'),false);
        JsonLdMulti::setDescription($info->about_description ?? null,false);
        JsonLdMulti::addImage(asset($info->about_img ?? ''));

        SEOMeta::setTitle($info->full_name ?? env('APP_NAME'),false);
        SEOMeta::setDescription($info->about_description ?? null);
        SEOMeta::addKeyword($tags ?? null);

        SEOTools::setTitle($info->full_name ?? env('APP_NAME'),false);
        SEOTools::setDescription($info->about_description ?? null);

        SEOTools::opengraph()->addProperty('keywords', $tags ?? null);
        SEOTools::opengraph()->addProperty('image', asset($info->about_img ?? ''));
        
        SEOTools::jsonLd()->addImage(asset($info->about_img ?? ''));
        return view(baseview() . '.index',compact('info'));
        
    }

    public function pricing()
    {
        $seo=get_option('seo_pricing');

        JsonLdMulti::setTitle($seo->site_name ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset('uploads/logo.png'));

        SEOMeta::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
        SEOTools::setCanonical(url('/'));
        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset('uploads/logo.png'));
        SEOTools::twitter()->setTitle($seo->site_name ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset('uploads/logo.png'));

        $symbol=get_option('currency_symbol');
         $posts=Plan::where([['status', 1], ['is_default', 0]])->orderby('price','ASC')->get();
        return view('main.pricing',compact('posts','symbol'));
    }


    public function vcard(){

        abort_if(!planData('vcard'),403);
        $user_id = tenant('user_id');
        $data = User::with('vcard')->whereHas('vcard')->findOrFail($user_id);
        $data = json_decode($data->vcard->value) ?? '';
        return view(str_replace('/','.', $data->theme).'.index' , compact('data'));
    }

    public function cv(){
        abort_if(!planData('resume_builder'),403);
        $user_id = tenant('user_id');
        $user = User::with('cv')->whereHas('cv')->findOrFail($user_id);
        $data = json_decode($user->cv->value) ?? '';
        abort_if(!$data->theme,401);
        $view = str_replace("/",".", $data->theme).'.index';
        return view( $view , compact('data','user'));
    }

    /**
     * information method using for send data to root_frontend welcome page
     *
     * @return void
     */
    public function information()
    {
        $theme         = Option::where('key', 'theme_settings')->first();
        $data['basic'] = json_decode($theme->value);
        $data['benefit'] = Option::where('key', 'benefit')->orderby('id','DESC')->get()->map(function ($q) {
            $value           = json_decode($q->value);
            $data['img']     = asset($value->image);
            $data['excerpt'] = $value->excerpt;
            $data['title']   = $value->title;
            return $data;
        });
        
        $data['plans'] = Plan::where([['status', 1], ['is_default', 0],['is_featured',1]])->orderby('price','ASC')->take(4)->latest()->get()->map(function ($q) {
            $symbol= Option::where('key','currency_symbol')->first()->value;

            $data['name']                = $q->name;
            $data['symbol']                = $symbol;
            $data['price']               = number_format($q->price, 2);
            $data['duration']            = ($q->duration == 30) ? 'Monthly' : (($q->duration == 365) ? 'Yearly' : $q->duration . 'Days');
            $data['resume_builder']      = $q->resume_builder;
            $data['portfolio_builder']   = $q->portfolio_builder;
            $data['custom_domain']       = $q->custom_domain;
            $data['sub_domain']          = $q->sub_domain;
            $data['post_limit']          = $q->post_limit;
            $data['online_businesscard'] = $q->online_businesscard;
            $data['qrcode']              = $q->qrcode;
           
            $data['post_limit']           = $q->postlimit;
            $data['storage_size']           = $q->storage_size;
            $data['online_cv']           = $q->online_cv;
            $data['rotue']               = url('');
            return $data;
        });

        $data['template_image'] = Term::where('type', 'portfolio_template')->latest()->get()->map(function ($q) {
            $data['link'] = $q->slug;
            $data['img']  = asset($q->title);
            return $data;
        });

        $data['company'] = Option::where('key', 'company')->get()->map(function ($q) {
            $value        = json_decode($q->value);
            $data['link'] = $value->link;
            $data['img']  = asset($value->image);
            return $data;

        });
        $data['blogs']=Term::where('type', 'blog')->where('status',1)->with('excerpt','thum_image','user')->latest()->take(3)->get()->map(function($q){
            $info['title']=$q->title;
            $info['date']=$q->created_at->format('d F, Y');
            $info['image']=asset($q->thum_image->value ?? '');
            $info['url']=url('/blog',$q->slug);
            $info['excerpt']=$q->excerpt->value ?? '';
          
            return $info;
        });

        return response()->json($data);

    }

    /**
     * subscribe method using for News letter subscription  in root frontend
     *
     * @param  mixed $request
     * @return void
     */
    public function subscribe(Request $request)
    {
        if (!Newsletter::isSubscribed($request->email)) {
            Newsletter::subscribe($request->email);
        } else {
            return response()->json('Already Subscribed');
        }
        return response()->json('Subscribe Successful');
    }

    public function useroption()
    {
        return Useroption::where('user_id', tenant('user_id'))->where('key', 'site_settings')->first();
    }

}
