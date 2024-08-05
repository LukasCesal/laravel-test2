<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaysSeeder extends Seeder
{
    /**
     * Insert static holidays
     * Source: https://www.mpsv.cz/svatky-v-ceske-republice
     */
    public function run(): void
    {
        $insertData=[
            [
                'name' => 'Den obnovy samostatného českého státu',
                'country' => 'CZ',
                'day' => 1,
                'month' => 1
            ],
            [
                'name' => 'Den vítězství',
                'country' => 'CZ',
                'day' => 8,
                'month' => 5
            ],
            [
                'name' => 'Den slovanských věrozvěstů Cyrila a Metoděje',
                'country' => 'CZ',
                'day' => 5,
                'month' => 7
            ],
            [
                'name' => 'Den upálení mistra Jana Husa',
                'country' => 'CZ',
                'day' => 6,
                'month' => 7
            ],
            [
                'name' => 'Den české státnosti',
                'country' => 'CZ',
                'day' => 28,
                'month' => 9
            ],
            [
                'name' => 'Den vzniku samostatného československého státu',
                'country' => 'CZ',
                'day' => 28,
                'month' => 10
            ],
            [
                'name' => 'Den boje za svobodu a demokracii',
                'country' => 'CZ',
                'day' => 17,
                'month' => 11
            ],
            [
                'name' => 'Nový rok',
                'country' => 'CZ',
                'day' => 1,
                'month' => 1
            ],
            [
                'name' => 'Svátek práce',
                'country' => 'CZ',
                'day' => 1,
                'month' => 5
            ],
            [
                'name' => 'Štědrý den',
                'country' => 'CZ',
                'day' => 24,
                'month' => 12
            ],
            [
                'name' => '1. svátek vánoční',
                'country' => 'CZ',
                'day' => 25,
                'month' => 12
            ],
            [
                'name' => '2. svátek vánoční',
                'country' => 'CZ',
                'day' => 26,
                'month' => 12
            ],
        ];

        foreach($insertData as $record)
            DB::table('holidays')->insert($record);
    }
}
