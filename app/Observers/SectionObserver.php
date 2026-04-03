<?php

namespace App\Observers;
use App\Models\Section;
class SectionObserver
{
    public function creating(Section $section)
    {
        // Logic for creating section
        $section->order = Section::where('course_id', $section->course_id)->max('order') + 1;
    }
}
