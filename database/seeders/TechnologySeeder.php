<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // Uso un Array predefinito di Tipologie per popolare la Tabella Types 
    public function run()
    {
        $technologies = ['HTML', 'JavaScript', 'PHP', 'AutoCad', 'Photoshop', 'Adobe Illustrator', 'Excel', 'Word', 'PowerPoint'];

        foreach ($technologies as $technology) {

            $tech = new Technology();

            $tech->name = $technology;
            $tech->slug = Str::slug($tech->name, '-');

            $tech->save();
        }
    }
}
