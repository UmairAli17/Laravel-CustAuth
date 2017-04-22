<?php
use App\User;
use App\Residence;
use App\Posts;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StudentFunctionalityTest extends TestCase
{
	use DatabaseTransactions;

	
    /**
     * [Register a Student with correct email Address: with unimail]
     * @return [type] [description]
     */
    public function test_studentRegisterWithUnimail()
    {
        $this->visit('/register')
            ->type('StudentTester', 'name')
            ->type('U14589@unimail.uni.ac.uk', 'email')
            ->type('123456', 'password')
            ->type('123456', 'password_confirmation')
            ->select('3', 'role')
            ->press('Register')
            ->seePageIs('/');
        $user = User::latest()->first();
        $this->seeInDatabase('users', ['email' => 'U14589@unimail.uni.ac.uk'])
        	->seeInDatabase('roles_user', ['roles_id' => 3, 'user_id' =>  $user->id]);
    }


    /**
     * [Register a Student with correct email Address: without unimail]
     * @return [type] [description]
     */
    public function test_studentRegisterWithoutUnimail()
    {
        $this->visit('/register')
            ->type('StudentTesterIncorrect', 'name')
            ->type('U14589@uni.ac.uk', 'email')
            ->type('123456', 'password')
            ->type('123456', 'password_confirmation')
            ->select('3', 'role')
            ->press('Register')
            ->seePageIs('/');
        $user = User::latest()->first();
        $this->seeInDatabase('users', ['email' => 'U14589@uni.ac.uk'])
            ->seeInDatabase('roles_user', ['roles_id' => 3, 'user_id' =>  $user->id]);
    }

    /**
     * [Register a Student with correct email Address: without Letter Before 
     * Student ID and without unimail]
     * @return [type] [description]
     */
    public function test_studentRegisterWithoutFirstLetter()
    {
        $this->visit('/register')
            ->type('StudentTesterIncorrect', 'name')
            ->type('14589@unimail.uni.ac.uk', 'email')
            ->type('123456', 'password')
            ->type('123456', 'password_confirmation')
            ->select('3', 'role')
            ->press('Register')
            ->seePageIs('/');
        $user = User::latest()->first();
        $this->seeInDatabase('users', ['email' => '14589@unimail.uni.ac.uk'])
            ->seeInDatabase('roles_user', ['roles_id' => 3, 'user_id' =>  $user->id]);
    }

    /**
     * [Register a Student with correct email Address: without Letter Before 
     * Student ID and without unimail]
     * @return [type] [description]
     */
    public function test_studentRegisterWithoutFirstLetterWithoutUnimail()
    {
        $this->visit('/register')
            ->type('StudentTesterIncorrect', 'name')
            ->type('14589@uni.ac.uk', 'email')
            ->type('123456', 'password')
            ->type('123456', 'password_confirmation')
            ->select('3', 'role')
            ->press('Register')
            ->seePageIs('/');
        $user = User::latest()->first();
        $this->seeInDatabase('users', ['email' => '14589@uni.ac.uk'])
            ->seeInDatabase('roles_user', ['roles_id' => 3, 'user_id' =>  $user->id]);
    }

    /**
     * [Register a Student with Incorrect Email]
     * @return [type] [description]
     */
    public function test_studentRegisterIncorrectEmail()
    {
        $this->visit('/register')
            ->type('StudentTesterIncorrect', 'name')
            ->type('14589@gmail', 'email')
            ->type('123456', 'password')
            ->type('123456', 'password_confirmation')
            ->select('3', 'role')
            ->press('Register')
            ->seePageIs('/register')
            ->see('The email must be a valid email address');
    }

    /**
     * [Search for a Residence]
     * @return [type] [description]
     */

    public function test_SearchResidence()
    {
    	$user = User::find(4);
    	$residence = Residence::latest()->first();
    		$this->call('GET', '/residences/q=', ['q' => $residence->name]);
    		$this->actingAs($user)
    			->see($residence->name);

    }

    /**
     * [Post Review on Residence]
     * @return [type] [description]
     */

    public function test_PostReviewOnResidence()
    {
    	$user = User::find(4);
    	$residence = Residence::latest()->first();
    	$newReview = new Posts(
			array
				(
					'title' => 'Review by Test: title',
					'body' => 'Review by Test: Body', 
					'rating' => 3,
					'residence_id' => $residence->id,
				)
    		);
    		$this->call('POST', 'review/', ['id' => $residence->id]);
    		$this->actingAs($user);
    			$postReview = $user->posts()->save($newReview);
    		$review = Posts::latest()->first();
    		$this->seeInDatabase('posts', ['id' => $review->id, 'residence_id' => $residence->id, 'user_id' => $user->id]);

    }

}
