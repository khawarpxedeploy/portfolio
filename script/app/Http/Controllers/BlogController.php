<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;

class BlogController extends Controller
{
    public function index()
    {
        $seo=get_option('seo_blog');

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
    	$posts=Term::where('type', 'blog')->where('status',1)->with('excerpt','thum_image')->latest()->paginate(20);
        return view('main.blog.index',compact('posts'));
    }

    public function show($slug)
    {
    	$info=Term::where([['type', 'blog'],['slug',$slug]])->where('status',1)->with('excerpt','thum_image','description')->first();
    	abort_if(empty($info),404);

        JsonLdMulti::setTitle($info->title ?? env('APP_NAME'));
        JsonLdMulti::setDescription($info->excerpt->value ?? null);
        JsonLdMulti::addImage(asset($info->thum_image->value ?? ''));

        SEOMeta::setTitle($info->title ?? env('APP_NAME'));
        SEOMeta::setDescription($info->excerpt->value ?? null);
      

        SEOTools::setTitle($info->title ?? env('APP_NAME'));
        SEOTools::setDescription($info->excerpt->value?? null);
        SEOTools::setCanonical(url()->current());

        SEOTools::opengraph()->addProperty('image', asset($info->thum_image->value));
        SEOTools::twitter()->setTitle($info->title ?? env('APP_NAME'));
     
        SEOTools::jsonLd()->addImage(asset($info->thum_image->value));
        return view('main.blog.show',compact('info'));
    }

    public function pageView($slug)
    {
        $info=Term::where([['type', 'page'],['slug',$slug]])->where('status',1)->with('excerpt','description')->first();
        abort_if(empty($info),404);

        JsonLdMulti::setTitle($info->title ?? env('APP_NAME'));
        JsonLdMulti::setDescription($info->excerpt->value ?? null);
       

        SEOMeta::setTitle($info->title ?? env('APP_NAME'));
        SEOMeta::setDescription($info->excerpt->value ?? null);
      

        SEOTools::setTitle($info->title ?? env('APP_NAME'));
        SEOTools::setDescription($info->excerpt->value?? null);
        SEOTools::setCanonical(url()->current());

        SEOTools::twitter()->setTitle($info->title ?? env('APP_NAME'));
     
       
        return view('main.page',compact('info'));
    }

    public function templates($type)
    {
        $key=$type;
        if ($type == 'portfolio' ) {
            $type='portfolio_template';
        }
        elseif ($type == 'resume') {
            $type='resume_template';
        }
        elseif ($type == 'vcard') {
              $type='vcard_template';
        }
        else{
            abort(404);
        }
        $posts=Term::where([['type',$type]])->latest()->get();
        
        $seo=get_option('seo_home');
        JsonLdMulti::setTitle($seo->site_name .' - '. str_replace('_', ' ', $type) ?? env('APP_NAME'));
        JsonLdMulti::setDescription($seo->matadescription ?? null);
        JsonLdMulti::addImage(asset('uploads/logo.png'));

        SEOMeta::setTitle($seo->site_name .' - '. str_replace('_', ' ', $type) ?? env('APP_NAME'));
        SEOMeta::setDescription($seo->matadescription ?? null);
        SEOMeta::addKeyword($seo->tags ?? null);

        SEOTools::setTitle($seo->site_name .' - '. str_replace('_', ' ', $type) ?? env('APP_NAME'));
        SEOTools::setDescription($seo->matadescription ?? null);
        SEOTools::setCanonical(url('/'));
        SEOTools::opengraph()->addProperty('keywords', $seo->matatag ?? null);
        SEOTools::opengraph()->addProperty('image', asset('uploads/logo.png'));
        SEOTools::twitter()->setTitle($seo->site_name .' - '. str_replace('_', ' ', $type) ?? env('APP_NAME'));
        SEOTools::twitter()->setSite($seo->twitter_site_title ?? null);
        SEOTools::jsonLd()->addImage(asset('uploads/logo.png'));

        return view('main.templates',compact('posts','key'));
    }
}
