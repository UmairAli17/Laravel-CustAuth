<?php
use App\User;
use App\Business;
use App\Residence;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LandlordFunctionalityTest extends TestCase
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
                ->seeInDatabase('roles_user', ['roles_id' => 2, 'user_id' =>  $user->id])
                ->seeInDatabase('businesses', ['user_id' => $user->id]);
    }
    
    
  
    /**
     * [Test Whether Adding a Residence will Auto Assign the Landlord's Business ID to Residence]
     * @return [type] [description]
     */
    public function test_AddResidence()
    {
        $user = User::find(2);
        $business = $user->business;
            $this->actingAs($user)
                ->visit('/landlord/add-residence')
                ->type('My Street', 'street')
                ->type('South', 'city')
                ->type('wf148ED', 'postcode')
                ->press('Add Residence');
        $latest = Residence::latest()->first();
            $this->seeInDatabase('residences', ['id' => $latest->id, 'business_id' =>  $business->id]);
    } 


    /**
     * [Test Update Residence Controller & Action]
     * @return [type] [description]
     */
    public function test_UpdateResidence()
    {
        $user = User::find(2);
        $latest = Residence::latest()->first();
        $this->actingAs($user)
            ->visit('/residence/' . $latest->id . '/edit')
            ->type('Updated Residence', 'street')
            ->press('Update Residence');
        $this->seeInDatabase('residences', ['id' => $latest->id, 'street' =>  'Updated Residence']);
        $this->assertResponseOk();


    }


    /**
     * [Test Delete Residence Controller & Action]
     * @return [type] [description]
     */
    public function test_DeleteResidence()
    {
        $user = User::find(2);
        $latest = Residence::latest()->first();
        $this->action('PATCH', 'ResidenceController@delete', ['id' => $latest->id]);
            $this->actingAs($user);
        $latest->delete();

    }

    public function test_editBusiness()
    {
        $user = User::find(2);
        $business = $user->business;
        $this->action('PATCH', 'LandlordController@update', ['id' => $business->id]);
            $this->actingAs($user);
            $business->update(array('name' => 'Updated business by Test',));
            $this->seeInDatabase('businesses', ['name' => 'Updated business by Test']);
    }
  
}
