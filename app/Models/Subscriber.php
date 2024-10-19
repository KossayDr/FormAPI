<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;
    protected $fillable =['first_name', 'last_name', 'email', 'phone','birth','address','user_id' ];

 

    protected $casts =[
        'created_at'=> 'datetime:Y-m-d',
         'updated_at' => 'datetime:Y-m-d'
    ];


    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    
    // image related methods
    public function images(){
        return $this->hasMany(Image::class,);
    }

    // note related methods
    public function notes(){
        return $this->hasOne(Note::class);
    }
    // accessor
}


