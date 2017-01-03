<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('contact_no')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('country')->nullable();
            $table->string('hobbies')->nullable();
            $table->text('about_me')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('avatar')->nullable();
            $table->string('slack_webhook_url')->nullable();
            $table->string('social_id')->nullable();
            $table->enum('user_type', ['blogger', 'admin']);
            $table->enum('registration_type', ['conventional', 'facebook', 'twitter', 'google', 'linkedin', 'github', 'bitbucket']);
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
