<?php

use Illuminate\Database\Seeder;

class HrefsStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'New',
        ];

        for ($i = 0; $i < count($statuses); $i++) {
            DB::table('hrefs_statuses')->insert([
                'name' => $statuses[$i],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
