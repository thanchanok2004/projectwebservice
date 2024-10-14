<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'logout Complete',
        ]);
    }

    public function login(Request $request){


    //การทำงาน validator หรือการตรวจสอบข้อมูลที่ได้รับมา
    $check = Validator::make($request -> all(),[
        'email' => 'required|email',
        'password' => 'required|min:6'
    ]);

    if($check->fails()){
        return response()->json([
            'message' => "Error",
            'status_code' => "404",
        ]);
  } else{
    //แปลงข้อมูลที่ได้จาก รีเควส มาเก็บใส่่ตัวแปร $data
    $data = request(['email','password']);
   // dd($data);

    //การตรวจสอบว่าข้อมูลในตัวแปร $data ตรงกับฐานข้อมูลหรือไม่
    if(Auth::attempt($data)){


        $user = User::where('email', $request->email)->first();
        $token = $user -> createToken('authToken')->plainTextToken;

        return response()->json([
           "message" => "login สำเร็จ",
           "status_code" => "200",
           "user infomation" => $user,
           "token" => $token,
        ]);

    }else{
        dd("ไม่พบผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
    }



 }
}

}
   //dd($request->email . " " . $request->password);//คือการดีบัคข้อมูลอยากรู้อะไร
