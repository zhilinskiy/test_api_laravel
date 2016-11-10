<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MiddlewareCheckKeyTest extends TestCase
{
    //    Only request with valid user_key possible
    //Each time make all migrations
    use DatabaseMigrations;

    /**
     * Test check route.
     *
     * @return void
     */
    public function testCheckRoute() {
        $this->json('POST', '/api/v1/check')
            ->seeStatusCode(401);

        $this->json('POST', '/api/v1/check', [
            'user_key' => ''
        ])
            ->seeStatusCode(401);


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
            ->seeStatusCode(200);
    }

    /**
     * Test count route.
     *
     * @return void
     */
    public function testCountRoute() {
        $this->json('POST', '/api/v1/count')
            ->seeStatusCode(401);

        $this->json('POST', '/api/v1/count', [
            'user_key' => ''
        ])
            ->seeStatusCode(401);

        $user = factory(App\Models\Ver1\User::class)->create();
        $this->json('POST', '/api/v1/count', [
            'user_key' => $user->user_key
        ])
            ->seeStatusCode(200);

    }
}
