<?php

namespace Database\Seeders;

use App\Models\Usermeta;
use App\Models\Useroption;
use Illuminate\Database\Seeder;

class UserOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $useroptions = [
            [
                "id" => 1,
                "user_id" => 2,
                "key" => "about_me",
                "value" => '{"cv":"null","image":"uploads\/author.jpg","description":"<font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">Lorem ipsum dolor sit amet,<\/font> consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerc<b>itation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in r<\/b>eprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.","name":"Lacy Mcgee","main_profession":"WEB DEVELOPER","second_profession":"FREELANCER","job_location":"based in Los Angeles, USA.","signature":"uploads\/signature.png"}'
            ],
            [
                "id" => 2,
                "user_id" => 2,
                "key" => "site_settings",
                "value" => "{\"tagline\":[\"Web Developer\",\"Laravel Developer\",\"Graphic Design\"],\"hire\":\"\/contact\",\"social\":[{\"icon\":\"fab fa-facebook\",\"link\":\"#\"},{\"icon\":\"fab fa-twitter\",\"link\":\"#\"},{\"icon\":\"fab fa-google\",\"link\":\"#\"},{\"icon\":\"fab fa-instagram\",\"link\":\"#\"},{\"icon\":\"fab fa-linkedin\",\"link\":\"#\"}],\"counter\":[{\"icon\":\"fas fa-headset\",\"label\":\"Happy Clients\",\"count\":\"250K+\"},{\"icon\":\"fas fa-project-diagram\",\"label\":\"Project Complete\",\"count\":\"590K+\"},{\"icon\":\"fas fa-calendar-alt\",\"label\":\"Years of Experience\",\"count\":\"28+\"}],\"title_about\":\"I Am Arafat Hossain\",\"about_description\":\"Hi! There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.\",\"cv_url\":\"#\",\"full_name\":\"Arafat Hossain\",\"experience\":\"Laravel Developer\",\"age\":\"21\",\"email\":\"help.amcoders@gmail.com\",\"hero_img\":\"uploads\/2\/hero_img.png\",\"about_img\":\"uploads\/2\/about_img.png\",\"service_title\":\"SERVICES & SOLUTIONS\",\"hero_title\":\"Hello, I am a\",\"hero_description\":\"UI\/UX Designer specializing in Shopify & Webflow.\",\"service_description\":\"Lorem Ipsum Dolor Sit Amet, Consectetur Adipisicing Elit. Sint Ratione Reprehenderit, Error Qui Enim Sit Ex Provident\",\"portoflio_title\":\"PORTFOLIO TEMPLATES\",\"portoflio_description\":\"Lorem Ipsum Dolor Sit Amet, Consectetur Adipisicing Elit. Sint Ratione Reprehenderit, Error Qui Enim Sit Ex Provident\",\"blog_title\":\"NEWS & BLOGS\",\"blog_description\":\"Lorem Ipsum Dolor Sit Amet, Consectetur Adipisicing Elit. Sint Ratione Reprehenderit, Error Qui Enim Sit Ex Provident\",\"contact_title\":\"CONTACT US\",\"contact_description\":\"Lorem Ipsum Dolor Sit Amet, Consectetur Adipisicing Elit. Sint Ratione Reprehenderit, Error Qui Enim Sit Ex Provident\",\"education_title\":\"EDUCATION & EXPERI...\",\"education_description\":\"Lorem Ipsum Dolor Sit Amet, Consectetur Adipisicing Elit. Sint Ratione Reprehenderit, Error Qui Enim Sit Ex Provident\",\"testimonial_title\":\"Rating & Reviews\",\"testimonial_description\":\"Lorem Ipsum Dolor Sit Amet, Consectetur Adipisicing Elit. Sint Ratione Reprehenderit, Error Qui Enim Sit Ex Provident\"}"
            ],
            [
                "id" => 3,
                "user_id" => 2,
                "key" => "vcard",
                "value" => "{\"theme\":\"vcard\/business\",\"color\":\"#2e3638\",\"slug\":\"sit-eos-eum-in-conse\",\"name\":\"Mr. Paul\",\"tagline\":\"developer\",\"description\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making\",\"profile_image_url\":\"uploads\/customer\/2\/seed\/about_me.jpg\",\"cover_image_url\":\"uploads\/customer\/2\/seed\/author-cover.jpg\",\"social\":[{\"field_name\":\"Whatsapp\",\"value\":\"+8801873343468\",\"label\":\"Whatsapp\",\"type\":\"whatsapp\"},{\"field_name\":\"Snapchat\",\"value\":\"mr paul\",\"label\":\"shanpchat\",\"type\":\"snapchat\"},{\"field_name\":\"Linkedin\",\"value\":\"mr paul\",\"label\":\"linkedin\",\"type\":\"linkedin\"},{\"field_name\":\"Email\",\"value\":\"mrpaul@gmail.com\",\"label\":\"email\",\"type\":\"email\"}]}"
            ]
        ];

        Useroption::insert($useroptions);

        $usermeta = [
            [
                "id" => 1,
                "user_id" => 2,
                "key" => "cv",
                "value" => "{\"theme\":\"cv\/theme5\",\"color\":\"#ffffff\",\"mode\":\"light\",\"cvlanguage\":\"en\",\"name\":\"John Doe\",\"role\":\"Graphic & Web Developer\",\"about\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident odio dolores perspiciatis nulla veritatis nisi ab nihil totam praesentium quas, atque, dolorem autem corporis molestias. Beatae dignissimos voluptatibus accusamus! Laboriosam.\",\"experience\":[{\"company\":\"Ross and Daugherty LLC\",\"role\":\"Developer\",\"duration\":\"2018-2020\",\"type\":\"2\",\"description\":\"Developer\"},{\"company\":\"Meyers and Preston Trading\",\"role\":\"Developer\",\"duration\":\"2020-present\",\"type\":\"2\",\"description\":\"Developer\"}],\"contact\":[{\"key\":\"linkedin\",\"value\":\"test-test\"},{\"key\":\"contact\",\"value\":\"01954137632\"},{\"key\":\"email\",\"value\":\"test@test.com\"},{\"key\":\"website\",\"value\":\"test.com\"},{\"key\":\"github\",\"value\":\"testing.git\"}],\"skill\":[\"Communication\",\"Decission\",\"Time\",\"Self\"],\"education\":[{\"degree\":\"Bachelor\",\"duration\":\"2018-2020\",\"institute\":\"Dhaka\",\"description\":\"Bachelor of Creative Arts.\"},{\"degree\":\"Master\",\"duration\":\"2024-2028\",\"institute\":\"North\",\"description\":\"Officia ea ipsum ita\"}],\"image\":\"\/uploads\/placeholder-profile.png\"}"
            ]
        ];

        Usermeta::insert($usermeta);

    }
}
