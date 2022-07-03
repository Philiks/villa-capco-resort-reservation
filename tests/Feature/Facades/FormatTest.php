<?php

namespace Tests\Feature;

use App\Facades\Format;
use Tests\TestCase;

class FormatTest extends TestCase
{
    public function test_money_to_be_2_decimal_places()
    {
        $expectedMoney = 100.00;
        $actualMoney = Format::moneyForDisplay(10_000);

        $this->assertEquals($expectedMoney, $actualMoney,
            'The money failed to format to 2-decimal places.');
    }

    public function test_money_to_be_an_integer_after_multiplying_by_100()
    {
        $expectedMoney = 10_000;
        $actualMoney = Format::moneyForDatabase(100.00);

        $this->assertEquals($expectedMoney, $actualMoney,
            'The money failed to format to integer.');
    }

    public function test_string_time_to_be_in_hiA_format_before_displaying()
    {
        $expectedTime = '06:30 PM';
        $actualTime = Format::stringTimeForDisplay('18:30');

        $this->assertEquals($expectedTime, $actualTime,
            'The string time failed to format to "h:i A" time format.');
    }

    public function test_string_time_to_be_in_his_format_before_saving_to_database()
    {
        $expectedTime = '18:30:00';
        $actualTime = Format::stringTimeForDatabase('06:30 PM');

        $this->assertEquals($expectedTime, $actualTime,
            'The string time failed to format to "h:i:s" time format.');
    }
}
