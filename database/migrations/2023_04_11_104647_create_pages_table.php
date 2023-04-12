<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('anchor')->default(0);
            $table->tinyInteger('visibility')->default(1);
            //2 = visible for admin, 1 = visible for everyone, 0 = invisible
            $table->timestamps();
        });

        DB::table('pages')->insert(
            array(
                'title' => 'dashboard',
            )
        );
        DB::table('pages')->insert(
            array(
                'title' => 'projects',
                'anchor' => '1',
                'visibility' => '1',
            )
        );
        DB::table('pages')->insert(
            array(
                'title' => 'about',
                'anchor' => '1',
            )
        );
        DB::table('pages')->insert(
            array(
                'title' => 'contact',
                'anchor' => '1',
            )
        );
        DB::table('pages')->insert(
            array(
                'title' => 'projects',
                'visibility' => '1',
            )
        );
        DB::table('pages')->insert(
            array(
                'title' => 'snippets',
                'visibility' => '2',
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
