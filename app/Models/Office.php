<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Office;

class Office extends Model
{
    use HasFactory;

    protected $table='offices';

    protected $fillable=['name','password'];

    public function affiliationUsers(){
        return $this->belongsToMany(User::class,'affiliations','office_id','user_id');
    }

    public function affiliationBoards(){
        return $this->hasMany(BulletinBoard::class);
    }

    public function infomations(){
        return $this->hasMany(Infomation::class);
    }
    
    public function schedules(){
        return $this->hasMany(Schedule::class);
    }
    
    public function tables(){
        return $this->hasMany(Table::class);
    }
}
