<?php

use Illuminate\Database\Seeder;

class SitesCitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schemes = ['Los Angeles', 'Chicago', 'Houston', 'Philadelphia', 'Phoenix', 'San Antonio', 'San Diego',
            'Dallas', 'San Jose', 'Austin', 'Indianapolis', 'San Francisco', 'Charlotte', 'Fort Worth', 'Seattle',
            'Denver', 'Washington', 'Oklahoma City', 'Portland', 'Las Vegas', 'Tucson', 'Atlanta', 'Colorado Springs',
            'Tulsa', 'Tampa', 'Aurora', 'Orlando', 'Salt Lake City', 'Cincinnati', 'Boise', 'New York', 'Sacramento',
            'Tallahassee', 'Jacksonville', 'Albany', 'Harrisburg', 'Springfield', 'Columbus'];

        for ($i = 0; $i < count($schemes); $i++) {
            DB::table('sites_cities')->insert([
                'name' => $schemes[$i],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
