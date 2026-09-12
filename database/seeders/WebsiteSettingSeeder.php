<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['group' => 'general', 'key' => 'site.name', 'value' => 'Veterinary Journal', 'type' => 'string', 'is_public' => true],
            ['group' => 'general', 'key' => 'site.tagline', 'value' => 'Clinical notes, veterinary knowledge, and personal reflections.', 'type' => 'text', 'is_public' => true],
            ['group' => 'general', 'key' => 'site.contact_email', 'value' => '', 'type' => 'string', 'is_public' => true],
            ['group' => 'publishing', 'key' => 'journal.posts_per_page', 'value' => '12', 'type' => 'integer', 'is_public' => true],
            ['group' => 'publishing', 'key' => 'journal.show_reading_time', 'value' => '1', 'type' => 'boolean', 'is_public' => true],
            ['group' => 'seo', 'key' => 'seo.default_description', 'value' => '', 'type' => 'text', 'is_public' => true],
            ['group' => 'seo', 'key' => 'seo.index_site', 'value' => '1', 'type' => 'boolean', 'is_public' => true],
            ['group' => 'contact', 'key' => 'contact.enabled', 'value' => '1', 'type' => 'boolean', 'is_public' => true],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
