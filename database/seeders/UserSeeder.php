<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@webflowindia.com'],
            [
                'name' => 'Herritage Moulds Admin',
                'password' => Hash::make('123'),
                'additional_info' => [
                    'brand_name' => 'Herritage Moulds',
                    'logo' => 'branding/logo.webp',
                    'favicon' => 'branding/favicon.webp',
                    'address' => '458-466, Shambhu Nath Compound, Friends Colony Industrial Area, Shahdara, Delhi - 110032 (INDIA)',
                    'gstin' => '07AZPPG9219H1Z0',
                    'iframe' => '',
                    'mobile_numbers' => [
                        ['Name' => 'Mobile', 'number' => '+91-9891076555'],
                    ],
                    'emails' => [
                        ['Name' => 'Enquiry', 'email' => 'herritagemoulds@gmail.com'],
                    ],
                    'addresses' => [
                        ['Name' => 'Works', 'address' => '458-466, Shambhu Nath Compound, Friends Colony Industrial Area, Shahdara, Delhi - 110032 (INDIA)'],
                    ],
                    'social_links' => [],
                    'header_scripts' => '',
                    'between_header_body_scripts' => '',
                    'body_scripts' => '',
                ],
            ]
        );
    }
}
