<?php

use Illuminate\Database\Seeder;

class SitesTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Plumbing site', 'Amazon site', 'Amazon cookware site'];

        for ($i = 0; $i < count($types); $i++) {
            DB::table('sites_types')->insert([
                'name' => $types[$i],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
