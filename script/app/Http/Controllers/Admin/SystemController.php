<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Str;
class SystemController extends Controller
{

	public function index()
	{
		if (!Auth()->user()->can('theme-settings')) {
            return abort(401);
        }
    	$countries= base_path('resources/lang/langlist.json');
        $countries= json_decode(file_get_contents($countries),true);
    	return view('admin.option.env',compact('countries'));
	}

       public function store(Request $request){
        if ($request->hasFile('service_account_credentials')) {
            $file      = $request->file('service_account_credentials');
            $name = 'service-account-credentials.json';
            $path = 'uploads/';
            $file->move($path, $name);
        }

       	$APP_URL_WITH_TENANT=$request->APP_URL.'/profile/';

    	$APP_URL_WITHOUT_WWW=str_replace('www.','', url('/'));
    	 $APP_NAME = Str::slug($request->APP_NAME);
$txt ="APP_NAME=".$APP_NAME."
APP_ENV=".$request->APP_ENV."
APP_KEY=".$request->APP_KEY."
SITE_KEY=".env('SITE_KEY')."
AUTHORIZED_KEY=".env('AUTHORIZED_KEY')."
APP_DEBUG=".$request->APP_DEBUG."
APP_URL=".$request->APP_URL."
APP_URL_WITH_TENANT=".$APP_URL_WITH_TENANT."
APP_URL_WITHOUT_WWW=".$APP_URL_WITHOUT_WWW."
APP_PROTOCOLESS_URL=".$request->APP_PROTOCOLESS_URL."
APP_PROTOCOL=".$request->APP_PROTOCOL."
MULTILEVEL_CUSTOMER_REGISTER=".$request->MULTILEVEL_CUSTOMER_REGISTER."

LOG_CHANNEL=".$request->LOG_CHANNEL."
LOG_LEVEL=".$request->LOG_LEVEL."\n
DB_CONNECTION=".env("DB_CONNECTION")."
DB_HOST=".env("DB_HOST")."
DB_PORT=".env("DB_PORT")."
DB_DATABASE=".env("DB_DATABASE")."
DB_USERNAME=".env("DB_USERNAME")."
DB_PASSWORD=".env("DB_PASSWORD")."

BROADCAST_DRIVER=".$request->BROADCAST_DRIVER."
CACHE_DRIVER=".$request->CACHE_DRIVER."
QUEUE_CONNECTION=".$request->QUEUE_CONNECTION."
SESSION_DRIVER=".$request->SESSION_DRIVER."
SESSION_LIFETIME=".$request->SESSION_LIFETIME."\n
REDIS_HOST=".$request->REDIS_HOST."
REDIS_PASSWORD=".$request->REDIS_PASSWORD."
REDIS_PORT=".$request->REDIS_PORT."\n


QUEUE_MAIL=".$request->QUEUE_MAIL."
MAIL_MAILER=".$request->MAIL_MAILER."
MAIL_HOST=".$request->MAIL_HOST."
MAIL_PORT=".$request->MAIL_PORT."
MAIL_USERNAME=".$request->MAIL_USERNAME."
MAIL_PASSWORD=".$request->MAIL_PASSWORD."
MAIL_ENCRYPTION=".$request->MAIL_ENCRYPTION."
MAIL_FROM_ADDRESS=".$request->MAIL_FROM_ADDRESS."
MAIL_TO=".$request->MAIL_TO."
MAIL_NOREPLY=".$request->MAIL_NOREPLY."
MAIL_FROM_NAME=".Str::slug($request->MAIL_FROM_NAME)."\n

MAILCHIMP_DRIVER=".$request->MAILCHIMP_DRIVER.""."
MAILCHIMP_APIKEY=".$request->MAILCHIMP_APIKEY.""."
MAILCHIMP_LIST_ID=".$request->MAILCHIMP_LIST_ID.""."

GITHUB_CLIENT_ID=".$request->GITHUB_CLIENT_ID.""."
GITHUB_CLIENT_SECRET=".$request->GITHUB_CLIENT_SECRET.""."


FACEBOOK_CLIENT_ID=".$request->FACEBOOK_CLIENT_ID.""."
FACEBOOK_CLIENT_SECRET=".$request->FACEBOOK_CLIENT_SECRET.""."

GOOGLE_CLIENT_ID=".$request->GOOGLE_CLIENT_ID.""."
GOOGLE_CLIENT_SECRET=".$request->GOOGLE_CLIENT_SECRET.""."

ANALYTICS_VIEW_ID=".$request->ANALYTICS_VIEW_ID.""."

CONTENT_EDITOR=".$request->CONTENT_EDITOR.""."

TIMEZONE=".$request->TIMEZONE.""."
DEFAULT_LANG=".$request->DEFAULT_LANG."\n
";
  File::put(base_path('.env'),$txt);

   $t="
AUTO_SUBDOMAIN_APPROVE=".$request->AUTO_SUBDOMAIN_APPROVE."
REGISTER_WITH_SUBDOMAIN=".$request->REGISTER_WITH_SUBDOMAIN."
MOJODNS_AUTHORIZATION_TOKEN=".$request->MOJODNS_AUTHORIZATION_TOKEN."
VERIFY_IP=".$request->VERIFY_IP."
SERVER_IP=".$request->SERVER_IP."
CNAME_DOMAIN=".$request->CNAME_DOMAIN."
VERIFY_CNAME=".$request->VERIFY_CNAME."";

  File::append(base_path('.env'),$t);


     
       return response()->json(['System Updated']);


    }
}
