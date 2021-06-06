<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'state',
        'city',
        'street',
        'district',
        'number',
        'complement',
        'reference_point',
        'zip_code',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
