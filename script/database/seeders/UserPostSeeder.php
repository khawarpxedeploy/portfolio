<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Categorymeta;
use App\Models\Post;
use App\Models\Postmeta;
use Illuminate\Database\Seeder;

class UserPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                "id" => 1,
                "name" => "Admin",
                "slug" => "admin",
                "type" => "category",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 2,
                "name" => "Writer",
                "slug" => "writer",
                "type" => "category",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 3,
                "name" => "Admin",
                "slug" => "admin",
                "type" => "service_category",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 4,
                "name" => "Writer",
                "slug" => "writer",
                "type" => "service_category",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 5,
                "name" => "Clemira talita",
                "slug" => "",
                "type" => "testimonial",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 13:57:13",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 6,
                "name" => "Peter park",
                "slug" => "",
                "type" => "testimonial",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 14:02:57",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 8,
                "name" => "work_process",
                "slug" => null,
                "type" => "work_process",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 9,
                "name" => "work_process",
                "slug" => null,
                "type" => "work_process",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 10,
                "name" => "work_process",
                "slug" => null,
                "type" => "work_process",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 11,
                "name" => "my_team",
                "slug" => null,
                "type" => "my_team",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 12,
                "name" => "my_team",
                "slug" => null,
                "type" => "my_team",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 13,
                "name" => "my_team",
                "slug" => null,
                "type" => "my_team",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 14,
                "name" => "education",
                "slug" => null,
                "type" => "education",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 15,
                "name" => "education",
                "slug" => null,
                "type" => "education",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 16,
                "name" => "education",
                "slug" => null,
                "type" => "education",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 18,
                "name" => "Web Design ",
                "slug" => null,
                "type" => "skill",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 19,
                "name" => "Logo Design",
                "slug" => null,
                "type" => "skill",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 20,
                "name" => "Web App",
                "slug" => null,
                "type" => "skill",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 21,
                "name" => "Junior UX Designer",
                "slug" => null,
                "type" => "experience",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 13:24:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 22,
                "name" => "UX & UI Designer",
                "slug" => null,
                "type" => "experience",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ],
            [
                "id" => 23,
                "name" => "Senior UI Designer",
                "slug" => null,
                "type" => "experience",
                "featured" => 0,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:16:08",
                "user_id" => 2,
                "p_id" => null
            ]
        ];

        Category::insert($category);

        $categorymeta = [
            [
                "id" => 1,
                "category_id" => 5,
                "key" => "testimonial_meta",
                "value" => '{"avatar":"uploads\/2\/testimonial\/1\/21\/08\/1707443463100031.png","position":"Owner, Startup marketplace","review":"Wow is all i can say! Manvir did an absolute fenominal job from start to finish! He captured and created exactly what I wanted and exceeded my expectation. Highly recommend manvir!"}'
            ],
            [
                "id" => 2,
                "category_id" => 6,
                "key" => "testimonial_meta",
                "value" => '{"avatar":"uploads\/2\/testimonial\/1\/21\/08\/1707443463100031.png","position":"Owner, Startup marketplace","review":"Wow is all i can say! Manvir did an absolute fenominal job from start to finish! He captured and created exactly what I wanted and exceeded my expectation. Highly recommend manvir!"}'
            ],
            [
                "id" => 4,
                "category_id" => 8,
                "key" => "work_process_meta",
                "value" => "{\"title\":\"Research and Plan\",\"icon\":\"fas fa-paper-plane\",\"des\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\"}"
            ],
            [
                "id" => 5,
                "category_id" => 9,
                "key" => "work_process_meta",
                "value" => "{\"title\":\"Design and Develop\",\"icon\":\"fab fa-connectdevelop\",\"des\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\"}"
            ],
            [
                "id" => 6,
                "category_id" => 10,
                "key" => "work_process_meta",
                "value" => "{\"title\":\"Deliver\",\"icon\":\"fab fa-page4\",\"des\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\"}"
            ],
            [
                "id" => 7,
                "category_id" => 11,
                "key" => "my_team_meta",
                "value" => "{\"avatar\":\"uploads\/member-1.png\",\"position\":\"Project Manager\",\"name\":\"Jack Schenziwe\"}"
            ],
            [
                "id" => 8,
                "category_id" => 12,
                "key" => "my_team_meta",
                "value" => "{\"avatar\":\"uploads\/member-2.png\",\"position\":\"CEO\",\"name\":\"Jack Kan\"}"
            ],
            [
                "id" => 9,
                "category_id" => 13,
                "key" => "my_team_meta",
                "value" => "{\"avatar\":\"uploads\/member-3.png\",\"position\":\"Worker\",\"name\":\"Jack Min\"}"
            ],
            [
                "id" => 10,
                "category_id" => 14,
                "key" => "education_meta",
                "value" => "{\"starting_date\":\"2004-10-17\",\"ending_date\":\"2006-01-20\",\"subject\":\"Marters in UX Design\",\"university\":\"Masassusets Institute of Technology\",\"short_content\":\"hasellus ipsum metus, gravida sit amet sollicitudin ac, efficitur eget risus. Curabitur commodo malesuada neque at hendrerit.\"}"
            ],
            [
                "id" => 11,
                "category_id" => 15,
                "key" => "education_meta",
                "value" => "{\"starting_date\":\"2000-10-17\",\"ending_date\":\"2003-01-20\",\"subject\":\"Honours in Fine Arts\",\"university\":\"Harvard University\",\"short_content\":\"hasellus ipsum metus, gravida sit amet sollicitudin ac, efficitur eget risus. Curabitur commodo malesuada neque at hendrerit.\"}"
            ],
            [
                "id" => 12,
                "category_id" => 16,
                "key" => "education_meta",
                "value" => "{\"starting_date\":\"1996-10-17\",\"ending_date\":\"2000-01-20\",\"subject\":\"Higher Secondary Certificat\",\"university\":\"Cardiff School\",\"short_content\":\"hasellus ipsum metus, gravida sit amet sollicitudin ac, efficitur eget risus. Curabitur commodo malesuada neque at hendrerit.\"}"
            ],
            [
                "id" => 14,
                "category_id" => 18,
                "key" => "skill_meta",
                "value" => "{\"level\":\"67\",\"color\":\"#90a7f2\"}"
            ],
            [
                "id" => 15,
                "category_id" => 19,
                "key" => "skill_meta",
                "value" => "{\"level\":\"69\",\"color\":\"#000040\"}"
            ],
            [
                "id" => 16,
                "category_id" => 20,
                "key" => "skill_meta",
                "value" => "{\"level\":\"57\",\"color\":\"#6bf2f6\"}"
            ],
            [
                "id" => 17,
                "category_id" => 21,
                "key" => "experience_meta",
                "value" => "{\"icon\":\"fas fa-adjust\",\"start_date\":\"2010-07-09\",\"end_date\":\"2015-11-13\",\"description\":\"hasellus ipsum metus, gravida sit amet sollicitudin ac, efficitur eget risus. Curabitur commodo male\",\"company\":null}"
            ],
            [
                "id" => 18,
                "category_id" => 22,
                "key" => "experience_meta",
                "value" => "{\"icon\":\"fas fa-adjust\",\"start_date\":\"2009-07-09\",\"end_date\":\"2014-11-13\",\"description\":\"hasellus ipsum metus, gravida sit amet sollicitudin ac, efficitur eget risus. Curabitur commodo male\",\"company\":null}"
            ],
            [
                "id" => 19,
                "category_id" => 23,
                "key" => "experience_meta",
                "value" => "{\"icon\":\"fas fa-adjust\",\"start_date\":\"2015-07-09\",\"end_date\":\"2020-09-25\",\"description\":\"hasellus ipsum metus, gravida sit amet sollicitudin ac, efficitur eget risus. Curabitur commodo male\",\"company\":null}"
            ]
        ];

        Categorymeta::insert($categorymeta);

        $posts =  [
            [
                "id" => 1,
                "title" => "The Stone of the Flames",
                "slug" => "the-stone-of-the-flames",
                "type" => "blog",
                "featured" => 0,
                "user_id" => 2,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 14:17:02"
            ],
            [
                "id" => 2,
                "title" => "Poor - Non Profit PSD Template",
                "slug" => "lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit",
                "type" => "project",
                "featured" => 0,
                "user_id" => 2,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 13:34:07"
            ],
            [
                "id" => 3,
                "title" => "DESIGN PRINCIPALES",
                "slug" => "design-principales",
                "type" => "service",
                "featured" => 0,
                "user_id" => 2,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:34:27"
            ],
            [
                "id" => 4,
                "title" => "UNIQUE VALUES",
                "slug" => "unique-values",
                "type" => "service",
                "featured" => 0,
                "user_id" => 2,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:35:49"
            ],
            [
                "id" => 5,
                "title" => "STYLE COMPONENTS",
                "slug" => "style-components",
                "type" => "service",
                "featured" => 0,
                "user_id" => 2,
                "created_at" => "2021-08-07 11:16:08",
                "updated_at" => "2021-08-07 11:36:23"
            ],
            [
                "id" => 6,
                "title" => "Garden - Gardening Website Template",
                "slug" => "garden-gardening-website-template",
                "type" => "project",
                "featured" => 0,
                "user_id" => 2,
                "created_at" => "2021-08-07 13:35:23",
                "updated_at" => "2021-08-07 13:35:23"
            ],
            [
                "id" => 7,
                "title" => "The Stone of the Flames",
                "slug" => "the-stone-of-the-flames",
                "type" => "blog",
                "featured" => 0,
                "user_id" => 2,
                "created_at" => "2021-08-07 14:20:28",
                "updated_at" => "2021-08-07 14:20:28"
            ],
            [
                "id" => 8,
                "title" => "The Stone of the Flames",
                "slug" => "the-stone-of-the-flames",
                "type" => "blog",
                "featured" => 0,
                "user_id" => 2,
                "created_at" => "2021-08-07 14:21:17",
                "updated_at" => "2021-08-07 14:21:17"
            ]
        ];

        Post::insert($posts);

        $postsmeta = [
            [
                "id" => 1,
                "post_id" => 1,
                "key" => "excerpt",
                "value" => "Lorem ipsum dolor sit amet consectetur adipiscing elit"
            ],
            [
                "id" => 2,
                "post_id" => 1,
                "key" => "thum_image",
                "value" => "uploads/2/blog/1/21/08/1707444349541558.jpg"
            ],
            [
                "id" => 3,
                "post_id" => 1,
                "key" => "description",
                "value" => "Proin ac condimentum est, vel lacinia nibh. Morbi at velit pharetra, egestas augue vitae, viverra elit. Cras lobortis eget ligula sed suscipit. Vivamus bibendum, enim nec euismod commodo, mi ex ullamcorper tortor, in interdum dolor metus sed enim. Nullam aliquet ex vel porta vestibulum. Morbi rhoncus neque felis"
            ],
            [
                "id" => 4,
                "post_id" => 2,
                "key" => "thum_image",
                "value" => "uploads/2/project/21/08/1707441649368864.jpg"
            ],
            [
                "id" => 5,
                "post_id" => 2,
                "key" => "link",
                "value" => "/"
            ],
            [
                "id" => 6,
                "post_id" => 3,
                "key" => "excerpt",
                "value" => "Need A Project Completed By An Expert? Let’s Go! Access A Human Resources Consultant To Answer Questions"
            ],
            [
                "id" => 7,
                "post_id" => 3,
                "key" => "thum_image",
                "value" => "uploads/2/user-service-logo/1/21/08/1707434120571334.svg"
            ],
            [
                "id" => 8,
                "post_id" => 3,
                "key" => "icon",
                "value" => "fas fa-history"
            ],
            [
                "id" => 9,
                "post_id" => 3,
                "key" => "description",
                "value" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel mauris at mi eleifend malesuada sit amet vel sem. Nulla semper nisl elit, nec condimentum mauris tincidunt nec. Mauris sed lectus et nunc porta bibendum sit amet sed metus. Cras mattis laoreet diam, a aliquet purus finibus non. Maecenas nec sapien ac nibh viverra hendrerit vel et neque. Maecenas nisi erat, molestie condimentum massa vel, rhoncus venenatis justo. Aliquam nec ante maximus, tincidunt nisl at, placerat erat. Maecenas neque massa, suscipit nec venenatis ut, malesuada quis velit.
    
            Proin ac condimentum est, vel lacinia nibh. Morbi at velit pharetra, egestas augue vitae, viverra elit. Cras lobortis eget ligula sed suscipit. Vivamus bibendum, enim nec euismod commodo, mi ex ullamcorper tortor, in interdum dolor metus sed enim. Nullam aliquet ex vel porta vestibulum. Morbi rhoncus neque felis, tristique imperdiet elit rutrum non. Vestibulum ultricies suscipit magna vitae iaculis. Nulla sit amet nunc ultrices, rhoncus purus in, feugiat eros. Aenean hendrerit gravida elementum. Cras consequat sem ligula, non porta sapien luctus congue. Nam vel commodo lectus."
            ],
            [
                "id" => 10,
                "post_id" => 4,
                "key" => "excerpt",
                "value" => "Need A Project Completed By An Expert? Let’s Go! Access A Human Resources Consultant To Answer Questions"
            ],
            [
                "id" => 11,
                "post_id" => 4,
                "key" => "thum_image",
                "value" => "uploads/2/user-service-logo/1/21/08/1707434205808746.svg"
            ],
            [
                "id" => 12,
                "post_id" => 4,
                "key" => "icon",
                "value" => "fas fa-vector-square"
            ],
            [
                "id" => 13,
                "post_id" => 4,
                "key" => "description",
                "value" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel mauris at mi eleifend malesuada sit amet vel sem. Nulla semper nisl elit, nec condimentum mauris tincidunt nec. Mauris sed lectus et nunc porta bibendum sit amet sed metus. Cras mattis laoreet diam, a aliquet purus finibus non. Maecenas nec sapien ac nibh viverra hendrerit vel et neque. Maecenas nisi erat, molestie condimentum massa vel, rhoncus venenatis justo. Aliquam nec ante maximus, tincidunt nisl at, placerat erat. Maecenas neque massa, suscipit nec venenatis ut, malesuada quis velit.
    
            Proin ac condimentum est, vel lacinia nibh. Morbi at velit pharetra, egestas augue vitae, viverra elit. Cras lobortis eget ligula sed suscipit. Vivamus bibendum, enim nec euismod commodo, mi ex ullamcorper tortor, in interdum dolor metus sed enim. Nullam aliquet ex vel porta vestibulum. Morbi rhoncus neque felis, tristique imperdiet elit rutrum non. Vestibulum ultricies suscipit magna vitae iaculis. Nulla sit amet nunc ultrices, rhoncus purus in, feugiat eros. Aenean hendrerit gravida elementum. Cras consequat sem ligula, non porta sapien luctus congue. Nam vel commodo lectus."
            ],
            [
                "id" => 14,
                "post_id" => 5,
                "key" => "excerpt",
                "value" => "Need A Project Completed By An Expert? Let’s Go! Access A Human Resources Consultant To Answer Questions"
            ],
            [
                "id" => 15,
                "post_id" => 5,
                "key" => "thum_image",
                "value" => "uploads/2/user-service-logo/1/21/08/1707434242021169.svg"
            ],
            [
                "id" => 16,
                "post_id" => 5,
                "key" => "icon",
                "value" => "fas fa-solar-panel"
            ],
            [
                "id" => 17,
                "post_id" => 5,
                "key" => "description",
                "value" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel mauris at mi eleifend malesuada sit amet vel sem. Nulla semper nisl elit, nec condimentum mauris tincidunt nec. Mauris sed lectus et nunc porta bibendum sit amet sed metus. Cras mattis laoreet diam, a aliquet purus finibus non. Maecenas nec sapien ac nibh viverra hendrerit vel et neque. Maecenas nisi erat, molestie condimentum massa vel, rhoncus venenatis justo. Aliquam nec ante maximus, tincidunt nisl at, placerat erat. Maecenas neque massa, suscipit nec venenatis ut, malesuada quis velit.
    
            Proin ac condimentum est, vel lacinia nibh. Morbi at velit pharetra, egestas augue vitae, viverra elit. Cras lobortis eget ligula sed suscipit. Vivamus bibendum, enim nec euismod commodo, mi ex ullamcorper tortor, in interdum dolor metus sed enim. Nullam aliquet ex vel porta vestibulum. Morbi rhoncus neque felis, tristique imperdiet elit rutrum non. Vestibulum ultricies suscipit magna vitae iaculis. Nulla sit amet nunc ultrices, rhoncus purus in, feugiat eros. Aenean hendrerit gravida elementum. Cras consequat sem ligula, non porta sapien luctus congue. Nam vel commodo lectus."
            ],
            [
                "id" => 18,
                "post_id" => 6,
                "key" => "thum_image",
                "value" => "uploads/2/project/21/08/1707441728275716.jpg"
            ],
            [
                "id" => 19,
                "post_id" => 6,
                "key" => "link",
                "value" => "/"
            ],
            [
                "id" => 20,
                "post_id" => 7,
                "key" => "excerpt",
                "value" => "Simply dummy textht the prihntig and tyesetting industry. Lorem Ipsum has been."
            ],
            [
                "id" => 21,
                "post_id" => 7,
                "key" => "thum_image",
                "value" => "uploads/2/blog/1/21/08/1707444564987762.jpg"
            ],
            [
                "id" => 22,
                "post_id" => 7,
                "key" => "description",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            ],
            [
                "id" => 23,
                "post_id" => 8,
                "key" => "excerpt",
                "value" => "Simply dummy textht the prihntig and tyesetting industry. Lorem Ipsum has been."
            ],
            [
                "id" => 24,
                "post_id" => 8,
                "key" => "thum_image",
                "value" => "uploads/2/blog/1/21/08/1707444616044622.jpg"
            ],
            [
                "id" => 25,
                "post_id" => 8,
                "key" => "description",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            ]
        ];

        Postmeta::insert($postsmeta);
    }
}
