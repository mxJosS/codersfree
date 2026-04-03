<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Observers\SectionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([SectionObserver::class])]
class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'order',
    ];

    //relación inversa de uno a muchos
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }
}
