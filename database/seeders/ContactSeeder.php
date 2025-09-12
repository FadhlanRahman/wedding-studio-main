<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    \App\Models\Contact::create([
        'phone' => '+62 812-3456-789',
        'email' => 'ellenstudio@example.com',
        'address' => 'Grand Sharon, Jalan Oliana No.16, Jakarta, Indonesia',
        'instagram' => 'https://instagram.com/ellenstudio',
        'whatsapp' => 'https://wa.me/628123456789',
        'map_url' => 'https://www.google.com/maps/embed?...',
    ]);
}

}
