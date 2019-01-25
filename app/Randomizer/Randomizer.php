<?php

namespace App\Randomizer;

use App\Account;
use App\Target;
use Carbon\Carbon;

class Randomizer
{
    private $target;
    private $account;

    public function __construct(Target $target, Account $account)
    {
        $this->target = $target;
        $this->account = $account;
    }

    // Возвращает имя профиля (как называется профиль в админке)
    public function getProfileName()
    {
        return $this->target->profile->name;
    }

    // Возвращает домен профиля (ссылка на сайт)
    public function getDomain()
    {
        return $this->target->profile->domain;
    }

    // Возвращает E-mail адрес, на который будет произведена регистрация
    public function getEmail()
    {
        return $this->account->getEmail();
    }

    // Возвращает пол пользователя на английском языке (male или female)
    public function getGender()
    {
        return $this->account->gender;
    }

    // Возвращает имя пользователя
    public function getUsername()
    {
        return $this->account->username;
    }

    // Возвращает пароль пользователя
    public function getPassword()
    {
        return $this->account->password;
    }

    // Возвращает префикс для пользователя ('Ms.' или 'Mr.')
    public function getPrefix()
    {
        return $this->account->prefix;
    }

    // Возвращает префикс для пользователя ('ms' или 'mr')
    // В нижнем регистре и без точки в конце
    public function getPrefixWithoutDot()
    {
        return mb_strtolower(substr($this->account->prefix, 0, -1));
    }

    // Возвращает префикс для пользователя ('Miss' или 'Mister')
    // Полное слово на английском языке
    public function getPrefixFull()
    {
        if ($this->getPrefixWithoutDot() == 'ms') {
            return 'Miss';
        }

        return 'Mister';
    }

    // Возвращает имя пользователя
    public function getFirstname()
    {
        return $this->account->firstname;
    }

    // Возвращает отчество пользователя
    public function getMiddlename()
    {
        return $this->account->middlename;
    }

    // Возвращает первую букву отчества пользователя в верхнем регистре
    public function getMiddlenameShort()
    {
        return mb_strtoupper($this->account->middlename{0});
    }

    public function getLastname()
    {
        return $this->account->lastname;
    }

    // Возвращает дату рождения в формате YYYY-MM-DD
    public function getBirthday()
    {
        return $this->account->birthday;
    }

    // Возвращает только год рождения
    public function getBirthdayYear()
    {
        return substr($this->account->birthday, 0, 4);
    }

    // Возвращает месяц рождения числом без ведущего нуля, 1 - январь
    public function getBirthdayMonthInt()
    {
        return (int)substr($this->account->birthday, 5, 2);
    }

    // Возвращает день рождения числом без ведущего нуля
    public function getBirthdayDayInt()
    {
        return (int)substr($this->account->birthday, -2);
    }

    // Возвращает полное название месяца в котором родился пользователь
    public function getBirthdayMonthName()
    {
        $date = Carbon::createFromFormat('Y-m-d', $this->account->birthday);
        return $date->format('F');
    }

    // Возвращает адрес (улица, дом)
    public function getAddress1()
    {
        return $this->account->address1;
    }

    // Возвращает вдрес 2 (может быть пустым)
    public function getAddress2()
    {
        return $this->account->address2;
    }

    // Возвращает город
    public function getCity()
    {
        return $this->account->city;
    }

    // Возвращает полное название штата
    public function getState()
    {
        return $this->account->state;
    }

    // Возвращает аббривиатуру штара, 2 символа в верхнем регистре
    public function getStateAbbr()
    {
        return $this->account->state_shortcode;
    }

    // Возвращает почтовый индекс
    public function getZip()
    {
        return $this->account->zip;
    }

    // Возвращает номер телефона в формате '(XXX) XXX-XXXX'
    public function getPhone()
    {
        $phone = substr($this->account->phone, 2);
        $part1 = substr($phone, 0, 5);
        $part2 = substr($phone, 6);

        return $part1 . ' ' . $part2;
    }

    // Возвращает телефонный код страны
    public function getPhoneCountryCode()
    {
        return substr($this->account->phone, 1, strpos($this->account->phone, '(') - 1);
    }

    // Возвращает телефонный код города
    public function getPhoneCityCode()
    {
        $pos1 = strpos($this->account->phone, '(') + 1;
        $pos2 = strpos($this->account->phone, ')');

        return substr($this->account->phone, $pos1, $pos2 - $pos1);
    }

    // Возвращает первую часть телефона после кода города
    public function getPhonePart1()
    {
        $pos1 = strpos($this->account->phone, '-') + 1;
        $pos2 = strrpos($this->account->phone, '-');

        return substr($this->account->phone, $pos1, $pos2 - $pos1);
    }

    // Возвращает вторую часть телефона после кода города
    public function getPhonePart2()
    {
        return substr($this->account->phone, -4);
    }

    // Возвращает имя субдомена для блога
    public function getDomainName()
    {
        return $this->account->domain_word;
    }

    // Возвращает название компании
    public function getBusinessName()
    {
        return $this->target->profile->business_name;
    }

    // Возвращает ответ на вопрос "Девичья фамилия вашей матери"
    public function getMothersMaidenName()
    {
        return $this->target->profile->security_answer_mother;
    }

    // Возвращает ответ на вопрос "Как зовут ваше домашнее животное"
    public function getPetName()
    {
        return $this->target->profile->security_answer_pet;
    }

    // Возвращает название блога
    public function getBlogName()
    {
        //
    }

    // Возвращает описание блога или описание компании
    public function getBlogDescription()
    {
        //
    }

    // Возвращает описание блога или описание компании (первый параграф)
    public function getBlogDescriptionFirstParagraph()
    {
        //
    }

    // Возвращает ключевую фразу для ссылки
    public function getAnchor()
    {
        //
    }

    // Возвращает основную ключевую фразу для ссылки
    public function getMainAnchor()
    {
        //
    }

    // Возвращает настраиваемое поле #1
    public function getCustomField1()
    {
        return $this->target->profile->field1;
    }

    // Возвращает настраиваемое поле #2
    public function getCustomField2()
    {
        return $this->target->profile->field2;
    }

    // Возвращает настраиваемое поле #3
    public function getCustomField3()
    {
        return $this->target->profile->field3;
    }
}
