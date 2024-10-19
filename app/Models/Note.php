<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'subscriber_id'];

    protected $hidden =['created_at','updated_at'];

    public function subscribers(){
        return $this->belongsTo(Subscriber::class,'subscriber_id');
    }
}
