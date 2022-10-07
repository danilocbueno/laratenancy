<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'body', 'price', 'slug'];

    public function setNameAttribute($value) {
        $slug = Str::slug($value);
        $matchs = $this->uniqueSlug($slug);
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = $matchs ? $slug . '-' . $matchs : $slug;
    }

    public function uniqueSlug($slug) {
        $matchs = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count();
        return $matchs;
    }

    public function getFormatedPrice() {
        return number_format($this->price, 2, ',', '.');
    }

    public function price(): Attribute
    {
        return  new Attribute(
            get: function($value) {
                $price = $value / 100;
                return $price;
            },
            set: function ($value) {
                $value = str_replace(['.', ','], ['', '.'], $value);
                return $value * 100;
            }
        );
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }
}
