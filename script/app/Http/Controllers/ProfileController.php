<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthFrontendMailRequest;
use App\Jobs\SendEmailJob;
use App\Mail\ContactUsPageMail;
use App\Models\Category;
use App\Models\Post;
use App\Models\Postcategory;
use App\Models\User;
use App\Models\Useroption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
class ProfileController extends Controller
{
    public $user_id;

    /**
     * index function using for view user welcome form
     *
     * @return void
     */

    public function index()
    {
       

        if (filter_protocol(url('/')) == env('APP_PROTOCOLESS_URL')) {

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

     public function indexPath()
    {
        
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

    /**
     * blog method using for view blade page for blog
     *
     * @return void
     */
    public function blog()
    {
        $user = $this->request('useroption');
        return view(baseview() . '.blog', compact('user'));
    }

    public function getblogs()
    {
        $data = $this->request('blogs');
        return response()->json($data);
    }

    /**
     * blogView using for view single blog post with there related data
     *
     * @return void
     */
    public function blogView($slug)
    {
        return view(baseview() . '.blogview');
    }

    public function getsingleblog($slug)
    {
        $data['blog']         = $this->request('single_blog', $slug);
        $data['thumbnail']    = $data['blog'] ? asset($data['blog']->thum_image->value) : '';
        $cat_id               = Postcategory::where('post_id', $data['blog']->id)->pluck('category_id');
        $data['similarBlogs'] = $this->request('similar_blogs', '', $cat_id, $data['blog']->id);
        return response()->json($data);
    }

    /**
     * about method using to view blade page for page
     *
     * @return void
     */
    public function about()
    {
        $user = $this->request('useroption');
        return view(baseview() . '.about', compact('user'));
    }

    /**
     * portfolio method using to view blade page for portfolio
     *
     * @return void
     */
    public function portfolio()
    {
        $user = $this->request('useroption');
        return view(baseview() . '.portfolio', compact('user'));
    }

    public function getportfolio()
    {
        $data = $this->request('portfolio_project');
        return response()->json($data);
    }

    /**
     * sendMailByContact  method is calling form Auth user frontend for basic data which need in Auth user frontend app data
     * using route is 'prefix'     => '/profile/{tenant}',
     * in this send mail get all data form frontend and send the mail to Auth user
     *
     * @param  mixed $request
     * @return void
     */
    public function sendMailByContact(AuthFrontendMailRequest $request)
    {
        //using custom request validator form App\Http\Requests\AuthFrontendMailRequest;
        $user   = User::findOrFail(tenant('user_id'));
        $sendTo = $user->email;
        $data   = [
            'email'   => $request->email,
            'sendTo'  => $sendTo,
            'name'    => $request->name,
            'subject' => $request->subject,
            'message' => $request->message,
            'type'    => 'contact_mail',
        ];
        // this part check that if the Queue mail is on in env then send mail is using Queue or go to else part
        if (env('QUEUE_MAIL') == 'on') {
            dispatch(new SendEmailJob($data));
        } else {
            Mail::to($sendTo)->send(new ContactUsPageMail($data));
        }
        return response()->json('Email Sent Successfully !');
    }

    /**
     * information method is calling form Auth user frontend for basic data which need in welcome Page
     * this method send data using ajax Request
     * for every section i send particular data like var $data['education'] or $data['skills']
     * in some var $data[''] i used map() function to send data
     *this method send data using ajax request form welcome page
     * @return void
     */

    public function information()
    {
    
        $data['skills']       = $this->request('skill');
        $data['experience']   = $this->request('experience');
        $data['education']    = $this->request('education');
        $data['service']      = $this->request('service');
        $data['projects']     = $this->request('projects');
        $data['testimonials'] = $this->request('testimonials');
        $data['blogs']        = $this->request('blogs');
        return response()->json($data);
    }

    public function request($key, $slug = '', $category_id = '', $id = '')
    {
        if ($key == 'skill') {
            
                return $this->skill();
            
        }

        if ($key == 'experience') {
            
                return $this->experience();
            
        }

        if ($key == 'education') {
            
                return $this->education();
            
        }
        if ($key == 'service') {
            
                return $this->service();
            
        }

        if ($key == 'projects') {
            
                return $this->projects();
            
        }

        if ($key == 'testimonials') {
            
                return $this->testimonials();
            
        }

        if ($key == 'blogs') {
            
                return $this->blogs();
            
        }

        if ($key == 'useroption') {
            
                return $this->useroption();
            
        }

        if ($key == 'all_blogs') {
            
                return $this->all_blogs();
           
        }

        if ($key == 'single_blog') {
           
                return $this->single_blog($slug);
            
        }

        if ($key == 'similar_blogs') {
           
                return $this->similar_blogs($category_id, $id);
            

        }

        if ($key == 'portfolio_project') {
           
                return $this->portfolio_project();
            
        }

        if ($key == 'project') {
            
                return $this->project();
           
        }

        if ($key == 'basicinfo') {
            
                return $this->basicinfo();
            
        }

        if ($key == 'workprocess') {
            
                return $this->workprocess();
            
        }

        if ($key == 'myteam') {
           
                return $this->myteam();
           
        }

    }



    /**
     * aboutMeInfo method is using for show data in Auth user frontend about section data
     * using map() method to map the data
     * return the response to the ajax request in about section
     *
     * @return void
     */
    public function aboutMeInfo()
    {
        $data['basicInfo']   = $this->request('basicinfo');
        $data['workProcess'] = $this->request('workprocess');
        $data['myTeam']      = $this->request('myteam');
        return response()->json($data);
    }

    public function project()
    {
        return Post::with('link', 'thum_image')->where('type', 'project')->where('user_id', tenant('user_id'))->latest()->get();
    }

    public function myteam()
    {
        return Category::with('my_team_meta')->where('type', 'my_team')->where('user_id', tenant('user_id'))->latest()->get()->map(function ($q) {
            $json             = json_decode($q->my_team_meta->value);
            $data['avatar']   = asset($json->avatar);
            $data['position'] = $json->position;
            $data['name']     = $json->name;
            return $data;
        });
    }

    public function workprocess()
    {
        return Category::with('work_process_meta')->where('type', 'work_process')->where('user_id', tenant('user_id'))->latest()->get()->map(function ($q) {
            $json          = json_decode($q->work_process_meta->value);
            $data['icon']  = $json->icon;
            $data['title'] = $json->title;
            $data['des']   = $json->des;
            return $data;
        });
    }

    public function basicinfo()
    {
        return  '';
    }

    public function similar_blogs($category_id, $id)
    {
        return Postcategory::with('posts')->whereIn('category_id', $category_id)->where('post_id', '!=', $id)->groupBy('post_id')->get();
    }

    public function all_blogs()
    {
        return Post::where('type', 'blog')->where('user_id', tenant('user_id'))->latest()->limit(6)->get();
    }

    public function single_blog($slug)
    {
        return Post::with('description', 'thum_image', 'user')->where('type', 'blog')->where('user_id', tenant('user_id'))->where('slug', $slug)->first();
    }

    public function useroption()
    {
        return Useroption::where('user_id', tenant('user_id'))->where('key', 'site_settings')->first();
    }

    public function skill()
    {
        return $data = Category::with('skill_meta')->where('type', 'skill')->where('user_id', tenant('user_id'))->latest()->get()->map(function ($q) {
            $json          = json_decode($q->skill_meta->value);
            $data['level'] = $json->level;
            $data['color'] = $json->color;
            $data['name']  = $q->name;
            return $data;
        });
    }

    public function experience()
    {
        return $data = Category::with('experience_meta')->where('type', 'experience')->where('user_id', tenant('user_id'))->latest()->get()->map(function ($q) {
            $json                = json_decode($q->experience_meta->value);
            $data['start_date']  = $json->start_date;
            $data['end_date']    = $json->end_date;
            $data['icon']        = $json->icon;
            $data['description'] = $json->description;
            $data['name']        = $q->name;
            $data['company']     = $json->company ?? '';
            return $data;
        });
    }

    public function education()
    {
        return $data = Category::with('education_meta')->where('type', 'education')->where('user_id', tenant('user_id'))->latest()->get()->map(function ($q) {
            $json                = json_decode($q->education_meta->value);
            $data['ending_date'] = $json->ending_date;
            $data['subject']     = $json->subject;
            $data['university']  = $json->university;
            $data['short_content']  = $json->short_content ?? '';
            return $data;
        });
    }

    public function service()
    {
        return $data = Post::with('thum_image', 'excerpt', 'icon')->where('type', 'service')->where('user_id', tenant('user_id'))->latest()->get()->map(function ($q) {
            $data['title']       = $q->title;
            $data['excerpt']     = $q->excerpt->value;
           
            $data['icon']        = $q->icon->value;
            $data['img']         = asset($q->thum_image->value ?? '');
            return $data;
        });
    }

    public function portfolio_project()
    {
        return Post::with('link', 'thum_image')->where('type', 'project')->where('user_id', tenant('user_id'))->latest()->get();
    }

    public function projects()
    {
        return $data = Post::with('link', 'thum_image')->where('type', 'project')->where('user_id', tenant('user_id'))->latest()->get()->map(function ($q) {
            $data['img']   = asset($q->thum_image->value);
            $data['link']  = $q->link->value;
            $data['title'] = $q->title;
            return $data;
        });
    }

    public function testimonials()
    {
        return $data = Category::with('testimonial_meta')->where('type', 'testimonial')->where('user_id', tenant('user_id'))->latest()->get()->map(function ($q) {
            $json             = json_decode($q->testimonial_meta->value);
            $data['name']     = $q->name;
            $data['img']      = asset($json->avatar ?? '');
            $data['position'] = $json->position ?? '';
            $data['review']   = $json->review ?? '';
            return $data;
        });
    }

    public function blogs()
    {
        return $data = Post::with('excerpt', 'thum_image', 'user')->where('type', 'blog')->where('user_id', tenant('user_id'))->latest()->limit(3)->get()->map(function ($q) {
            $data['img']         = asset($q->thum_image->value);
            $data['des']         = $q->excerpt->value;
            $data['title']       = $q->title;
            $data['date']        = $q->created_at->format('F d,Y');
            

            $data['url'] = my_url('/') . 'blog/'. ($q->slug).'/'.$q->id;
            return $data;
        });
    }

    public function about_me()
    {
        return $data = Useroption::where('key', 'about_me')->where('user_id', tenant('user_id'))->get()->map(function ($q) {
            $json                = json_decode($q->value);
            $data['img']         = asset($json->image);
            $data['signature']   = asset($json->signature);
            $data['description'] = $json->description;
            $data['name']        = $json->name;
            return $data;
        });
    }

    public function work_process()
    {
        return $data = Category::with('work_process_meta')->where('type', 'work_process')->where('user_id', tenant('user_id'))->latest()->get()->map(function ($q) {
            $json          = json_decode($q->work_process_meta->value);
            $data['icon']  = $json->icon;
            $data['title'] = $json->title;
            $data['des']   = $json->des;
            return $data;
        });
    }

    public function my_team()
    {
        return $data = Category::with('my_team_meta')->where('type', 'my_team')->where('user_id', tenant('user_id'))->latest()->get()->map(function ($q) {
            $json             = json_decode($q->my_team_meta->value);
            $data['avatar']   = asset($json->avatar);
            $data['position'] = $json->position;
            $data['name']     = $json->name;
            return $data;
        });
    }

    public function contact()
    {
        return view(baseview() . '.contact');
    }
}
