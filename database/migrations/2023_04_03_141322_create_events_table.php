<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('location')->nullable();
            $table->text('location_tip')->nullable();
            $table->enum('event_type',['physical', 'virtual']);
            $table->text('virtual_meet_link')->nullable();
            $table->enum('event_categories',['product_launch', 'product_review']);
            $table->text('custom_url');
            $table->enum('event_frequency',['single', 'recurring']);
            $table->date('start_date');
            $table->dateTime('start_time');
            $table->date('end_date');
            $table->dateTime('end_time');
            $table->text('twitter_url');
            $table->text('facebook_url');
            $table->text('instagram_url');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('events');
    }
}
