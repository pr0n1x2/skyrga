<?php

use Illuminate\Database\Seeder;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dom = ['com', 'net', 'org', 'gov', 'edu'];

        for ($i = 0; $i < 100; $i++) {
            $domain = str_random(rand(16, 30)) . rand(10, 99) . '.' . $dom[rand(0, 4)];

            DB::table('domains')->insert([
                'domain' => $domain,
                'domains_scheme_id' => rand(1, 4),
                'rating' => rand(0, 99),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
