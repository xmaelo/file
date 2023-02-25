<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_type');
            $table->text('password');
            $table->rememberToken();

            $table->text('company')->nullable();
            $table->text('addition')->nullable();
            $table->text('street')->nullable();
            $table->text('post_box')->nullable();
            $table->text('postcode')->nullable();
            $table->text('town')->nullable();
            $table->text('country')->nullable();
            $table->text('form_of_address')->nullable();
            $table->text('ide')->nullable();
            $table->text('first_name')->nullable();
            $table->text('surname')->nullable();            
            $table->text('phone')->nullable();
            $table->text('mobile')->nullable();
            $table->text('lang')->nullable();
            $table->text('username')->nullable();            
            $table->text('membership')->nullable();
            $table->boolean('isApproved')->default(false);
            $table->boolean('isEmailVerified')->default(false);
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
        Schema::dropIfExists('users');
    }
};
