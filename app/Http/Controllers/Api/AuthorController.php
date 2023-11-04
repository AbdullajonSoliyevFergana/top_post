<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function registerAuthor(Request $request)
    {
        $check_author = Author::where(['status' => 'active', 'login' => $request->login])->first();
        if ($check_author != null){
            return $this->sendResponse(null, false, "Bunday avtor mavjud!");
        }
        if (strlen($request->password) >= 6) {
            $password = Hash::make($request->password);
            Author::create([
                'login' => $request->login,
                'password' => $password,
            ]);
            return $this->sendResponse(null, true, "Muvaffaqiyatli qo'shildi!");
        }

        return $this->sendResponse(null, false, "Parol uzunligi 6 belgidan kam bo'lmasligi kerak!");
    }

    public function loginAuthor(Request $request)
    {
        $author = Author::where('login', $request->login)->where('status', 'active')->first();
        if ($author == null){
            return $this->sendResponse(null, false, "Avtor topilmadi!", 1);
        }
        if (Hash::check($request->password, $author->password) === FALSE) {
            return $this->sendResponse(null, false, "Parol xato!");
        } else {
            $token = Str::random(30);
            $author->update([
                'token' => $token
            ]);
            $author = Author::where('id', $author->id)->first();

            return $this->sendResponse($author, true, "Xush kelibsiz!");
        }
    }

    public function getAuthor(Request $request){

        $author = $request->author;

        return $this->sendResponse($author, true, "");
    }
}
