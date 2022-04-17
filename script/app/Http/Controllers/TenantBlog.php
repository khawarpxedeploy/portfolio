<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Str;
use App\Models\Useroption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
class TenantBlog extends Controller
{
    public function blog(Request $request)
    {
        abort_if(!planData('portfolio_builder'),403);
        $option=$this->useroption();
        $info=json_decode($option->value ?? '');

        $tags='';

        foreach ($info->tagline ?? [] as $key => $value) {
            $tags .= $value.', ';
        }

        

        JsonLdMulti::setTitle('blog',false);
        JsonLdMulti::setDescription($info->about_description ?? null);
        JsonLdMulti::addImage(asset($info->about_img ?? ''));

        SEOMeta::setTitle('blog',false);
        SEOMeta::setDescription($info->about_description ?? null);
        SEOMeta::addKeyword($tags ?? null);

        SEOTools::setTitle('blog',false);
        SEOTools::setDescription($info->about_description ?? null);
       
        SEOTools::opengraph()->addProperty('keywords', $tags ?? null);
        SEOTools::opengraph()->addProperty('image', asset($info->about_img ?? ''));
        
        SEOTools::jsonLd()->addImage(asset($info->about_img ?? ''));
    	return view(baseview() . '.blog',compact('info'));
    }

    public function show($slug,$id)
    {
    	$user_id   = tenant('user_id');
        $info=Post::query()->where('type','blog')->with('description','excerpt','thum_image')->where('user_id',$user_id)->findorFail($id);

        $option=$this->useroption();
        $option=json_decode($option->value ?? '');

        

        

        JsonLdMulti::setTitle($info->title,false);
        JsonLdMulti::setDescription($info->excerpt->value ?? null);
        JsonLdMulti::addImage(asset($info->thum_image->value ?? ''));

        SEOMeta::setTitle($info->title,false);
        SEOMeta::setDescription($info->excerpt->value ?? null);
    

        SEOTools::setTitle($info->title,false);
        SEOTools::setDescription($info->excerpt->value ?? null);
       
      
        SEOTools::opengraph()->addProperty('image', asset($info->thum_image->value ?? ''));
        
        SEOTools::jsonLd()->addImage(asset($info->thum_image->value ?? ''));

    	return view(baseview() . '.blogview',compact('info','option'));
    }

    public function blogs()
    {
        abort_if(!planData('portfolio_builder'),403);
    	$user_id   = tenant('user_id');
    	$posts=Post::query()->where('type','blog')->with('excerpt','thum_image')->where('user_id',$user_id)->latest()->paginate(9);

    	$posts->getCollection()->transform(function ($q) {
    	
            $data['img']         = asset($q->thum_image->value);
            $data['des']         = Str::limit($q->excerpt->value,200);
            $data['title']       = Str::limit($q->title,60);
            $data['date']        = $q->created_at->format('F d, Y');
            

            $data['url'] = my_url('/') . 'blog/'. ($q->slug).'/'.$q->id;
            return $data;
       
    	});

    	return response()->json($posts);
    }

    public function useroption()
    {
        return Useroption::where('user_id', tenant('user_id'))->where('key', 'site_settings')->first();
    }
}
