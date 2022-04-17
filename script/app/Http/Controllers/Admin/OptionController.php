<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSCORequest;
use App\Http\Requests\AdminThemeSettingsRequest;
use App\Models\Option;
use File;
use Illuminate\Http\Request;
use Cache;
class OptionController extends Controller
{
    public function configDns()
    {
        abort_if(!Auth()->user()->can('config_dns'), 401);
        $config_dns = Option::where('key', 'config_dns')->first();
       
        return view('admin.option.config_dns', compact('config_dns'));
    }

    public function configDnsUpdate(Request $request, $id)
    {
        
        
        $data = [
            'title'  => $request->title,
            'footer' => $request->footer,
           
        ];

        $config_dns_obj        = Option::findOrFail($id);
        $config_dns_obj->key   = 'config_dns';
        $config_dns_obj->value = json_encode($data);
        $config_dns_obj->save();
        return response()->json('DNS Instruction Updated!!');
    }

    public function seoIndex()
    {
        abort_if(!Auth()->user()->can('option.seo-index'), 401);
        $data = Option::where('key', 'seo_home')->orWhere('key', "seo_blog")->orWhere('key', "seo_service")->orWhere('key', "seo_contract")->orWhere('key', "seo_pricing")->get();
        return view('admin.option.seo_index', compact('data'));
    }

    public function seoEdit($id)
    {
        abort_if(!Auth()->user()->can('option.seo-edit'), 401);
        $data = Option::where('id', $id)->first();
        return view('admin.option.seo_edit', compact('data'));
    }

    public function otherOption()
    {
        // abort_if(!Auth()->user()->can('option.seo-edit'), 401);
        $tax         = Option::where('key', 'tax')->first();
        $curency_name = Option::where('key', 'curency_name')->first();
        $currency_symbol = Option::where('key', 'currency_symbol')->first();
        $invoice_prefix = Option::where('key', 'invoice_prefix')->first();
        $invoice_mail_messages = Option::where('key', 'invoice_mail_messages')->first();

        
        
        
        
        return view('admin.option.other', compact('tax', 'curency_name','currency_symbol','invoice_prefix','invoice_mail_messages'));
    }

    public function otherUpdate(Request $request)
    {
        $request->validate([
            'tax'         => 'required',
           
        ]);

        $tax        = Option::where('key', 'tax')->firstOrNew();
        $tax->value = $request->tax;
        $tax->key   = 'tax';
        $tax->save();

        $curency_name        = Option::where('key', 'curency_name')->firstOrNew();
        $curency_name->value = $request->curency_name;
        $curency_name->key   = 'curency_name';
        $curency_name->save();

        $currency_symbol        = Option::where('key', 'currency_symbol')->firstOrNew();
        $currency_symbol->value = $request->currency_symbol;
        $currency_symbol->key   = 'currency_symbol';
        $currency_symbol->save();

        $invoice_prefix        = Option::where('key', 'invoice_prefix')->firstOrNew();
        $invoice_prefix->value = $request->invoice_prefix;
        $invoice_prefix->key   = 'invoice_prefix';
        $invoice_prefix->save();

        $invoice_mail_messages        = Option::where('key', 'invoice_mail_messages')->firstOrNew();
        $invoice_mail_messages->value = $request->invoice_mail_messages;
        $invoice_mail_messages->key   = 'invoice_mail_messages';
        $invoice_mail_messages->save();

        

        return response()->json('Successfully Updated');
    }
    public function seoUpdate(AdminSCORequest $request, $id)
    {
        $option = Option::where('id', $id)->first();

        $data = [
            "site_name"          => $request->site_name,
            "matatag"            => $request->matatag,
            "twitter_site_title" => $request->twitter_site_title,
            "matadescription"    => $request->matadescription,
        ];

        $value         = json_encode($data);
        $option->value = $value;
        $option->save();
        return response()->json('Successfully Updated');
    }

    public function settingsEdit()
    {
        abort_if(!Auth()->user()->can('theme-settings'), 401);
        $theme = Option::where('key', 'theme_settings')->first();
        $basic = Option::where('key', 'basic_settings')->first();
        $basic_settings=json_decode($basic->value ?? '');

        if (file_exists('uploads/custom.css')) {
           $css=file_get_contents('uploads/custom.css');
        }
        else{
            $css='';
        }

        if (file_exists('uploads/custom.js')) {
           $js=file_get_contents('uploads/custom.js');
        }
        else{
            $js='';
        }

        return view('admin.option.theme', compact('theme','basic_settings','css','js'));
    }

    public function settingsUpdate( AdminThemeSettingsRequest $request)
    {
        //using custom request validator form App\Http\Requests\AdminThemeSettingsRequest;

        foreach ($request->social ?? [] as $value) {
            $social[] = [
                'icon' => $value['icon'],
                'link' => $value['link'],
            ];
        };
        foreach ($request->asked ?? [] as $value) {
            $asked[] = [
                'question' => $value['question'],
                'answer'   => $value['answer'],
            ];
        };

        // logo check
        if ($request->hasFile('logo')) {
            $logo      = $request->file('logo');
            $logo_name = 'logo.png';
            $logo_path = 'uploads/';
            $logo->move($logo_path, $logo_name);

        }
         if ($request->hasFile('header_image')) {
            $logo      = $request->file('header_image');
            $logo_name = 'header_image.png';
            $logo_path = 'uploads/';
            $logo->move($logo_path, $logo_name);

        }

        if ($request->hasFile('favicon')) {
            $favicon      = $request->file('favicon');
            $favicon_name = 'favicon.ico';
            $favicon_path = 'uploads/';
            $favicon->move($favicon_path, $favicon_name);
        }

        $data = [
            'asked'                   => $asked ?? [],
        ];



        $theme        = Option::where('key','theme_settings')->first();
        if (empty($theme)) {
          $theme = new Option;
          $theme->key   = 'theme_settings';
        }
        
        $theme->value = json_encode($data);
        $theme->save();

        $basic_settings['address']=$request->address;
        $basic_settings['email']=$request->email;
        $basic_settings['theme_color']=$request->theme_color;
        $basic_settings['social']=$social ?? [];

        $basic        = Option::where('key','basic_settings')->first();
        if (empty($basic)) {
          $basic = new Option;
          $basic->key   = 'basic_settings';
        }
       
        $basic->value = json_encode($basic_settings);
        $basic->save();

        if ($request->css) {
            \File::put('uploads/custom.css',$request->css);
        }
        if ($request->js) {
            \File::put('uploads/custom.js',$request->js);
        }

        Cache::forget('basic_settings');


        return response()->json('Theme Settings Updated!!');
    }
}
