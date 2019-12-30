<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Storage;

class BaseController extends Controller
{
    public function sendResponse($result, $message){
        $response= [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];
        return response()->json($response, 200);
    }

    public function sendError($eroorMessage = [], $details){
        $response= [
            'success' => false,
            'message' => $eroorMessage,
            'data' => $details
        ];
        return response()->json($response, 404);
    }

    public function uploadImg($dir, $id, Request $request){
        $request->file('photo')->storeAs($dir, $id . '.jpg' ,'local');
        return $this->sendResponse($dir . '/' . $id, 'Image Uploaded Succesfully');
    }

    public function deleteImg($dir, $id){
        Storage::delete([$dir . '/' . $id . '.jpg']);
        return $this->sendResponse($dir . '/' . $id, 'Image Deleted Succesfully');
    }

    public function getImg($dir, $id){
        if ($dir == 'usersR') {if (Storage::exists('public/users/' . $id . '.jpg')) {return Storage::get('public/users/' . $id . '.jpg');} else {return Storage::get('public/users/' . $dir . '.png');}} else {

        if (Storage::exists('public/' . $dir . '/' . $id . '.jpg')) {
            return Storage::get('public/' . $dir . '/' . $id . '.jpg');
        } else {
            return Storage::get('public/' . $dir . '/' . $dir . '.png');
        }}
    }

}
