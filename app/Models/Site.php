<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Complaint;

class Site extends Model
{
    protected $fillable = [
        'site_name', 'site_region', 'site_mobile',
    ];
    
    public function complaint() {
        return $this->hasMany(Complaint::class);
    }
}
