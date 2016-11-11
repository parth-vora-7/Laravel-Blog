<?php

use Illuminate\Database\Seeder;
use App\Tag;


class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();
        factory(Tag::class, 5)->create();
    }
}
