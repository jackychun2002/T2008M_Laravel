<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    //protected neu la id thi k can khai bao
    protected $fillable = ["name"];
    // pulic $timestamps = true neu mac dinh la true,nghia la tu dong cap nhat gia tri
    //cho 2 cot created_at va updated_at
}
