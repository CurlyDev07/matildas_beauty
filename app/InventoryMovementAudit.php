<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryMovementAudit extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'before_snapshot' => 'array',
        'after_snapshot' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
