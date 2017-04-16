<?php
use App\User;
use App\Business;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LandlordRegisterTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * [Register a landlord and then test whether a buisness is auto assigned to them]
     * @return [type] [description]
     */
    public function test_landlordRegister()
    {
        $this->visit('/register')
            ->type('LandLordTester', 'name')
            ->type('1234567@1.com', 'email')
            ->type('123456', 'password')
            ->type('123456', 'password_confirmation')
            ->select('2', 'role')
            ->press('Register')
            ->seePageIs('/');
        $user = User::latest()->first();
        $this->seeInDatabase('users', ['email' => '1234567@1.com'])
            ->seeInDatabase('businesses', ['user_id' => $user->id]);
    }
    	
}
