<?php

use App\Models\Option;
use App\Models\Tenant;
use App\Models\Usermeta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Menu;
function my_url($url = null)
{
    $site_url = filter_protocol(url('/'));
    if ($site_url == env('APP_PROTOCOLESS_URL')) {
        $tenant = tenant('id');
        return env('APP_URL_WITH_TENANT') . $tenant . $url;
    }
    else{
        return url('/').$url;
    }
}

function baseview()
{
    $theme = tenant('theme');
    if ($theme == null) {
        return 'theme.default';
    }
    $url = str_replace('/', '.', $theme);
    return $url;
}

function folderSize($dir)
{
    $file_size = 0;
    if (!file_exists($dir)) {
        return $file_size;
    }
    foreach (\File::allFiles($dir) as $file) {
        $file_size += $file->getSize();
    }
    return $file_size = str_replace(',', '', number_format($file_size / 1048576, 2));
}

function userPlanLimit($key, $user_id)
{
    $plan = Tenant::where('user_id', $user_id)->where('will_expire', '>=', now())->first();
    if ($plan == null) {
        return false;
    }
    return $plan->$key ?? false;
}

function planData($type){
 $user_id = Auth::id() ?? tenant('user_id');
 $plan = Tenant::where('user_id', $user_id)->where('will_expire','>=',now())->first();
 return ($plan && $plan->$type == 1) ? true : false;
}

function getVcardIcon($fieldname)
{
    $social = [
        'Phone' => 'fluent:call-28-regular',
        'Contact' => 'fluent:call-28-regular',
        'Email' => 'clarity:email-line',
        'Address' => 'akar-icons:link-chain',
        'Website' => 'akar-icons:link-chain',
        'Text' => 'bi:journal-text',
        'Facebook' => 'akar-icons:facebook-fill',
        'Twitter' => 'akar-icons:twitter-fill',
        'Instragram' => 'akar-icons:instagram-fill',
        'Whatsapp' => 'akar-icons:whatsapp-fill',
        'Telegram' => 'ph:telegram-logo-duotone',
        'Skype' => 'ant-design:skype-filled',
        'Snapchat' => 'ph:snapchat-logo-bold',
        'Linkedin' => 'akar-icons:linkedin-fill',
        'Pinterest' => 'akar-icons:pinterest-fill',
        'Vimeo' => 'akar-icons:vimeo-fill',
        'Dribbble' => 'akar-icons:dribbble-fill',
        'Behance' => 'ant-design:behance-circle-filled',
        'Youtube' => 'akar-icons:youtube-fill',
        'Flickr' => 'bx:bxl-flickr',
        'Tiktok' => 'cib:tiktok',
        'Discord' => 'bi:discord',
        'Twitch' => 'akar-icons:twitch-fill',
        'Github' => 'akar-icons:github-fill',
        'Paypal' => 'bx:bxl-paypal',
        'Soundcloud' => 'akar-icons:soundcloud-fill',
        'Location' => 'akar-icons:location',
    ];

    if (!isset($social[$fieldname])) {
        return 'akar-icons:link-chain';
    }

    return $social[$fieldname];
}

function cvtitle($slug)
{
    $user_id = tenant('user_id') ?? Auth::id();
    $title = ucwords(str_replace(" ","_",$slug));
    $cv = Usermeta::where([['user_id', $user_id], ['key', 'cv']])->first();
    $cv = json_decode($cv->value);
    $language = $cv->cvlanguage;
    $option = Option::where('key','cvlanguage')->first();
    $data = json_decode($option->value, true);
    $arr = '';
    foreach($data as $key => $lang){
        if($key === $language){
            $arr = $lang;
        }
    }

    if (!isset($arr[$title])) return $slug;
    return $arr[$title];
}

function filter_protocol($url)
{
    $domain = strtolower($url);
    $input = trim($domain, '/');
    if (!preg_match('#^http(s)?://#', $input)) {
        $input = 'http://' . $input;
    }
    $urlParts = parse_url($input);
    $domain = preg_replace('/^www\./', '', $urlParts['host']);
    $full_domain = rtrim($domain, '/');

    return $full_domain;
}

function get_option($param)
{
    return $data=cache()->remember($param, 300, function () use ($param) {
           $option=Option::where('key',$param)->first();
           return $data=json_decode($option->value ?? '');
    });


}

function content($data)
{
    return view('components.content',compact('data'));
}

function header_menu($position)
{

    $menus=cache()->remember($position.Session::get('locale'), 300, function () use ($position) {
        $menus=Menu::where('position',$position)->where('lang',Session::get('locale'))->first();
        return  json_decode($menus->data ?? '');
    });
    
    return view('components.menu.parent',compact('menus'));
}

function footer_menu($position)
{
    $menus=cache()->remember($position.Session::get('locale'), 300, function () use ($position) {
        $menus=Menu::where('position',$position)->where('lang',Session::get('locale'))->first();
        $data['data'] = json_decode($menus->data ?? '');
        $data['name'] = $menus->name ?? '';
        return $data;
    });
   
    
    return view('components.footer_menu.parent',compact('menus'));
}

function amount_admin_format($value='')
{
   return number_format($value,2);
}

function getCache($key)
{
    return \Cache::get($key);
}

function vcardlink($fieldname,$value)
{
    $status = [
        'Whatsapp' => ['value'=>'https://wa.me/'.$value],
        'Snapchat' => ['value'=>'https://www.snapchat.com/add/'.$value],
        'Linkedin' => ['value'=>'https://www.linkedin.com/in/'.$value],
        'Email' => ['value'=>'mailto:'.$value],
        'Phone' => ['value'=>'tel:'.$value],
        'Address' => ['value'=>'https://www.google.com/maps/place/'.$value],
        'Website' => ['value'=>$value],
        'Text' => ['value'=>'javascript:void(0)'],
        'Facebook' => ['value'=>$value],
        'Twitter' => ['value'=>$value],
        'Instragram' => ['value'=>$value],
        'Telegram' => ['value'=>$value],
        'Skype' => ['value'=>$value],
        'WeChat' => ['value'=>$value],
        'Pinterest' => ['value'=>$value],
        'Vimeo' => ['value'=>$value],
        'Dribbble' => ['value'=>$value],
        'Behance' => ['value'=>$value],
        'Youtube' => ['value'=>$value],
        'Flickr' => ['value'=>$value],
        'Tiktok' => ['value'=>$value],
        'Discord' => ['value'=>$value],
        'Twitch' => ['value'=>$value],
        'Github' => ['value'=>$value],
        'Paypal' => ['value'=>$value],
        'Soundcloud' => ['value'=>$value]
    ][$fieldname];

    return $status['value'];

}

function load_footer(){
    return view('components.load_footer');
}

function load_header(){
    return view('components.load_header');
}

function id()
{
    return 33458337;
}