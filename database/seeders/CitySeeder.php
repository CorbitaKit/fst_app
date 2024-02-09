<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $CitiesByMunicipality = [
            'Copenhagen' => [
                'Indre By',
                'Østerbro',
                'Nørrebro',
                'Vesterbro/Kongens Enghave',
                'Valby',
                'Vanløse',
                'Brønshøj-Husum',
                'Bispebjerg',
                'Amager Øst',
                'Amager Vest',
                'Slotsholmen',
                'Frederiksstaden',
                'Islands Brygge',
                'Christiania ',
                'Carlsberg',
                'Sluseholmen',
                'Amagerbro',
                'Ørestad',
                'Nordhavnen',
                'Bellahøj',
                'Brønshøj',
                'Ryparken',
                'Vigerslev',
            ],
            'Frederiksberg' => [
                'Frederiksberg',
            ],
            'Helsingør' => [
                'Helsingør',
            ],
            'Gentofte' => [
                'Gentofte',
            ],
            'Gladsaxe' => [
                'Gladsaxe',
            ],
            'Ballerup' => [
                'Ballerup',
            ],
            'Lyngby-Taarbæk' => [
                'Lyngby-Taarbæk',
            ],
            'Herlev' => [
                'Herlev',
            ],
            'Hvidovre' => [
                'Hvidovre',
            ],
            'Rødovre' => [
                'Rødovre',
            ],
            'Tårnby' => [
                'Tårnby',
            ],
            'Albertslund' => [
                'Albertslund',
            ],
            'Allerød' => [
                'Allerød',
            ],
            'Bornholm (Regional Municipality)' => [
                'Bornholm (Regional Municipality)',
            ],
            'Brøndby' => [
                'Brøndby',
            ],
            'Dragør' => [
                'Dragør',
            ],
            'Egedal' => [
                'Egedal',
            ],
            'Fredensborg' => [
                'Fredensborg',
            ],
            'Frederikssund' => [
                'Frederikssund',
            ],
            'Furesø' => [
                'Furesø',
            ],
            'Glostrup' => [
                'Glostrup',
            ],
            'Gribskov' => [
                'Gribskov',
            ],
            'Halsnæs' => [
                'Halsnæs',
            ],
            'Hillerød' => [
                'Hillerød',
            ],
            'Høje-Taastrup' => [
                'Høje-Taastrup',
            ],
            'Hørsholm' => [
                'Hørsholm',
            ],
            'Ishøj' => [
                'Ishøj',
            ],
            'Rudersdal' => [
                'Rudersdal',
            ],
            'Vallensbæk' => [
                'Vallensbæk',
            ],
            'Aarhus' => [
                'Aarhus',
            ],
            'Randers' => [
                'Randers',
            ],
            'Horsens' => [
                'Horsens',
            ],
            'Silkeborg' => [
                'Silkeborg',
            ],
            'Herning' => [
                'Herning',
            ],
            'Viborg' => [
                'Viborg',
            ],
            'Holstebro' => [
                'Holstebro',
            ],
            'Skive' => [
                'Skive',
            ],
            'Ikast-Brande' => [
                'Ikast-Brande',
            ],
            'Struer' => [
                'Struer',
            ],
            'Skanderborg' => [
                'Skanderborg',
            ],
            'Norddjurs' => [
                'Norddjurs',
            ],
            'Favrskov' => [
                'Favrskov',
            ],
            'Odder' => [
                'Odder',
            ],
            'Samsø' => [
                'Samsø',
            ],
            'Hedensted' => [
                'Hedensted',
            ],
            'Ringkøbing-Skjern' => [
                'Ringkøbing-Skjern',
            ],
            'Aalborg' => [
                'Aalborg',
            ],
            'Hjørring' => [
                'Hjørring',
            ],
            'Frederikshavn' => [
                'Frederikshavn',
            ],
            'Thisted' => [
                'Thisted',
            ],
            'Brønderslev' => [
                'Brønderslev',
            ],
            'Jammerbugt' => [
                'Jammerbugt',
            ],
            'Vesthimmerland' => [
                'Vesthimmerland',
            ],
            'Mariagerfjord' => [
                'Mariagerfjord',
            ],
            'Rebild' => [
                'Rebild',
            ],
            'Læsø' => [
                'Læsø',
            ],
            'Morsø' => [
                'Morsø',
            ],
            'Roskilde' => [
                'Roskilde',
            ],
            'Køge' => [
                'Køge',
            ],
            'Næstved' => [
                'Næstved',
            ],
            'Slagelse' => [
                'Slagelse',
            ],
            'Holbæk' => [
                'Holbæk',
            ],
            'Kalundborg' => [
                'Kalundborg',
            ],
            'Ringsted' => [
                'Ringsted',
            ],
            'Guldborgsund' => [
                'Guldborgsund',
            ],
            'Vordingborg' => [
                'Vordingborg',
            ],
            'Lolland' => [
                'Lolland',
            ],
            'Sorø' => [
                'Sorø',
            ],
            'Faxe' => [
                'Faxe',
            ],
            'Stevns' => [
                'Stevns',
            ],
            'Odsherred' => [
                'Odsherred',
            ],
            'Lejre' => [
                'Lejre',
            ],
            'Solrød' => [
                'Solrød',
            ],
            'Furesø' => [
                'Furesø',
            ],
            'Gribskov' => [
                'Gribskov',
            ],
            'Halsnæs' => [
                'Halsnæs',
            ],
            'Odense' => [
                'Odense',
            ],
            'Esbjerg' => [
                'Esbjerg',
            ],
            'Aabenraa' => [
                'Aabenraa',
            ],
            'Kolding' => [
                'Kolding',
            ],
            'Sønderborg' => [
                'Sønderborg',
            ],
            'Haderslev' => [
                'Haderslev',
            ],
            'Vejle' => [
                'Vejle',
            ],
            'Fredericia' => [
                'Fredericia',
            ],
            'Varde' => [
                'Varde',
            ],
            'Billund' => [
                'Billund',
            ],
            'Vejen' => [
                'Vejen',
            ],
            'Middelfart' => [
                'Middelfart',
            ],
            'Assens' => [
                'Assens',
            ],
            'Faaborg-Midtfyn' => [
                'Faaborg-Midtfyn',
            ],
            'Nyborg' => [
                'Nyborg',
            ],
            'Svendborg' => [
                'Svendborg',
            ],
            'Nordfyn' => [
                'Nordfyn',
            ],
            'Kerteminde' => [
                'Kerteminde',
            ],
            'Langeland' => [
                'Langeland',
            ],
            'Ærø' => [
                'Ærø',
            ],
            'Tønder' => [
                'Tønder',
            ],
            'Fanø' => [
                'Fanø',
            ],
        ];



        foreach ($CitiesByMunicipality as $regionName => $cities) {
            $municipality = \App\Models\Municipality::where('name', $regionName)->first();
            if (!$municipality) {
                continue;
            }
            foreach ($cities as $cityName) {
                \App\Models\City::create([
                    'name' => $cityName,
                    'municipality_id' => $municipality->id,
                ]);
            }
        }
    }
}
