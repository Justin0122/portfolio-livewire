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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $languages = array(
            'PHP',
            'JavaScript',
            'HTML',
            'CSS',
            'SQL',
            'C#',
            'C++',
            'C',
            'Python',
            'MicroPython',
            'Shell',
            'Java',
            'TypeScript',
            'Ruby',
            'Go',
            'Swift',
            'SCSS',
            'Blade',
            'Vue',
            'Dart',
            'PowerShell',
            'Rust',
            'Objective-C',
        );

        foreach ($languages as $language) {
            DB::table('languages')->insert(
                array(
                    'name' => $language,
                )
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
