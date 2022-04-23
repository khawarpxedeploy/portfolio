<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Option;
use App\Models\Menu;
use App\Models\Term;
use App\Models\Termmeta;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //this part use for admin panel theme module for default  data
        $options = [
           
            ['id' => '2', 'key' => 'auto_enroll_after_payment', 'value' => 'on'],
            
            ['id' => '4', 'key' => 'cron_option', 'value' => '{"days":10,"alert_message":"Hi, your plan will expire soon","expire_message":"Your plan is expired!","trial_expired_message":"Your free trial is expired!"}'],

            ['id' => '5', 'key' => 'theme_settings', 'value' => '{"asked":[{"question":"Can I cancel my subscription?","answer":"Looked up one of the more obscure Latin words, consecttur, from a Lorem Ipsum passage, and going through the."},{"question":"Frequently Asked Questions","answer":"All the Lorem Ipasum generators on the Internet tend repeat predefined chunks as necessary generator."},{"question":"Can I try your service for free?","answer":"Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of.."},{"question":"Can I update my card details?","answer":"Looked up one of the more obscure Latin words, consecttur, from a Lorem Ipsum passage, and going through the."}]}'],

            ['id' => '6', 'key' => 'seo_home', 'value' => '{"site_name":"Home","matatag":"Home","matadescription":"it is an payment gateway application. you can add your payment gateway keys,id and start using your payment gateway system within 5  within 5 minutes.","twitter_site_title":"home"}'],

            ['id' => '7', 'key' => 'seo_blog', 'value' => '{"site_name":"Blog","matatag":"Blog","matadescription":"it is an payment gateway application. in this page you can view all post recently post form the application","twitter_site_title":"Blog"}'],

            ['id' => '8', 'key' => 'seo_service', 'value' => '{"site_name":"Service","matatag":"Service","matadescription":"it is an payment gateway application. in this page you can view all details about each services","twitter_site_title":"Service"}'],

            ['id' => '9', 'key' => 'seo_contract', 'value' => '{"site_name":"Contact us","matatag":"Contact","matadescription":"it is an payment gateway application. in this page you can view all Contract about the application system","twitter_site_title":"Contract"}'],

            ['id' => '10', 'key' => 'seo_pricing', 'value' => '{"site_name":"Pricing","matatag":"Pricing","matadescription":"it is an payment gateway application. in this page you can view all Contract about the application system","twitter_site_title":"Pricing"}'],

            ['id' => '11', 'key' => 'currency_symbol', 'value' => '$'],

            ['id' => '12', 'key' => 'hero_section', 'value' => '{"title":"dummy text","des":"Millions of companies of all sizes\\u2014from startups to Fortune 500s\\u2014use Stripe\\u2019s software and APIs to accept payments, send payouts, and manage their businesses online.","start_text":"Start Now","start_url":"http:\\\\/\\\\/google.com\\\\/","contact_text":"Contact Sales","contact_url":"http:\\\\/\\\\/google.com\\\\/","image":"uploads\\\\/no-img.png"}'],

            ['id' => '13', 'key' => 'benefit', 'value' => '{"title":"Easy To Install","image":"uploads\\\\/1.svg","excerpt":"No step by step builder. It is so easy, you could also eat cake at the same time :)"}'],

            ['id' => '14', 'key' => 'benefit', 'value' => '{"title":"ATS ready","image":"uploads\\\\/2.svg","excerpt":"A beautiful resume ready for ATS. No more rejections due to formatting errors."}'],

            ['id' => '15', 'key' => 'benefit', 'value' => '{"title":"Import from LinkedIn","image":"uploads\\\\/3.svg","excerpt":"Instead of copy-pasting all your details from LinkedIn, import them."}'],

            ['id' => '16', 'key' => 'benefit', 'value' => '{"title":"Pay Once","image":"uploads\\\\/4.svg","excerpt":"All features with a one time payment. We all have more than enough subscriptions already."}'],

            ['id' => '17', 'key' => 'benefit', 'value' => '{"title":"Protected","image":"uploads\\\\/5.svg","excerpt":"A resume has a lot of personal information. That’s why we paid a lot of attention to protect it from harm."}'],

            ['id' => '18', 'key' => 'benefit', 'value' => '{"title":"Customize","image":"uploads\\\\/6.svg","excerpt":"Change the color, the font, the theme in your resume. This is about you. Make it yours."}'],

            ['id' => '19', 'key' => 'company', 'value' => '{"link":"#","name":"Palmer Richmond","image":"uploads\\\\/company-1.png"}'],
            ['id' => '20', 'key' => 'company', 'value' => '{"link":"#","name":"Palmer Richmond","image":"uploads\\\\/company-2.png"}'],
            ['id' => '21', 'key' => 'company', 'value' => '{"link":"#","name":"Palmer Richmond","image":"uploads\\\\/company-3.png"}'],
            ['id' => '22', 'key' => 'company', 'value' => '{"link":"#","name":"Palmer Richmond","image":"uploads\\\\/company-4.png"}'],
            ['id' => '23', 'key' => 'company', 'value' => '{"link":"#","name":"Palmer Richmond","image":"uploads\\\\/company-5.png"}'],
            ['id' => '24', 'key' => 'company', 'value' => '{"link":"#","name":"Palmer Richmond","image":"uploads\\\\/company-6.png"}'],
           
            ['id' => '27', 'key' => 'config_dns', 'value' => '{"title":"You\'ll need to setup a DNS record to point to your store on our server. DNS records can be setup through your domain registrars control panel. Since every registrar has a different setup, contact them for assistance if you\'re unsure.","footer":"DNS changes may take up to 48-72 hours to take effect, although it\'s normally a lot faster than that. You will receive a reply when your custom domain has been activated. Please allow 1-2 business days for this process to complete."}'],

        ];

        Option::insert($options);

        Option::create([
            'key' => 'tax',
            'value' => 2,
        ]);
        Option::create([
            'key' => 'invoice_prefix',
            'value' => '#',
        ]);
        Option::create([
            'key' => 'curency_name',
            'value' => 'USD',
        ]);
        Option::create([
        
          'key' => 'invoice_mail_messages',
          'value' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
        ]);
        Option::create([
            "key" => "cvlanguage",
            "value" => "{\"bn\":{\"Address\":\"\\u09a0\\u09bf\\u0995\\u09be\\u09a8\\u09be\",\"About_Me\":\"\\u0986\\u09ae\\u09be\\u09b0 \\u09b8\\u09ae\\u09cd\\u09aa\\u09b0\\u09cd\\u0995\\u09c7\",\"Contact\":\"\\u09af\\u09cb\\u0997\\u09be\\u09af\\u09cb\\u0997\",\"Skills\":\"\\u09a6\\u0995\\u09cd\\u09b7\\u09a4\\u09be\",\"Language\":\"\\u09ad\\u09be\\u09b7\\u09be\",\"Custom_Section\":\"\\u0995\\u09be\\u09b8\\u09cd\\u099f\\u09ae \\u09ac\\u09bf\\u09ad\\u09be\\u0997\",\"Education\":\"\\u09b6\\u09bf\\u0995\\u09cd\\u09b7\\u09be\",\"Accomplishments\":\"\\u09b8\\u09be\\u09ab\\u09b2\\u09cd\\u09af\",\"Experience\":\"\\u0985\\u09ad\\u09bf\\u099c\\u09cd\\u099e\\u09a4\\u09be\",\"References\":\"\\u09a4\\u09a5\\u09cd\\u09af\\u09b8\\u09c2\\u09a4\\u09cd\\u09b0\"},\"af\":{\"Address\":\"Addressdfgsdfgdf\",\"About_Me\":\"About Me\",\"Contact\":\"dsfgfdggdContact\",\"Skills\":\"Skillsgfdgdf\",\"Language\":\"Languagegdfgsd\",\"Custom_Section\":\"Custom Sectifgfdgdgdon\",\"Education\":\"Educationfgdfg\",\"Accomplishments\":\"dgdfgdfgAccomplishments\",\"Experience\":\"Exp\",\"References\":\"Referencdfgdsfges\"},\"aa\":{\"Address\":\"Address\",\"About_Me\":\"About Me99\",\"Contact\":\"Contact99\",\"Skills\":\"Skills99\",\"Language\":\"Language99\",\"Custom_Section\":\"Custom Section\",\"Education\":\"Education99\",\"Accomplishments\":\"Accomplishments99\",\"Experience\":\"Experience99\",\"References\":\"References99\"},\"ab\":{\"Address\":\"Address\",\"About_Me\":\"About Me\",\"Contact\":\"Contact\",\"Skills\":\"Skills\",\"Language\":\"Language\",\"Custom_Section\":\"Custom Section\",\"Education\":\"Education\",\"Accomplishments\":\"Accomplishments\",\"Experience\":\"Experience\",\"References\":\"References\"},\"en\":{\"Address\":\"Address\",\"About_Me\":\"About Me\",\"Contact\":\"Contact\",\"Skills\":\"Skills\",\"Language\":\"Language\",\"Custom_Section\":\"Custom Section\",\"Education\":\"Education\",\"Accomplishments\":\"Accomplishments\",\"Experience\":\"Experience\",\"References\":\"References\"}}",
        ]);

        Option::create([
            "key" => "basic_settings",
            "value"=>'{"address":"Ea aut qui autem pos","email":"zanatyfe@mailinator.com","theme_color":"#6e28fa","social":[{"icon":"ri:facebook-fill","link":"#"},{"icon":"ri:twitter-fill","link":"#"},{"icon":"ri:google-fill","link":"#"},{"icon":"ri:instagram-fill","link":"#"},{"icon":"ri:pinterest-fill","link":"#"}]}'
             ]); 

        

        $languages = [
            [
                "name" => "en",
                "position" => null,
                "data" => "English",
                "type" => "web",
                "status" => 1,
                "created_at" => "2021-06-07 05:58:48",
                "updated_at" => "2021-06-07 05:58:48",
            ],
            [
                "name" => "aa",
                "position" => "",
                "data" => "Afar",
                "type" => "cv",
                "status" => 1,
                "created_at" => "2021-06-07 09:22:17",
                "updated_at" => "2021-06-07 09:22:17",
            ],
            [
                "name" => "af",
                "position" => "",
                "data" => "Afrikaans",
                "type" => "cv",
                "status" => 1,
                "created_at" => "2021-06-07 09:22:35",
                "updated_at" => "2021-06-07 09:22:35",
            ],
            [
                "name" => "bn",
                "position" => "",
                "data" => "Bengali",
                "type" => "cv",
                "status" => 1,
                "created_at" => "2021-06-07 11:39:35",
                "updated_at" => "2021-06-07 11:39:35",
            ],
        ];
        
        Language::insert($languages);

        $menu = [
            [
                "id" => 1,
                "name" => "Header",
                "position" => "header",
                "data" => "[{\"text\":\"Home\",\"href\":\"/\",\"icon\":\"\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Templates\",\"href\":\"#\",\"icon\":\"\",\"target\":\"_self\",\"title\":\"\",\"children\":[{\"text\":\"Portfolio Templates\",\"href\":\"/templates/portfolio\",\"icon\":\"\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Online Resume Templates\",\"href\":\"/templates/resume\",\"icon\":\"\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"V-Card Templates\",\"href\":\"/templates/vcard\",\"icon\":\"\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"Pricing\",\"href\":\"pricing\",\"icon\":\"\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Blog\",\"href\":\"/blogs\",\"icon\":\"\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Contact\",\"href\":\"/contact\",\"icon\":\"\",\"target\":\"_self\",\"title\":\"\"}]",
                "lang" => "en",
                "status" => 1,
                "created_at" => "2021-08-06 04:50:26",
                "updated_at" => "2021-08-06 04:50:26"
            ],
            [
                "id" => 3,
                "name" => "Explore",
                "position" => "footer_left",
                "data" => "[{\"text\":\"About Us\",\"icon\":\"\",\"href\":\"/about\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Help\",\"icon\":\"\",\"href\":\"/contact\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Contact\",\"icon\":\"\",\"href\":\"/contact\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"My Account\",\"icon\":\"\",\"href\":\"/user/dashboard\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Pricing Packages\",\"icon\":\"\",\"href\":\"/pricing\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"User Dashboard\",\"icon\":\"\",\"href\":\"/user/dashboard\",\"target\":\"_self\",\"title\":\"\"}]",
                "lang" => "en",
                "status" => 1,
                "created_at" => "2021-08-06 04:58:59",
                "updated_at" => "2021-08-06 05:08:00"
            ],
            [
                "id" => 4,
                "name" => "Information",
                "position" => "footer_right",
                "data" => "[{\"text\":\"Policy\",\"icon\":\"\",\"href\":\"#policy\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Service Policy\",\"icon\":\"\",\"href\":\"#service_policy\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Refund Policy\",\"icon\":\"\",\"href\":\"#refund_policy\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Tools\",\"icon\":\"\",\"href\":\"#tools\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Community \",\"icon\":\"\",\"href\":\"/contact\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Blog\",\"icon\":\"\",\"href\":\"/blog\",\"target\":\"_self\",\"title\":\"\"}]",
                "lang" => "en",
                "status" => 1,
                "created_at" => "2021-08-06 05:14:39",
                "updated_at" => "2021-08-06 05:42:49"
            ]
        ];

        Menu::insert($menu);


        $blogs = [
            [
                "id" => 1,
                "title" => "Is it available for custom domain?",
                "slug" => "is-it-available-for-custom-domain",
                "type" => "blog",
                "status" => 1,
                "featured" => 1,
                "created_at" => "2021-07-24 03:25:45",
                "updated_at" => "2021-07-24 03:25:45"
            ],
            [
                "id" => 2,
                "title" => "Here we have a CV builder to build an awesome CV.",
                "slug" => "here-we-have-a-cv-builder-to-build-an-awesome-cv-2",
                "type" => "blog",
                "status" => 1,
                "featured" => 1,
                "created_at" => "2021-07-24 03:40:42",
                "updated_at" => "2021-07-24 03:42:35"
            ],
            [
                "id" => 3,
                "title" => "What is the different between Regular & Extends License?",
                "slug" => "what-is-the-different-between-regular-extends-license",
                "type" => "blog",
                "status" => 1,
                "featured" => 1,
                "created_at" => "2021-07-24 06:32:56",
                "updated_at" => "2021-07-24 06:32:56"
            ],
            [
                "id" => 8,
                "title" => "uploads/template/21/07/1706233972323751.png",
                "slug" => "/profile/user",
                "type" => "portfolio_template",
                "status" => 1,
                "featured" => 0,
                "created_at" => "2021-07-25 05:38:37",
                "updated_at" => "2021-07-25 05:38:37"
            ],
            [
                "id" => 9,
                "title" => "uploads/template/21/07/1706233982372147.png",
                "slug" => "/profile/user",
                "type" => "portfolio_template",
                "status" => 1,
                "featured" => 0,
                "created_at" => "2021-07-25 05:38:46",
                "updated_at" => "2021-07-25 05:38:46"
            ],
            [
                "id" => 10,
                "title" => "uploads/template/21/07/1706233990587122.png",
                "slug" => "/profile/user",
                "type" => "portfolio_template",
                "status" => 1,
                "featured" => 0,
                "created_at" => "2021-07-25 05:38:54",
                "updated_at" => "2021-07-25 05:38:54"
            ],
            [
                "id" => 11,
                "title" => "uploads/template/21/07/1706233998995359.png",
                "slug" => "/profile/user",
                "type" => "portfolio_template",
                "status" => 1,
                "featured" => 0,
                "created_at" => "2021-07-25 05:39:02",
                "updated_at" => "2021-07-25 05:39:02"
            ],
            [
                "id" => 12,
                "title" => "uploads/template/21/07/1706237425176093.png",
                "slug" => "/profile/user",
                "type" => "resume_template",
                "status" => 1,
                "featured" => 0,
                "created_at" => "2021-07-25 06:33:30",
                "updated_at" => "2021-07-25 06:33:30"
            ],
            [
                "id" => 13,
                "title" => "uploads/template/21/07/1706237441024926.png",
                "slug" => "/profile/user",
                "type" => "resume_template",
                "status" => 1,
                "featured" => 0,
                "created_at" => "2021-07-25 06:33:45",
                "updated_at" => "2021-07-25 06:33:45"
            ],
            [
                "id" => 14,
                "title" => "uploads/template/21/07/1706237450167797.png",
                "slug" => "/profile/user",
                "type" => "resume_template",
                "status" => 1,
                "featured" => 0,
                "created_at" => "2021-07-25 06:33:53",
                "updated_at" => "2021-07-25 06:33:53"
            ],
            [
                "id" => 15,
                "title" => "uploads/template/21/07/1706237463681744.png",
                "slug" => "/profile/user",
                "type" => "resume_template",
                "status" => 1,
                "featured" => 0,
                "created_at" => "2021-07-25 06:34:06",
                "updated_at" => "2021-07-25 06:34:06"
            ],
            [
                "id" => 17,
                "title" => "uploads/template/21/07/1706238011826706.png",
                "slug" => "/profile/user",
                "type" => "vcard_template",
                "status" => 1,
                "featured" => 0,
                "created_at" => "2021-07-25 06:42:49",
                "updated_at" => "2021-07-25 06:42:49"
            ],
            [
                "id" => 18,
                "title" => "uploads/template/21/07/1706238019885428.png",
                "slug" => "/profile/user",
                "type" => "vcard_template",
                "status" => 1,
                "featured" => 0,
                "created_at" => "2021-07-25 06:42:57",
                "updated_at" => "2021-07-25 06:42:57"
            ],
            [
                "id" => 19,
                "title" => "terms and conditions",
                "slug" => "terms-and-conditions",
                "type" => "page",
                "status" => 1,
                "featured" => 0,
                "created_at" => now(),
                "updated_at" => now()
            ],

        ];




        Term::insert($blogs);


        $blogmeta = [
            [
                "id" => 1,
                "term_id" => 1,
                "key" => "excerpt",
                "value" => "It is a multitenancy-based laravel script. Here you can add your own custom domain by add DNS record to your hosting."
            ],
            [
                "id" => 2,
                "term_id" => 1,
                "key" => "thum_image",
                "value" => "uploads/blog/21/07/1706135016897462.jpeg"
            ],
            [
                "id" => 3,
                "term_id" => 1,
                "key" => "description",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            ],
            [
                "id" => 4,
                "term_id" => 2,
                "key" => "excerpt",
                "value" => "If you want to create an awesome CV then porichoy will help you to do it. Here we have multiple themes."
            ],
            [
                "id" => 5,
                "term_id" => 2,
                "key" => "thum_image",
                "value" => "uploads/blog/21/07/1706135956927462.jpeg"
            ],
            [
                "id" => 6,
                "term_id" => 2,
                "key" => "description",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            ],
            [
                "id" => 7,
                "term_id" => 3,
                "key" => "excerpt",
                "value" => "Use, by you or one client, in a single end product which end users are not  charged for. The total price includes the item price and a buyer fee."
            ],
            [
                "id" => 8,
                "term_id" => 3,
                "key" => "thum_image",
                "value" => "uploads/blog/21/07/1706146793168439.jpeg"
            ],
            [
                "id" => 9,
                "term_id" => 3,
                "key" => "description",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            ],
            [
                "id" => 10,
                "term_id" => 19,
                "key" => "excerpt",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            ],
            [
                "id" => 11,
                "term_id" => 19,
                "key" => "description",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            ]
        ];

        Termmeta::insert($blogmeta);

        Option::create([
            'key'=>'site_key',
            'value'=>env('AUTHORIZED_KEY')
        ]);

    }
    
}
