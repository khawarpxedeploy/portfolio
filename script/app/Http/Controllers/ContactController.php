<?php

namespace App\Http\Controllers;
use App\Http\Requests\AuthFrontendMailRequest;
use Illuminate\Http\Request;
use App\Mail\ContactUsPageMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
class ContactController extends Controller
{
    public function index()
    {
        $seo=get_option('seo_contract');

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
        return view('main.contact.index');
    }

    public function sendMail(AuthFrontendMailRequest $request)
    {
       
        $data   = [
            'email'   => $request->email,
            'sendTo'  => env('MAIL_TO'),
            'name'    => $request->name,
            'subject' => $request->subject,
            'message' => $request->message,
            'type'    => 'contact_mail',
        ];
        // this part check that if the Queue mail is on in env then send mail is using Queue or go to else part
        if (env('QUEUE_MAIL') == 'on') {
            dispatch(new SendEmailJob($data));
        } else {
            Mail::to(env('MAIL_TO'))->send(new ContactUsPageMail($data));
        }
        return response()->json('Email Sent Successfully !');
    }
}
