<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Creacion de los usuarios a travez de la migracion
        DB::table('users')->insert([
            [
                'name' => 'Nicolas Roberts',
                'email' => 'nicoal-2004@hotmail.com',
                'password' => bcrypt('#Nico2004'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laura Lupis',
                'email' => 'laulupis@hotmail.com',
                'password' => bcrypt('#Laura1979'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lidia Lupis',
                'email' => 'lidialupis.ll@gmail.com',
                'password' => bcrypt('#Lula1977'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::table('users')->whereIn('email', [
            'nicoal-2004@hotmail.com',
            'laulupis@hotmail.com',
            'lidialupis.ll@gmail.com',
        ])->delete();
    }
};
