<?php

use Illuminate\Database\Seeder;
use DonaSangre\Models\State;
use DonaSangre\Models\PostalCode;

class PopulateStatesAndPostalCodes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datafile = __DIR__ . '/data/geonames/MX.txt';

        State::truncate();
        PostalCode::truncate();

        $lines = file($datafile);

        $i = 0;

        $states = $cities = [];

        foreach ($lines as $line) {
            $data = str_getcsv($line, "\t");

            if ( ! isset($states[$data[4]]) ) {
                $states[$data[4]] = State::create(['code' => strtolower($data[4]), 'name' => $data[3]]);
            }

            if ( ! isset($cities[$data[4]]) ) {
                $cities[$data[4]] = [];
            }

            $cities[$data[4]][] = new PostalCode([
                'code'      =>  $data[1],
                'name'      =>  $data[5],
                'suburb'    =>  $data[2],
                'latitude'  =>  $data[9],
                'longitude' =>  $data[10],
                'accuracy'  =>  $data[11],
            ]);
        }

        foreach ($cities as $s => $city) {
            $states[$s]->postalCodes()->saveMany($city);
        }
    }
}