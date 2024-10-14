<?php

use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// กำหนด Route API สำหรับ BookController
Route::resource('books', BookController::class)->except(['create', 'edit']); // ไม่ต้องการ Route สำหรับ create และ edit

// กำหนด Route API สำหรับการเพิ่มหนังสือ (ซ้ำซ้อนกับ resource)
Route::post('books', [BookController::class, 'store']);

// กำหนด Route API สำหรับ Login
Route::post('login', [AuthController::class, 'login']);

// สร้างกลุ่ม Middleware สำหรับตรวจสอบสิทธิการเข้าใช้งาน
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::resource('books', BookController::class)->except(['store']); // ไม่ต้องการ Route สำหรับ store
    // กำหนด Route สำหรับการ Logout
    Route::post('logout', [AuthController::class, 'logout']);
});
