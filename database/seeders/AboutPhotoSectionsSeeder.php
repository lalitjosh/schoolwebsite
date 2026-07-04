<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class AboutPhotoSectionsSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 4) as $index) {
            PageContent::firstOrCreate(
                ['key' => 'about.photo.' . $index],
                [
                    'page' => 'About',
                    'section' => 'Story Photo',
                    'title' => 'About Photo ' . $index,
                    'is_active' => true,
                    'sort_order' => $index + 20,
                ]
            );
        }
    }
}
