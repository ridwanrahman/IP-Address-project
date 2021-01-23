<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    use HasFactory;
    protected $fillable = [
        'label', 'ip_address','user_id',
    ];
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
