<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Ringtone extends Model
{
    use HasFactory;
    // protected $fillable=['title','description'];
    protected $guarded=[];
    public function category(){
        return $this->hasOne(Category::class, 'id','category_id');
    }
}
