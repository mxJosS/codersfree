<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\CourseStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'summary', 'description', 'status',
        'image_path', 'video_path', 'welcome_message',
        'goobye_message', 'observation', 'user_id',
        'level_id', 'category_id', 'price_id', 'published_at',
    ];

    protected $casts = [
        'status' => CourseStatus::class,
        'published_at' => 'datetime',
    ];

    protected function image(): Attribute
    {
        return new Attribute(
            get: function(){
                return $this->image_path ? Storage::url($this->image_path) : 'https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-6.png';

            }
        );
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }
}
