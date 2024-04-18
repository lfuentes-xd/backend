<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'IdUserFK',
        'IdFoodFK'
    ];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'IdUserFK');
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'IdFoodFK');
    }
}
