<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // ฟังก์ชันสำหรับดึงข้อมูลหนังสือทั้งหมด
    public function index()
    {
        $books = Book::paginate(5);
        return response()->json($books, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลก่อนเพิ่ม
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'is_available' => 'required|boolean',
        ]);

        // การเพิ่มข้อมูลลง Database
        $book = Book::create($request->all());

        return response()->json($book, 201); // สถานะ 201 สำหรับการสร้างใหม่
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // ตรวจสอบข้อมูลก่อนอัปเดต
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|max:255',
            'is_available' => 'sometimes|required|boolean',
        ]);

        // ค้นหาหนังสือ
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        // อัปเดตข้อมูล
        $book->update($request->all());
        return response()->json($book, 200); // ส่งกลับข้อมูลที่อัปเดตแล้ว
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();
        return response()->json(['message' => 'Book deleted successfully'], 200); // สถานะ 200 สำหรับการลบ
    }
}
