<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSettingsRequest;
use App\Models\Useroption;
use Illuminate\Support\Facades\Auth;
use File;
use Request;
class UserOptionController extends Controller
{
    public function siteSettingIndex()
    {
        abort_if(!planData('portfolio_builder'),403);
        $id           = Auth::user()->id;
        $user         = Useroption::where('user_id', $id)->where('key', 'site_settings')->first() ?? null;
        $tenant_theme = userPlanLimit('theme', $id);
        if (file_exists('uploads/'.Auth::id().'/additional.css')) {
          $css=file_get_contents('uploads/'.Auth::id().'/additional.css');
        }
        else{
          $css='';
        }

        if (file_exists('uploads/'.Auth::id().'/additional.js')) {
          $js=file_get_contents('uploads/'.Auth::id().'/additional.js');
        }
        else{
          $js='';
        }
        return view('user.site_setting.index', compact('user', 'tenant_theme','js','css'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function siteSettingUpdate(SiteSettingsRequest $request)
    {

        
        //using custom request validator form App\Http\Requests\SiteSettingsRequest;

        //to check storage limit
        $id = Auth::user()->id;

        $folder            = "uploads/" . $id;
        $folder_size       = folderSize($folder);
        $plan_storage_size = userPlanLimit('storage_size', $id);
        if ($folder_size >= $plan_storage_size) {
            $msg['errors']['error'] = "maximum storage limit exceeded";
            return response()->json($msg, 401);
        }
        //check the tenant theme for user
      

        $user = Useroption::where('user_id', $id)->where('key', 'site_settings')->first();

        if (($user == null)) {
            $user = new Useroption();
        } else {
            $image = json_decode($user->value);
        }

        $about_img_url = $image->about_img ?? '';
        $hero_img_url = $image->hero_img ?? '';
        $logo_url = $image->logo_url ?? '';
        $favicon_url = $image->favicon_url ?? '';

        $user->user_id = $id;
        $user->key     = 'site_settings';

        if ($request->hasFile('logo')) {
            $logo      = $request->file('logo');
            $logo_name = 'logo.png';
            $logo_path = 'uploads/' . Auth::id() . '/';
            $logo->move($logo_path, $logo_name);
            
        }

        if ($request->hasFile('favicon')) {
            $favicon      = $request->file('favicon');
            $favicon_name = 'favicon.ico';
            $favicon_path = 'uploads/' . Auth::id() . '/';
            $favicon->move($favicon_path, $favicon_name);
           
        }

        if ($request->hasFile('hero_img')) {
            $hero_img      = $request->file('hero_img');
            $hero_img_name = 'hero_img.'.$hero_img->getClientOriginalExtension();
            $hero_img_path = 'uploads/' . Auth::id() . '/';
            $hero_img->move($hero_img_path, $hero_img_name);
            $heroImage=$hero_img_path.$hero_img_name;
            
        }
        else{
            $heroImage=$image->hero_img ?? '';
        }

        if ($request->hasFile('about_img')) {
            $about_img      = $request->file('about_img');
            $about_img_name = 'about_img.'.$about_img->getClientOriginalExtension() ;
            $about_img_path = 'uploads/' . Auth::id() . '/';
            $about_img->move($about_img_path, $about_img_name);
            $aboutImg=$about_img_path.$about_img_name;
            
        }
        else{
            $aboutImg=$image->about_img ?? '';
        }
        

        foreach ($request->social ?? [] as $value) {
            $social[] = [
                'icon' => $value['icon'],
                'link' => $value['link'],
            ];
        };

        

        if (isset($request->counter)) {
            foreach ($request->counter ?? [] as $value) {
                $counter[] = [
                    'icon'  => $value['icon'],
                    'label' => $value['label'],
                    'count' => $value['count'],
                ];
            };
        }

        $data = [
            'tagline'             => $request->title ?? [],
            'hire'                => $request->hire ?? null,  
            'social'              => $social ?? [],
            'counter'             => $counter ?? [],
            'title_about'         => $request->title_about,
            'about_description'   => $request->about_description,
            'cv_url'              => $request->cv_url,
            'full_name'           => $request->full_name,
            'experience'          => $request->experience,
            'age'                 => $request->age,
            'email'               => $request->email,
            'hero_img'            => $heroImage,
            'about_img'           => $aboutImg,
            'service_title'       => $request->service_title ?? '',
            'hero_title'       => $request->hero_title ?? '',
            'hero_description'       => $request->hero_description ?? '',
            'service_description' => $request->service_description ?? '',
            'portoflio_title' => $request->portoflio_title ?? '',
            'portoflio_description' => $request->portoflio_description ?? '',
            'blog_title' => $request->blog_title ?? '',
            'blog_description' => $request->blog_description ?? '',
            'contact_title' => $request->contact_title ?? '',
            'contact_description' => $request->contact_description ?? '',
            'education_title' => $request->education_title ?? '',
            'education_description' => $request->education_description ?? '',
            'testimonial_title' => $request->testimonial_title ?? '',
            'testimonial_description' => $request->testimonial_description ?? '',
            'contact_short_description' => $request->contact_short_description ?? '',
            'contact_address' => $request->contact_address ?? '',
            'contact_email' => $request->contact_email ?? '',
            'contact_phone' => $request->contact_phone ?? ''
        ];
        $user->value = json_encode($data);

        

        $user->save();
        return response()->json('Settings Added Successfully');
    }

    public function script(SiteSettingsRequest $request)
    {
     


        File::put('uploads/'.Auth::id().'/additional.css',$request->css);
        File::put('uploads/'.Auth::id().'/additional.js',$request->js);

        return response()->json('Additional Code Added Successfully');
    }
}
