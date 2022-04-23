<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\VCardRequest;
use App\Models\Tenant;
use App\Models\Theme;
use App\Models\Useroption;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JeroenDesloovere\VCard\VCard;
use Str;

class VCardController extends Controller
{
    /**
     * download vcard
     *
     * @return void
     */
    public function download()
    {
        
        $id = tenant('user_id');

        $user_info = Useroption::where([['user_id', $id], ['key', 'vcard']])->first();

        abort_if($user_info == null, 404);
        $user_data = json_decode($user_info->value);

        $path   = $user_data->profile_image_url;

        $type   = pathinfo($path, PATHINFO_EXTENSION);

        if(file_exists($path))
        {
            $data   = file_get_contents($path);
        }else{
            return back();
        }
        

        $base64 = base64_encode($data);

        $data = 'BEGIN:VCARD' . PHP_EOL .
        'VERSION:3.0' . PHP_EOL .
        'FN:' . $user_data->name . PHP_EOL .
        'N:' . $user_data->name . PHP_EOL .
        'PHOTO;ENCODING=b;TYPE=PNG:' . $base64 . PHP_EOL .
        'TITLE:' . $user_data->tagline . PHP_EOL .
        'NOTE:' . $user_data->description . PHP_EOL;
        foreach ($user_data->social ?? [] as $key => $item) {
            $social_data = $this->vcardtext($item->field_name, $item->value);
            $data .= $social_data . PHP_EOL;
        }
        $data .= 'END:VCARD';
        $file_name = fopen(str_replace('script', '', base_path()) . '/uploads/'.$id.'/'. $user_data->name . tenant('user_id') . ".vcf", "wb");
        fwrite($file_name, $data);
        fclose($file_name);
        $myFile = str_replace('script', '', base_path()) . '/uploads/'.$id.'/'. $user_data->name . tenant('user_id') . ".vcf";
        return response()->download($myFile)->deleteFileAfterSend(true);

    }
    public function vcardtext($fieldname, $value)
    {
        $social = [
            'Email'      => 'EMAIL:' . $value,
            'Phone'      => 'TEL:' . $value,
            'Website'    => 'URL;TYPE=WEBSITE:' . $value,
            'Address'    => 'ADDRESS:' . $value,
            'Instagram'  => 'URL;TYPE=INSTAGRAM:https://instagram.com/' . $value,
            'Facebook'   => 'URL;TYPE=FACEBOOK:https://facebook.com/' . $value,
            'Twitter'    => 'URL;TYPE=TWITTER:https://twitter.com/' . $value,
            'Snapchat'   => 'URL;TYPE=SNAPCHAT:https://snapchat.com/' . $value,
            'Linkedin'   => 'URL;TYPE=LINKEDIN:https://linkedin.com/' . $value,
            'Pinterest'  => 'URL;TYPE=PINTEREST:https://pinterest.com/' . $value,
            'Vimeo'      => 'URL;TYPE=VIMEO:https://vimeo.com/' . $value,
            'Dribbble'   => 'URL;TYPE=DRIBBLE:https://dribbble.com/' . $value,
            'Behance'    => 'URL;TYPE=BEHANCE:https://behance.com/' . $value,
            'Youtube'    => 'URL;TYPE=YOUTUBE:https://youtube.com/' . $value,
            'Flickr'     => 'URL;TYPE=FLICKR:https://flickr.com/' . $value,
            'Tiktok'     => 'URL;TYPE=TIKTOK:https://tiktok.com/' . $value,
            'Discord'    => 'URL;TYPE=DISCORD:https://discord.com/' . $value,
            'Twitch'     => 'URL;TYPE=TWITCH:https://twitch.com/' . $value,
            'Github'     => 'URL;TYPE=GITHUB:https://github.com/' . $value,
            'Paypal'     => 'URL;TYPE=YOUTUBE:https://youtube.com/' . $value,
            'Soundcloud' => 'URL;TYPE=SOUNDCLOUD:https://soundcloud.com/' . $value,
            'Whatsapp'   => 'URL;TYPE=WHATSAPP::https://wa.me/'.$value,
        ][$fieldname];
        return $social;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!planData('vcard'),403);
        $id    = Auth::user()->id;
        $user  = Useroption::where('user_id', $id)->where('key', 'vcard')->first() ?? null;
        $theme = Theme::where('type', 'vcard')->latest()->paginate(20);
        return view('user.vcard.index', compact('user', 'theme'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VCardRequest $request)
    {
        //using custom request validator form App\Http\Requests\SiteSettingsRequest;
        $id = Auth::user()->id;
        //to check storage limit
        $folder            = "uploads/" . $id;
        $folder_size       = folderSize($folder);
        $tenant = Tenant::where('user_id',$id)->first();
        $plan_storage_size = $tenant->storage_size;
        if ($folder_size >= $plan_storage_size) {
            $msg['errors']['error'] = "maximum storage limit exceeded";
            return response()->json($msg, 401);
        }

        $user = Useroption::where('user_id', $id)->where('key', 'vcard')->first();

        if (($user == null)) {
            $request->validate([
                "profile_image" => "required|image|max:1000",
                "cover_image"   => "required|image|max:1000",
            ]);
            $user = new Useroption();
        } else {
            $image = json_decode($user->value);
        }

        $user->user_id = $id;
        $user->key     = 'vcard';
        // logo uploads
        if ($user == null) {
            if ($request->hasFile('cover_image')) {
                $cover_image      = $request->file('cover_image');
                $cover_image_name = Str::random(20). $cover_image->getClientOriginalExtension();
                $cover_image_path = 'uploads/' . Auth::id() . '/vcard/';
                $cover_image->move($cover_image_path, $cover_image_name);
                $cover_image_url = $cover_image_path . $cover_image_name;
            }
        } else {
            if ($request->hasFile('cover_image')) {
                if (isset($image->cover_image_url)) {
                   if (!empty($image->cover_image_url)) {
                      if (file_exists($image->cover_image_url)) {
                         unlink($image->cover_image_url);
                      }
                   }
                }
                $cover_image      = $request->file('cover_image');
                $cover_image_name = Str::random(20). $cover_image->getClientOriginalExtension();
                $cover_image_path = 'uploads/' . Auth::id() . '/vcard/';
                $cover_image->move($cover_image_path, $cover_image_name);
                $cover_image_url = $cover_image_path . $cover_image_name;
            } else {
                $cover_image_url = $image->cover_image_url;
            }
        }

        // profile_image uploads
        if ($user == null) {
            if ($request->hasFile('profile_image')) {
                $profile_image      = $request->file('profile_image');
                $profile_image_name = Str::random(20). $profile_image->getClientOriginalExtension();
                $profile_image_path = 'uploads/' . Auth::id() . '/vcard/';
                $profile_image->move($profile_image_path, $profile_image_name);
                $profile_image_url = $profile_image_path . $profile_image_name;
            }
        } else {
            if ($request->hasFile('profile_image')) {
                if (isset($image->profile_image_url)) {
                   if (!empty($image->profile_image_url)) {
                      if (file_exists($image->profile_image_url)) {
                         unlink($image->profile_image_url);
                      }
                   }
                }
                $profile_image      = $request->file('profile_image');
                $profile_image_name = Str::random(20). $profile_image->getClientOriginalExtension();

                $profile_image_path = 'uploads/' . Auth::id() . '/';
                $profile_image->move($profile_image_path, $profile_image_name);
                $profile_image_url = $profile_image_path . $profile_image_name;
            } else {
                $profile_image_url = $image->profile_image_url ?? '';
            }
        }
        // for dynamic value commies form social icon
        foreach ($request->social ?? [] as $value) {
            $social[] = [
                'field_name' => $value['field_name'],
                'value'      => $value['value'],
                'label'      => $value['label'],
                'type'       => $value['type'],
            ];
        };

        //to unique slug
        $slug = Str::slug($request->slug);

        $data = [
            'theme'             => $request->theme,
            'color'             => $request->color,
            'slug'              => $slug,
            'name'              => $request->name,
            'tagline'           => $request->tagline,
            'description'       => $request->description,
            'profile_image_url' => $profile_image_url ?? '',
            'cover_image_url'   => $cover_image_url ?? '',
            'social'            => $social ?? [],
        ];

        $user->value = json_encode($data);

        $user->save();
        return response()->json('Settings Added Successfully');
    }
}
