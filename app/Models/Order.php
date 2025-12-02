<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = ['user_id', 'destination_id', 'quantity', 'total_price', 'status', 'payment_proof', 'refund_note'];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function destination(): BelongsTo { return $this->belongsTo(Destination::class); }
}
