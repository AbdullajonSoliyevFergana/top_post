<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function sendResponse($result, $success = NULL, $message = NULL, $error_code = 0)
    {
        $response = [
            'success' => $success,
            'data' => $result,
            'message' => $message,
            'error_code' => $error_code,

        ];

        return response()->json($response, 200);
    }


    public function getToken()
    {
        $headers = getallheaders();
        return (isset($headers['Token'])) ? $headers['Token'] : 'token';
    }

    public function uploadFile($file, $path, $to = "upload", $data = null)
    {

        if ($to == "unlink") {
            if ($data != null){
                unlink($data);
            }
            return null;
        }
        if ($to == "update" && $data != null && $file != null) {
            unlink($data);
        }
        if ($file == null) {
            return $data;
        }
        $file_name = Str::random(20);
        $ext = strtolower($file->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $file_full_name = $file_name . '.' . $ext;
        $upload_path = 'upload/' . $path;    //Creating Sub directory in Public folder to put image
        $save_url_file = $upload_path . $file_full_name;
        $success = $file->move($upload_path, $file_full_name);
        return $save_url_file;
    }
}
