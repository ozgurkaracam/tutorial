<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $hidden=['id','password'];
    protected $guarded=[];
    protected $appends=[];
 // async, attach,detach
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'post_tags');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function category_slug()
    {
        return $this->category->slug;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->attributes['title']);
    }

    public function getUpdatedAttAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->format('d-m-Y');
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->title;
    }

    public function setTitleAttribute($value)
    {
        if($value!=$this->attributes['title']){
            $this->attributes['slug']=Str::slug($value).'-'.rand(0,999);
        }
        $this->attributes['title']=$value;
    }

    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }
}
