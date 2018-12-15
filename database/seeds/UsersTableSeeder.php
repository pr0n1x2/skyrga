<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users[] = [
            'firstname' => 'Vladimir',
            'lastname' => 'Skirga',
            'email' => 'vladimir.skirga84@gmail.com',
            'password' => 'vladimir111',
            'photo' => '5bee7e80551e9.jpeg',
            'role' => \App\User::ADMIN_ROLE,
            'is_active' => 1
        ];

        $users[] = [
            'firstname' => 'Velma',
            'lastname' => 'Shipley',
            'email' => 'velma.shipley@gmail.com',
            'password' => '1234567',
            'photo' => '5bee822c16913.jpeg',
            'role' => \App\User::USER_ROLE,
            'is_active' => 1
        ];

        $users[] = [
            'firstname' => 'Susan',
            'lastname' => 'Whitehead',
            'email' => 'susan.whitehead@yahoo.com',
            'password' => '1234567',
            'photo' => '5bee82b356175.jpeg',
            'role' => \App\User::AUTHOR_ROLE,
            'is_active' => 1
        ];

        $users[] = [
            'firstname' => 'Daniel',
            'lastname' => 'Smith',
            'email' => 'daniel.smith@mail.com',
            'password' => '1234567',
            'photo' => '5bee83204c86e.jpeg',
            'role' => \App\User::AUTHOR_ROLE,
            'is_active' => 1
        ];

        $users[] = [
            'firstname' => 'Michael',
            'lastname' => 'Bevill',
            'email' => 'michael.bevill@hotmail.com',
            'password' => '1234567',
            'photo' => '5bee839c61b39.jpeg',
            'role' => \App\User::AUTHOR_ROLE,
            'is_active' => 1
        ];

        $users[] = [
            'firstname' => 'Rosemary',
            'lastname' => 'Gibbons',
            'email' => 'rosemary.gibbons@gmail.com',
            'password' => '1234567',
            'photo' => null,
            'role' => \App\User::AUTHOR_ROLE,
            'is_active' => 1
        ];

        $users[] = [
            'firstname' => 'Angela',
            'lastname' => 'Morin',
            'email' => 'angela.morin@yahoo.com',
            'password' => '1234567',
            'photo' => '5bee84098bf62.jpeg',
            'role' => \App\User::AUTHOR_ROLE,
            'is_active' => 1
        ];

        for ($i = 0; $i < count($users); $i++) {
            if (!empty($users[$i]['photo'])) {
                \File::copy(
                    base_path('resources/assets/global/img/users/' . $users[$i]['photo']),
                    base_path('public/img/users/' . $users[$i]['photo'])
                );
            }

            DB::table('users')->insert([
                'firstname' => $users[$i]['firstname'],
                'lastname' => $users[$i]['lastname'],
                'email' => $users[$i]['email'],
                'password' => Hash::make($users[$i]['password']),
                'photo' => $users[$i]['photo'],
                'role' => $users[$i]['role'],
                'is_active' => $users[$i]['is_active'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
