<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class booksSeeder extends Seeder
{
    public function run()
    {
        // สร้างข้อมูลหนังสือจำลอง 50 รายการ
        Book::factory()->count(50)->create();
    }
}
