<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $MunicipalitiesByRegion = [
            'Hovedstaden' => [
                'Copenhagen',
                'Frederiksberg',
                'Helsingør',
                'Gentofte',
                'Gladsaxe',
                'Ballerup',
                'Lyngby-Taarbæk',
                'Herlev',
                'Hvidovre',
                'Rødovre',
                'Tårnby',
                'Albertslund',
                'Allerød',
                'Bornholm (Regional Municipality)',
                'Brøndby',
                'Dragør',
                'Egedal',
                'Fredensborg',
                'Frederikssund',
                'Furesø',
                'Glostrup',
                'Gribskov',
                'Halsnæs',
                'Hillerød',
                'Høje-Taastrup',
                'Hørsholm',
                'Ishøj',
                'Rudersdal',
                'Vallensbæk',
            ],
            'Midtjylland' => [
                'Aarhus',
                'Randers',
                'Horsens',
                'Silkeborg',
                'Herning',
                'Viborg',
                'Holstebro',
                'Skive',
                'Ikast-Brande',
                'Struer',
                'Skanderborg',
                'Norddjurs',
                'Favrskov',
                'Odder',
                'Samsø',
                'Hedensted',
                'Ringkøbing-Skjern',
            ],
            'Nordjylland' => [
                'Aalborg',
                'Hjørring',
                'Frederikshavn',
                'Thisted',
                'Brønderslev',
                'Jammerbugt',
                'Vesthimmerland',
                'Mariagerfjord',
                'Rebild',
                'Læsø',
                'Morsø',
            ],
            'Sjælland' => [
                'Roskilde',
                'Køge',
                'Næstved',
                'Slagelse',
                'Holbæk',
                'Kalundborg',
                'Ringsted',
                'Guldborgsund',
                'Vordingborg',
                'Lolland',
                'Sorø',
                'Faxe',
                'Stevns',
                'Odsherred',
                'Lejre',
                'Solrød',
                'Furesø',
                'Gribskov',
                'Halsnæs',
            ],
            'Syddanmark' => [
                'Odense',
                'Esbjerg',
                'Aabenraa',
                'Kolding',
                'Sønderborg',
                'Haderslev',
                'Vejle',
                'Fredericia',
                'Varde',
                'Billund',
                'Vejen',
                'Middelfart',
                'Assens',
                'Faaborg-Midtfyn',
                'Nyborg',
                'Svendborg',
                'Nordfyn',
                'Kerteminde',
                'Langeland',
                'Ærø',
                'Tønder',
                'Fanø',
                'Varde',
            ],
        ];


        foreach ($MunicipalitiesByRegion as $regionName => $municipalities) {
            $region = \App\Models\Region::where('name', $regionName)->first();
            if (!$region) {
                continue;
            }
            foreach ($municipalities as $cityName) {
                \App\Models\Municipality::create([
                    'name' => $cityName,
                    'region_id' => $region->id,
                ]);
            }
        }
    }
}
