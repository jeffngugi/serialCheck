<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lot extends Model
{
    use HasFactory;
    use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'lot_no',
        'package',
        'manufacture_date',
        'count',
        'expiry_date',
        'status'
    ];

    public function serials()
    {
        return $this->hasMany(Serial::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
