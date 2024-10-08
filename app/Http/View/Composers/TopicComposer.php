<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Topic;

class TopicComposer
{
    public function compose(View $view)
    {
        $topics = Topic::all();
        $view->with('topics', $topics);
    }
}
