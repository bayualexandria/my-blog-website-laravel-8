<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;

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

        Blog::factory(100)->create();

        Category::create([
            'name' => 'Freamwork Laravel',
            'slug' => 'freamwork-laravel',
            'icon' => 'fab fa-laravel',
            'color' => 'text-danger'
        ]);

        Category::create([
            'name' => 'Freamwork CodeIgniter',
            'slug' => 'freamwork-codeigniter',
            'icon' => 'fas fa-fire',
            'color' => 'text-warning'
        ]);

        Category::create([
            'name' => 'Jaringan Komputer',
            'slug' => 'jaringan-komputer',
            'icon' => 'fas fa-network-wired',
            'color' => 'text-primary'
        ]);
    }
}
