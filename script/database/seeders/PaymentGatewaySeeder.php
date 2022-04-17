<?php

namespace Database\Seeders;

use App\Models\Getway;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $getways = array(
        array('id' => '1','name' => 'paypal','logo' => 'uploads/21/04/1698367938881552.png','rate' => '10','charge' => '2','namespace' => 'App\\Lib\\Paypal','currency_name' => 'USD','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '0','data' => '{"client_id":"","client_secret":""}','created_at' => '2021-04-15 02:44:46','updated_at' => '2021-04-15 02:44:46'),

        array('id' => '2','name' => 'stripe','logo' => 'uploads/21/04/1698367948712217.png','rate' => '10','charge' => '2','namespace' => 'App\\Lib\\Stripe','currency_name' => 'usd','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '0','data' => '{"publishable_key":"","secret_key":""}','created_at' => '2021-04-15 02:44:46','updated_at' => '2021-04-15 02:44:46'),

        array('id' => '3','name' => 'mollie','logo' => 'uploads/21/04/1698367959065956.png','rate' => '10','charge' => '2','namespace' => 'App\\Lib\\Mollie','currency_name' => 'usd','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '0','data' => '{"api_key":""}','created_at' => '2021-04-15 02:44:46','updated_at' => '2021-04-15 02:44:46'),

        array('id' => '4','name' => 'paystack','logo' => 'uploads/21/04/1698367968509154.png','rate' => '10','charge' => '2','namespace' => 'App\\Lib\\Paystack','currency_name' => 'usd','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '0','data' => '{"public_key":"","secret_key":""}','created_at' => '2021-04-15 02:44:46','updated_at' => '2021-04-15 02:44:46'),

        array('id' => '5','name' => 'razorpay','logo' => 'uploads/21/04/1698367977941644.png','rate' => '10','charge' => '2','namespace' => 'App\\Lib\\Razorpay','currency_name' => 'usd','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '0','data' => '{"key_id":"","key_secret":""}','created_at' => '2021-04-15 02:44:46','updated_at' => '2021-04-15 02:44:46'),

        array('id' => '6','name' => 'instamojo','logo' => 'uploads/21/04/1698367990639996.png','rate' => '54','charge' => '2','namespace' => 'App\\Lib\\Instamojo','currency_name' => 'INR','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '1','data' => '{"x_api_key":"","x_auth_token":""}','created_at' => '2021-04-15 02:44:46','updated_at' => '2021-04-15 02:44:46'),


        array('id' => '7','name' => 'toyyibpay','logo' => 'uploads/21/04/1698368000180467.png','rate' => '54','charge' => '2','namespace' => 'App\\Lib\\Toyyibpay','currency_name' => 'MR','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '1','data' => '{"user_secret_key":"","cateogry_code":""}','created_at' => '2021-04-15 02:44:46','updated_at' => '2021-04-15 02:44:46'),


        array('id' => '8','name' => 'flutterwave','logo' => 'uploads/21/04/1698368012665741.png','rate' => '54','charge' => '2','namespace' => 'App\\Lib\\Flutterwave','currency_name' => 'NGN','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '1','data' => '{"public_key":"","secret_key":"","encryption_key":"","payment_options":"card"}','created_at' => '2021-04-15 02:44:46','updated_at' => '2021-04-15 02:44:46'),

        array('id' => '9','name' => 'payu','logo' => 'uploads/21/04/1698368022202232.png','rate' => '54','charge' => '2','namespace' => 'App\\Lib\\Payu','currency_name' => 'INR','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '1','data' => '{"merchant_key":"","merchant_salt":"","auth_header":""}','created_at' => '2021-04-15 02:44:46','updated_at' => '2021-04-15 02:44:46'),

        array('id' => '10','name' => 'thawani','logo' => 'uploads/21/04/1698368032853372.png','rate' => '0.38','charge' => '1','namespace' => 'App\\Lib\\Thawani','currency_name' => 'OMR','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '1','data' => '{"secret_key":"","publishable_key":""}','created_at' => '2021-04-15 02:44:46','updated_at' => '2021-04-15 02:44:46'),


        array('id' => '11','name' => 'manual','logo' => 'uploads/21/04/1698368040658664.png','rate' => '1','charge' => '1','namespace' => 'App\\Lib\\CustomGetway','currency_name' => 'USD','is_auto' => '0','image_accept' => '1','test_mode' => '1','status' => '1','phone_required' => '0','data' => '','created_at' => '2021-04-15 04:12:12','updated_at' => '2021-04-15 04:12:12'),

        array('id' => '12','name' => 'mercadopago','logo' => 'uploads/21/04/1698368050865604.png','rate' => '1.2','charge' => '1','namespace' => 'App\\Lib\\Mercado','currency_name' => 'USD','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '0','data' => '{"secret_key":"","public_key":""}','created_at' => '2021-04-15 05:40:51','updated_at' => '2021-04-15 07:17:13'),


        array('id' => '13','name' => 'free','logo' => NULL,'rate' => '1','charge' => '0','namespace' => '','currency_name' => '','is_auto' => '0','image_accept' => '0','test_mode' => '1','status' => '1','phone_required' => '0','data' => '','created_at' => NULL,'updated_at' => NULL)
      );
          
        Getway::insert($getways);
    }
}
