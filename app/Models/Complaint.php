<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Site;

class Complaint extends Model
{
    protected $fillable = [
        'fullname', 'site_id', 'category_id', 'phone', 'complain', 'suggestion', 'like',
    ];
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function site() {
        return $this->belongsTo(Site::class, 'site_id', 'id');
    }
}
