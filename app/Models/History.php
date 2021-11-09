<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class,'fk_admin_id','id');
    }
}
