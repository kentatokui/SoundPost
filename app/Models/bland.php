<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bland extends Model
{
    use HasFactory;

    private $bland_category;

    public function bland_category(){
        $bland_category = bland::all();
        return $bland_category;
    }
}
