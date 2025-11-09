<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => config('app.name', 'Blog'),
                'type' => 'string',
                'description' => 'Site name displayed in header and title',
            ],
            [
                'key' => 'site_description',
                'value' => 'A clean and simple blog',
                'type' => 'text',
                'description' => 'Site meta description',
            ],
            [
                'key' => 'home_title',
                'value' => 'Blog Posts',
                'type' => 'string',
                'description' => 'Home page title',
            ],
            [
                'key' => 'home_description',
                'value' => 'Discover our latest articles and insights',
                'type' => 'text',
                'description' => 'Home page description',
            ],
            [
                'key' => 'footer_text',
                'value' => 'Powered by Laravel & Tailwind CSS',
                'type' => 'text',
                'description' => 'Footer text',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
