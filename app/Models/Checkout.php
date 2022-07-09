<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkout extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['camp_id', 'user_id', 'card_number', 'expired', 'cvc', 'is_paid'];

    public function setExpiredAttribute($value)
    {
        $this->attributes['expired'] = date('Y-m-t', strtotime($value));
    }

    /**
     * Get the camp that owns the Checkout
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function camp(): BelongsTo
    {
        return $this->belongsTo(Camp::class);
    }
}
