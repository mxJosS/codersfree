<?php

namespace App\Observers;

class GoalObserver
{
    public function creating(Goal $goal)
    {
        $goal->order = Goal::where('course_id', $goal->course_id)->max('order') + 1;
    }
}
