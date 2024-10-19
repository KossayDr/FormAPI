<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable =['url','subscriber_id'];

    protected $hidden=['created_at','updated_at'];

    // subscriber related methods
    public function subscribers(){
        return $this->belongsTo(Subscriber::class,'subscriber_id');
    }
}
