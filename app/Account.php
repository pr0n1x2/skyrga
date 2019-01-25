<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Faker\Generator as Faker;
use Faker\Provider\en_US\Person;
use Faker\Provider\en_US\Address;
use Faker\Provider\Internet;
use Faker\Provider\DateTime;

class Account extends Model
{
    private $faker;
    private $emailName;

    protected $fillable = [
        'mail_account_id', 'gender', 'username', 'password', 'prefix', 'firstname', 'middlename', 'lastname',
        'birthday', 'address1', 'address2', 'city', 'state', 'state_shortcode', 'zip', 'phone', 'domain_word'
    ];

    public function email()
    {
        return $this->belongsTo(MailAccount::class, 'mail_account_id');
    }

    public function generateRandomAccount(Target $target)
    {
        $this->faker = new Faker();

        $this->faker->addProvider(new Person($this->faker));
        $this->faker->addProvider(new Address($this->faker));
        $this->faker->addProvider(new Internet($this->faker));
        $this->faker->addProvider(new DateTime($this->faker));

        $this->setEmail($target);
        $this->setGender();
        $this->setFirstname();
        $this->setMiddlename();
        $this->setLastname();
        $this->setUsername($target);
        $this->setPassword($target);
        $this->setPrefix();
        $this->setBirthday();
        $this->setAddress($target);
        $this->setPhone($target);
        $this->setDomainWord($target);
    }

    private function setEmail($target)
    {
        $this->mail_account_id = $target->getEmailID();
        $this->emailName = $target->getEmail();
    }

    public function getEmail()
    {
        if (is_null($this->emailName)) {
            $this->emailName = $this->email->email;
        }

        return $this->emailName;
    }

    private function setGender()
    {
        $gender = ['female', 'male'];
        $this->gender = $gender[rand(0, 1)];
    }

    private function setFirstname()
    {
        $this->firstname = $this->faker->firstName($this->gender);
    }

    private function setLastname()
    {
        $this->lastname = $this->faker->lastName;
    }

    private function setMiddlename()
    {
        $male = ['Jack', 'Judd', 'Lane', 'Coy', 'Brock', 'Dash', 'Clark', 'Drew', 'Ray', 'Finn', 'Seth', 'Neil',
            'Zane', 'Will', 'Troy', 'Shane', 'Jax', 'Reeve', 'Glenn', 'Jace', 'Drake', 'Wade', 'David', 'Robert'];

        $female = ['Bree', 'Dawn', 'Fawn', 'Fern', 'Aryn', 'Jae', 'Jaidyn', 'Kathryn', 'Krystan', 'Lee', 'Lynn',
            'Mae', 'Sue', 'Blair', 'Blaise', 'Blake', 'Blayne', 'Brooke', 'Kate', 'Merle', 'Raine', 'Rose', 'Rylie',
            'Taye'];

        $index = rand(0, 23);

        $this->middlename = $this->gender == 'male' ? $male[$index] : $female[$index];
    }

    private function setUsername($target)
    {
        if ($target->project->is_use_email_as_username) {
            $this->username = $this->emailName;
        } else {
            $firstname = substr(mb_strtolower($this->firstname), 0, rand(3, 6));
            $middlename = substr(mb_strtolower($this->middlename), 0, 1);
            $lastname = substr(mb_strtolower($this->lastname), 0, rand(3, 8));

            $this->username = $firstname . $middlename . $lastname;
        }
    }

    private function setPassword($target)
    {
        if (!$target->project->is_same_password) {
            if (!$target->project->is_easy_password) {
                do {
                    $password = str_random(rand(10, 13));
                    $numberPos = false;

                    for ($i = 0; $i < strlen($password) - 3; $i++) {
                        if (is_numeric($password{$i})) {
                            $numberPos = $i + 2;
                            break;
                        }
                    }
                } while ($numberPos === false);

                $symbols = ['&', '@', '!', '#', '$', '*'];

                $part1 = substr($password, 0, $numberPos);
                $part2 = substr($password, $numberPos);

                $password = $part1 . $symbols[rand(0, 5)] . substr($part2, 1);
            } else {
                $password = str_random(rand(10, 13));
            }

            $this->password = $password;
        } else {
            $this->password = null;
        }
    }

    private function setPrefix()
    {
        $this->prefix = $this->gender == 'male' ? 'Mr.' : 'Ms.';
    }

    private function setBirthday()
    {
        $this->birthday = $this->faker->dateTimeBetween('-50 years', '1995-01-01')->format('Y-m-d');
    }

    private function setAddress($target)
    {
        if (!$target->project->is_generate_address) {
            $this->address1 = $target->profile->address1;
            $this->address2 = $target->profile->address2;
            $this->city = $target->profile->city;
            $this->state = $target->profile->state;
            $this->state_shortcode = $target->profile->state_shortcode;
            $this->zip = $target->profile->zip;
        } else {
            $this->address1 = $this->faker->buildingNumber . ' ' . $this->faker->streetName;
            $this->address2 = $this->faker->secondaryAddress;
            $this->city = $this->faker->city;
            $this->state = $this->faker->state;
            $this->state_shortcode = $this->faker->stateAbbr;
            $this->zip = substr($this->faker->postcode, 0, 5);
        }
    }

    private function setPhone($target)
    {
        if (!$target->project->is_generate_phone) {
            $this->phone = $target->profile->phone;
        } else {
            $phone = '(' . rand(111, 888) . ')-' . rand(111, 999) . '-' . rand(1111, 9999);

            $this->phone = '+1' . $phone;
        }
    }

    private function setDomainWord($target)
    {
        if (!$target->project->is_use_domainword_as_username) {
            $firstname = substr(mb_strtolower($this->firstname), 0, rand(3, 6));
            $lastname = substr(mb_strtolower($this->lastname), 0, rand(3, 8));

            $this->domain_word = $firstname . $lastname;
        } else {
            $this->domain_word = $this->username;
        }
    }
}
