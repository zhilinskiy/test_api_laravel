<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
    //Each time make all migrations
    use DatabaseMigrations;
    //Turn of middleware
    use WithoutMiddleware;

    /**
     * Tes get_key path.
     *
     * @return void
     */
    public function testGetKeyPath() {
//        test path
        $browser_name = 'Chrome';
        $this->json('POST', '/api/v1/get_key', ['browser_name' => $browser_name])
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'user_key'
            ]);
        $this->json('POST', '/api/v1/get_key', ['browser_name' => ''])
            ->seeStatusCode(400);
//        test user saving
        $this->seeInDatabase('users', [
            'browser_name' => $browser_name
        ]);
    }
}
