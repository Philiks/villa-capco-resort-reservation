<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserFullnameTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_fullname_is_in_last_name_comma_first_name_format()
    {
        $user = User::factory()->create([
            'last_name' => 'lastname',
            'first_name' => 'firstname'
        ]);

        $expected = 'lastname, firstname';
        $actual = $user->getFullname();

        $this->assertEquals($expected, $actual, 'The two full names are not the same.');
    }
}
