<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Office;

class BulletinBoard extends Model
{
    use HasFactory;

    protected $table='bulletinBoards';

    protected $fillable = [
        'title',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function opinions(){
        return $this->hasMany(Opinion::class);
    }

    public function office(){
        return $this->belongsTo(Office::class);
    }

}
