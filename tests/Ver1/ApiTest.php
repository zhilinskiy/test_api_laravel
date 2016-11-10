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

    /**
     * Tes check path.
     *
     * @return void
     */
    public function testCheckPath() {
        $faker = Faker\Factory::create();
        $user = factory(App\Models\Ver1\User::class)->create();
        $content = $faker->paragraph;
        $js_files = $faker->paragraph;
        $url = $faker->url;

        $this->json('POST', '/api/v1/check', [
            'user_key' => $user->user_key,
            'content' => $content,
            'js_files' => $js_files,
            'url' => $url
        ])
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'analysed',
                'safe'
            ]);
//        test content saving
        $this->seeInDatabase('contents', [
            'content' => $content,
            'js_files' => $js_files
        ]);
//        test url saving
        $this->seeInDatabase('urls', [
            'url' => $url,
            'user_id' => $user->id
        ]);
//        test data validation
        $this->json('POST', '/api/v1/check', [])
            ->seeStatusCode(422);

    }

    /**
     * Tes count path.
     *
     * @return void
     */
    public function testCountPath() {
        $user = factory(App\Models\Ver1\User::class)->create();
        $user->count_positiv = 100;
        $user->count_negativ = 10;
        $user->save();
        $this->json('POST', '/api/v1/count', [
            'user_key' => $user->user_key
        ])
            ->seeStatusCode(200)
            ->seeJson([
                'count_negativ' => (string)$user->count_negativ,
                'count_positiv' => (string)$user->count_positiv
            ]);
    }
}
