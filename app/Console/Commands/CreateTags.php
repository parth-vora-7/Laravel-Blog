<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Tag;

class CreateTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:create-tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To generate new random tags for blogs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Tag::truncate();
        factory(Tag::class, 5)->create();
    }
}
