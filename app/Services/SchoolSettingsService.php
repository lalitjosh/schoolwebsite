<?php

namespace App\Services;

use App\Models\Setting;

class SchoolSettingsService
{
    public function current(): Setting
    {
        return Setting::query()->firstOrCreate([], [
            'school_name' => 'Cambridge Public School',
            'tagline' => 'Fostering Excellence, Inspiring Futures',
            'established_year' => '2062 BS',
            'phone' => '9801181818',
            'email' => 'admin@cambridgeps.edu.np',
            'address' => 'Amargadhi-5, Dadeldhura, Sudurpashchim Province, Nepal',
            'footer_about' => 'Empowering young minds from Nursery to Grade 12 with quality education, values, and a vision for holistic excellence.',
            'footer_credit' => 'Broad Tech Infosys',
        ]);
    }

    public function update(array $data): Setting
    {
        $setting = $this->current();
        $setting->update($data);

        return $setting->refresh();
    }
}
