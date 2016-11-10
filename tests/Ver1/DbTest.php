<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Ver1\User;
use App\Models\Ver1\Content;
use App\Models\Ver1\Url;

class DbTest extends TestCase
{
    //Each time make all migrations
    use DatabaseMigrations;

    /**
     * Test user creating in db.
     *
     * @return void
     */
    public function testUserCreate() {
        $user = factory(App\Models\Ver1\User::class)->create();

        $this->seeInDatabase('users', [
            'id' => $user->id,
            'browser_name' => $user->browser_name,
            'user_key' => $user->user_key,
        ]);
    }

    /**
     * Test content creating in db.
     *
     * @return void
     */
    public function testContentCreate() {
        $content = factory(App\Models\Ver1\Content::class)->create();

        $this->seeInDatabase('contents', [
            'id' => $content->id,
            'content' => $content->content,
            'js_files' => $content->js_files
        ]);
    }

    /**
     * Test url creating in db.
     *
     * @return void
     */
    public function testUrlCreate() {
        $url = factory(App\Models\Ver1\Url::class)->create();

        $this->seeInDatabase('urls', [
            'id' => $url->id,
            'user_id' => $url->user_id,
            'url' => $url->url
        ]);
    }
}
