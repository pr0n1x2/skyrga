@extends('ubot')

@section('title', 'Generate Data')

@section('content')
<input type="hidden" name="profile_name" value="{{$randomizer->getProfileName()}}">
<input type="hidden" name="domain" value="{{$randomizer->getDomain()}}">
<input type="hidden" name="email" value="{{$randomizer->getEmail()}}">
<input type="hidden" name="gender" value="{{$randomizer->getGender()}}">
<input type="hidden" name="username" value="{{$randomizer->getUsername()}}">
<input type="hidden" name="password" value="{{$randomizer->getPassword()}}">
<input type="hidden" name="prefix" value="{{$randomizer->getPrefix()}}">
<input type="hidden" name="prefix_withou_dot" value="{{$randomizer->getPrefixWithoutDot()}}">
<input type="hidden" name="prefix_full" value="{{$randomizer->getPrefixFull()}}">
<input type="hidden" name="firstname" value="{{$randomizer->getFirstname()}}">
<input type="hidden" name="middlename" value="{{$randomizer->getMiddlename()}}">
<input type="hidden" name="middlename_short" value="{{$randomizer->getMiddlenameShort()}}">
<input type="hidden" name="lastname" value="{{$randomizer->getLastname()}}">
<input type="hidden" name="birthday" value="{{$randomizer->getBirthday()}}">
<input type="hidden" name="birthday_year" value="{{$randomizer->getBirthdayYear()}}">
<input type="hidden" name="birthday_month_int" value="{{$randomizer->getBirthdayMonthInt()}}">
<input type="hidden" name="birthday_day_int" value="{{$randomizer->getBirthdayDayInt()}}">
<input type="hidden" name="birthday_month_name" value="{{$randomizer->getBirthdayMonthName()}}">
<input type="hidden" name="address1" value="{{$randomizer->getAddress1()}}">
<input type="hidden" name="address2" value="{{$randomizer->getAddress2()}}">
<input type="hidden" name="city" value="{{$randomizer->getCity()}}">
<input type="hidden" name="state" value="{{$randomizer->getState()}}">
<input type="hidden" name="state_abbr" value="{{$randomizer->getStateAbbr()}}">
<input type="hidden" name="zip" value="{{$randomizer->getZip()}}">
<input type="hidden" name="phone" value="{{$randomizer->getPhone()}}">
<input type="hidden" name="phone_country_code" value="{{$randomizer->getPhoneCountryCode()}}">
<input type="hidden" name="phone_city_code" value="{{$randomizer->getPhoneCityCode()}}">
<input type="hidden" name="phone_part1" value="{{$randomizer->getPhonePart1()}}">
<input type="hidden" name="phone_part2" value="{{$randomizer->getPhonePart2()}}">
<input type="hidden" name="domain_name" value="{{$randomizer->getDomainName()}}">
<input type="hidden" name="business_name" value="{{$randomizer->getBusinessName()}}">
<input type="hidden" name="mothers_maiden_name" value="{{$randomizer->getMothersMaidenName()}}">
<input type="hidden" name="pet_name" value="{{$randomizer->getPetName()}}">
<input type="hidden" name="blog_name" value="{{$randomizer->getBlogName()}}">
<input type="hidden" name="blog_description" value="{{$randomizer->getBlogDescription()}}">
<input type="hidden" name="blog_first_paragraph" value="{{$randomizer->getBlogDescriptionFirstParagraph()}}">
<input type="hidden" name="anchor" value="{{$randomizer->getAnchor()}}">
<input type="hidden" name="main_anchor" value="{{$randomizer->getMainAnchor()}}">
<input type="hidden" name="custom_field1" value="{{$randomizer->getCustomField1()}}">
<input type="hidden" name="custom_field2" value="{{$randomizer->getCustomField2()}}">
<input type="hidden" name="custom_field3" value="{{$randomizer->getCustomField3()}}">

<div class="row">
    <div class="col-md-12">
        <div>
            <div class="portlet">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 id="data-is-complete" style="text-align: center">Data collection in progress, wait a few seconds.</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection