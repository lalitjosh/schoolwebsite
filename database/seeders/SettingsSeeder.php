<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::query()->updateOrCreate([], [
            'school_name' => 'Cambridge Public School',
            'tagline' => 'Fostering Excellence, Inspiring Futures',
            'established_year' => '2062 BS',
            'phone' => '9801181818',
            'email' => 'admin@cambridgeps.edu.np',
            'address' => 'Dadeldhura, Sudurpashchim Province, Nepal',
            'map_embed_url' => 'https://maps.google.com/maps?q=Cambridge+Public+School,+Dadeldhura,+Nepal&t=&z=16&ie=UTF8&iwloc=&output=embed',
            'map_external_url' => 'https://maps.app.goo.gl/B2VqsmyjQJzm4Wuy8',
            'footer_about' => 'Empowering young minds from Nursery to Grade 12 with quality education, values, and a vision for holistic excellence.',
            'footer_credit' => 'Broad Tech Infosys',
        ]);
    }
}
