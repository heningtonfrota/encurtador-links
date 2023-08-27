<?php

use App\Models\Link;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClickLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('click_links', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Link::class);
            $table->string('ip');
            $table->string('user_agent');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('click_links');
    }
}
