<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Tag;

class TagComposer
{
    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tags = Tag::orderBy('name')->get();
        $view->with('tags', $tags);
    }
}