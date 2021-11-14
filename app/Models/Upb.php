<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upb extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    public function subUnit()
    {
        return $this->belongsTo(SubUnit::class,'subunit_id','id');
    }

}
