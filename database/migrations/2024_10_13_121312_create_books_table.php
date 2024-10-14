<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();                          // สร้างคอลัมน์ id
            $table->string('title');               // คอลัมน์สำหรับชื่อหนังสือ
            $table->string('author');              // คอลัมน์สำหรับชื่อผู้เขียน
            $table->string('category');            // คอลัมน์สำหรับหมวดหมู่หนังสือ
            $table->boolean('is_available');       // คอลัมน์สำหรับสถานะความพร้อมใช้งาน (boolean)
            $table->timestamps();                  // สร้าง created_at และ updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
