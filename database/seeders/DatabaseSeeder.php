<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Htetshine',
            'email' => 'hhz@gmail.com',
            'password' => Hash::make('asdffdsa')
        ]);

        $this->call([
            ContactSeeder::class
        ]);

        $file = new FileSystem;
        $file->cleanDirectory('storage/app/public');

        echo "\e[93mStorage Cleaned \n";
    }
}
