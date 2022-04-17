<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('duration');
            $table->double('price');
            $table->double('storage_size')->nullable();
            $table->integer('resume_builder')->default(0); //true false only
            $table->integer('portfolio_builder')->default(0); //true false only
            $table->integer('custom_domain')->default(0); //true false only
            $table->integer('sub_domain')->default(0); //true false only
            $table->integer('analytics')->default(0); //true false only
            $table->integer('online_businesscard')->default(0); //true false only
            $table->integer('qrcode')->default(0); //true false only
            $table->integer('postlimit')->default(0); //number only                   
            $table->integer('is_featured')->default(0);
            $table->integer('online_cv')->default(0);
            $table->integer('vcard')->default(0);
            $table->integer('status')->default(0);
            $table->integer('is_trial')->default(0);
            $table->integer('is_default')->default(0);
            $table->text('data')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
