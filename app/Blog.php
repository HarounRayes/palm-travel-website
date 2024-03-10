<?php


namespace App;


use App\I18n\LocalizableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Blog extends LocalizableModel
{
    use SoftDeletes;
    use HasSlug;

    protected $fillable = ['name_en', 'name_ar', 'info_en', 'info_ar', 'image_en', 'image_ar', 'header_image_en', 'header_image_ar', 'symbol'];

    public function getSlugOptions(): SlugOptions
    {
        if (Auth::guard('admin')->user()->hasAnyPermission('blogs.create.en', 'blogs.edit.en')) {
            return SlugOptions::create()
                ->generateSlugsFrom('name_en')
                ->saveSlugsTo('symbol');
        } else {
            return SlugOptions::create()
                ->generateSlugsFrom('name_ar')
                ->saveSlugsTo('symbol');
        }
    }

    protected $localizable = [
        'name', 'info', 'image', 'header_image'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($invoice) {
            $invoice->sliders()->delete();
            $invoice->comments()->delete();
        });
    }

    public function sliders()
    {
        return $this->hasMany(BlogSlider::class, 'blog_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_id', 'id')->where('status' , 1);
    }

    public function generalInfo()
    {
        return GeneralInformation::where('type', 'blog')->First();
    }

}
