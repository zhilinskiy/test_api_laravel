<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //        populate users table and urls table
        factory(App\Models\Ver1\User::class, 5)->create()->each(function ($u) {
            $u->urls()->save(factory(App\Models\Ver1\Url::class)->make());
        });
        //        populate content table
        factory(App\Models\Ver1\Content::class, 10)->create();
    }
}
