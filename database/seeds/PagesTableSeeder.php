<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('pages')->insert([
            'name' => 'Info',
            'content' => '<h1>Studiereizen 3de opleidingsfase Professionele Bachelor</h1>
<p style="text-align: justify;">Reeds vele jaren neemt internationalisering een prominente plaats in bij de Professionele Bachelors Elektromechanica, Energietechnologie en Elektronica-ICT. We vinden het immers belangrijk dat studenten tijdens hun opleiding in contact komen met buitenlandse industrie, onderwijs en cultuur. Met het oog op een latere loopbaan en zeker in het Europa van vandaag, is het eveneens niet onbelangrijk dat je jezelf leert uitdrukken in een andere taal. Internationalisering maakt deel uit van de opleiding tot Professionele Bachelor, en behoort dus tot het verplichte curriculum.</p>
<p style="text-align: justify;">Onze studenten kunnen het volgende academiejaar kiezen tussen een studiereis naar Duitsland-Tsjechië of naar de Verenigde Staten van Amerika (USA) of een buitenlandse stage (Erasmus).</p>',
            'type' => 'html',
        ]);
        DB::table('pages')->insert([
            "name" => "Amerika 2017",
            "content" => "Een lange text die de afgelopen reis naar Amerika beschrijft.",
            "type" => "html",
        ]);
        DB::table('pages')->insert([
            "name" => "Duitsland 2017",
            "content" => "Een lange text die de afgelopen reis naar Duitsland beschrijft.",
            "type" => "html",
        ]);
    }
}
