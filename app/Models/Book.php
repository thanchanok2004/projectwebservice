<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // กำหนดตารางในฐานข้อมูล (ถ้าชื่อไม่ตรงกับ "books")
    protected $table = 'books';

    // กำหนดฟิลด์ที่สามารถกรอกข้อมูลได้
    protected $fillable = ['title', 'author', 'category', 'is_available'];
}
