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
            'Success',
            'Other reason',
            'The site temporarily unavailable',
            'The link is posted as a comment and requires confirmation by the admin',
            'Probably a link to the site was posted by the owner of the site in a natural way',
            'News or blog site, the link is placed only through contact with the admin',
            'The site is part of the Private Blog Network',
            'Link was posted as Press Release',
            'Link was posted as a Paid Guest Post',
            'Link was posted as a Guest Post',
            'Registration page not found',
            'Paid registration',
            'Registration requires confirmation by phone',
            'Registration is allowed only through a Facebook or Google account',
            'The activation link does not come to the E-mail to activate the user account',
            'The site is successfully registered but I could not place the link',
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
