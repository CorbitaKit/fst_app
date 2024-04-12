<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\App;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. quas!';

        $marketingApps = [
            [
                'name' => 'Google Ads',
                'description' => $description,
                'price' => 2999,
                'type' => 'Marketing',
                'logo' => '/images/adwords.png',
                'image' => '/images/google.jpeg'
            ],
            [
                'name' => 'Meta Ads',
                'description' => $description,
                'price' => 2999,
                'type' => 'Marketing',
                'logo' => '/images/meta.png',
                'image' => '/images/meta.jpeg'
            ],
            [
                'name' => 'Linkedin Ads',
                'description' => $description,
                'price' => 2999,
                'type' => 'Marketing',
                'logo' => '/images/linkedin.png',
                'image' => '/images/linkedin.jpeg'
            ],
            [
                'name' => 'SEO',
                'description' => $description,
                'price' => 2999,
                'type' => 'Marketing',
                'logo' => '/images/seo.png',
                'image' => '/images/seo.jpeg'
            ]
        ];

        $visualApps = [
            [
                'name' => 'Foto and Video',
                'description' => $description,
                'price' => 2999,
                'type' => 'Visual',
                'logo' => '/images/photograph.png',
                'image' => '/images/photoandvideo.jpeg'
            ],
            [
                'name' => 'Website',
                'description' => $description,
                'price' => 2999,
                'type' => 'Visual',
                'logo' => '/images/web.png',
                'image' => '/images/website.jpeg'
            ],
            [
                'name' => 'Brand Package',
                'description' => $description,
                'price' => 2999,
                'type' => 'Visual',
                'logo' => '/images/packaging.png',
                'image' => '/images/brand.jpeg'
            ],
        ];


        $otherApps = [
            [
                'name' => 'Microsoft Office',
                'description' => $description,
                'price' => 2999,
                'type' => 'Other',
                'logo' => '/images/office.png',
                'image' => '/images/microsoft.jpeg'
            ],
            [
                'name' => 'Secure Mail',
                'description' => $description,
                'price' => 2999,
                'type' => 'Other',
                'logo' => '/images/email.png',
                'image' => '/images/secure-email.jpeg'
            ],
            [
                'name' => 'SamtykkePlus',
                'description' => $description,
                'price' => 2999,
                'type' => 'Other',
                'logo' => '/images/samtykke.png',
                'image' => '/images/samtykke.jpeg'
            ],
            [
                'name' => 'Hosting',
                'description' => $description,
                'price' => 2999,
                'type' => 'Other',
                'logo' => '/images/hosting.png',
                'image' => '/images/hosting.jpeg'
            ],
            [
                'name' => 'Clip Card',
                'description' => $description,
                'price' => 2999,
                'type' => 'Other',
                'logo' => '/images/clipcard.png',
                'image' => '/images/clipcard.jpeg'
            ],
            [
                'name' => 'SSL Certificate',
                'description' => $description,
                'price' => 2999,
                'type' => 'Visual',
                'logo' => '/images/ssl-certificate.png',
                'image' => '/images/ssl.jpeg'
            ],
        ];

        foreach ($marketingApps as $marketing) {
            App::create($marketing);
        }

        foreach ($visualApps as $visual) {
            App::create($visual);
        }

        foreach ($otherApps as $other) {
            App::create($other);
        }
    }
}
