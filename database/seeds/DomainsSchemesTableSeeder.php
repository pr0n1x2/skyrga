<?php

use Illuminate\Database\Seeder;

class DomainsSchemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schemes = ['https://www.', 'http://www.', 'https://', 'http://'];

        for ($i = 0; $i < count($schemes); $i++) {
            DB::table('domains_schemes')->insert([
                'name' => $schemes[$i],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
