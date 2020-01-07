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

    // public function uploadImg($dir, $id, Request $request){
    //     $request->file('photo')->storeAs($dir, $id . '.jpg' ,'local');
    //     return $this->sendResponse($dir . '/' . $id, 'Image Uploaded Succesfully');
    // }

    // public function deleteImg($dir, $id){
    //     Storage::delete([$dir . '/' . $id . '.jpg']);
    //     return $this->sendResponse($dir . '/' . $id, 'Image Deleted Succesfully');
    // }

    // public function getImg($dir, $id){
    //     if ($dir == 'usersR') {if (Storage::exists('public/users/' . $id . '.jpg')) {return Storage::get('public/users/' . $id . '.jpg');} else {return Storage::get('public/users/' . $dir . '.png');}} else {

    //     if (Storage::exists('public/' . $dir . '/' . $id . '.jpg')) {
    //         return Storage::get('public/' . $dir . '/' . $id . '.jpg');
    //     } else {
    //         return Storage::get('public/' . $dir . '/' . $dir . '.png');
    //     }}
    // }

    public function sendMessage(Request $request){

		$fields = array(
            'app_id' => "b80afd0e-f7ea-4852-ba10-2e02bba5dfbd",
            'included_segments' => array('activeUs'),
            'headings' => array("en" => $request->get('headings')),
			'contents' => array("en" => $request->get('contents'))
		);

		$fields = json_encode($fields);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic NTlmMGJkNDAtMTJhNC00MjM3LWFjOWUtNTJjZjIzNzE3NzUx'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

}
