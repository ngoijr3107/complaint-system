<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Complaint;

class Category extends Model
{
    protected $fillable = ['name', 'description'];
    
    public function Complaint() {
        return $this->hasMany(Complaint::class);
    }
}
