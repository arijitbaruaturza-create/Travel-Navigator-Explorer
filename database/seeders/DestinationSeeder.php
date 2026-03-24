<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        $destinations = [
            ['name' => "Cox’s Bazar Beach", 'category' => "Beach"],
            ['name' => "Inani Beach", 'category' => "Beach"],
            ['name' => "Himchari Beach", 'category' => "Beach"],
            ['name' => "Laboni Beach", 'category' => "Beach"],
            ['name' => "Ramu Beach", 'category' => "Beach"],
            ['name' => "St. Martin’s Island", 'category' => "Beach/Island"],
            ['name' => "Teknaf Beach", 'category' => "Beach"],
            ['name' => "Himchari National Park", 'category' => "Hill/Nature"],
            ['name' => "Sugandha River", 'category' => "Hill/Nature"],
            ['name' => "Moheshkhali Island", 'category' => "Island"],
            ['name' => "Maheshkhali Hills", 'category' => "Hill/Nature"],
            ['name' => "Himchari Waterfall", 'category' => "Waterfall"],
            ['name' => "Nafakhum Waterfall", 'category' => "Waterfall"],
            ['name' => "Ramu Buddhist Monastery", 'category' => "Cultural"],
            ['name' => "Aggmeda Khyang Monastery", 'category' => "Cultural"],
            ['name' => "Cox’s Bazar Lighthouse", 'category' => "Cultural"],
            ['name' => "Moheshkhali Kali Temple", 'category' => "Cultural"],
            ['name' => "Laboni Point", 'category' => "Eco/Adventure"],
            ['name' => "Inani Coral Stones", 'category' => "Eco/Adventure"],
            ['name' => "Cox’s Bazar Eco-Park", 'category' => "Eco/Adventure"],
            ['name' => "Teknaf Wildlife Sanctuary", 'category' => "Eco/Adventure"],
            ['name' => "Jaliardwip", 'category' => "Island"],
        ];

        foreach ($destinations as $destination) {
            Destination::create($destination);
        }
    }
}