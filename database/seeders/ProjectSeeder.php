<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        // Pesco dal DB tutti i possibili ID della Tabella 'Types'
        // Il Metodo 'pluck' crea una Collection derivata (da all()) con il solo campo indicato
        // Con il Metodo all() la trasformo in un array
        $type_ids = Type::all()->pluck('id')->all();

        // Pesco dal DB tutti i possibili ID della Tabella 'technologies'
        $tech_ids = Technology::all()->pluck('id')->all();

        for ($i = 0; $i < 50; $i++) {

            $project = new Project();

            $project->name = $faker->unique()->words($faker->numberBetween(2, 6), true);
            // Grazie a una 'helper function' di Laravel posso generare slug da un metodo statico
            $project->slug = Str::slug($project->name, '-');
            $project->description = $faker->optional()->text(300);
            $project->client = $faker->name($gender = 'male' | 'female');
            $project->url = $faker->optional()->url();

            // Assegno alla Colonna 'type_id' (FK) un valore casuale (anche nullo) tra i possibili ID della Tabella 'Types'
            $project->type_id = $faker->optional()->randomElement($type_ids);

            $project->save();

            // Faccio dopo 'save' perchè altrimenti non avrò la Colonna ID da assocciare alle Tecnologie
            // Accedo alla Relazione tra Project(s)-Technology(ies) per collegarli e riempire Tabella Ponte
            // Lo Faccio pescando in modo casuale un Array di Tecnologie (ID) da associare a un determinato Progettophp
            $project->technologies()->attach($faker->randomElements($tech_ids, rand(0, 9)));
        }
    }
}
