<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->enum('ticket_type', ['free', 'paid', 'invite_only']);
            $table->enum('ticket_stock', ['unlimited', 'limited']);
            $table->integer('no_of_stock')->nullable();
            $table->integer('purchase_limit')->nullable();
            $table->integer('price')->nullable();
            $table->foreignIdFor(Event::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('tickets');
    }
}
