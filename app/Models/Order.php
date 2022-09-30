<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['reference', 'items'];

    public function items() : Attribute
    {
        return new Attribute(
            get: function ($value) {
                return unserialize($value);
            },
            set: function ($value) {
                return serialize($value);
            }
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
