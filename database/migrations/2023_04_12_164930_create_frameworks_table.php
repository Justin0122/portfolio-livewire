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
        Schema::create('frameworks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $frameworks = array(
            'Laravel',
            'Vue.js',
            'React.js',
            'Bootstrap',
            'Tailwind',
            'jQuery',
            'Node.js',
            'Express.js',
            'Flask',
            'Livewire',
            'Inertia.js',
            'Nuxt.js',
            'Next.js',
        );

        foreach ($frameworks as $framework) {
            DB::table('frameworks')->insert(
                array(
                    'name' => $framework,
                )
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frameworks');
    }
};
