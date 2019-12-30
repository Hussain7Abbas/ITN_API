<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class UsersController extends BaseController
{

    // ===================== Get Users ========================

    public function getUsers($idUs){
        $users = User::orderBy('idUs', 'desc')->where('idUs', '<', $idUs)->limit(15)->get();
        return $this->sendResponse($users->toArray(), User::all()->count() . '-Users Read Succesfully');
    }



    // ===================== search Users ========================

    public function searchUsers(Request $request){
        $validator = Validator::make($request->all(), [
            'searchCol' => 'required',
            'searchText' => 'required'
        ]);
        if($validator->fails()){return response()->json($validator->errors()->toJson(), 400);}
        $users = User::orderBy('idUs', 'desc')->where($request->get('searchCol'), 'like',  '%' . $request->get('searchText') . '%')->get();
        return $this->sendResponse($users->toArray(), User::all()->count() . '-Search Completed Succesfully');
    }

    // ===================== Store User ========================

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'phone' => 'required|numeric',
            'gender' => 'required|boolean',
            'address' => 'required|string|max:50',
            'XM' => 'required|string|max:25',
            'TNFX' => 'required|string|max:25',
            'joinDay' => 'required|string|max:10',
            'joinDate' => 'required|string|max:10',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'gender' => $request->get('gender'),
            'address' => $request->get('address'),
            'XM' => $request->get('XM'),
            'TNFX' => $request->get('TNFX'),
            'joinDay' => $request->get('joinDay'),
            'joinDate' => $request->get('joinDate')
        ]);
        return $this->sendResponse($user->toArray(), 'User Created Succesfully');
    }



    // ===================== Get User ========================

    public function getUser($idUs){
        $user = User::find($idUs);
        if (is_null($user)){
            return $this->sendError('User Not Found!', $idUs);
        }
        return $this->sendResponse($user->toArray(), 'User Read Succesfully');
    }



    // ===================== Update User ========================

    public function update($idUs, Request $request){
        $user = User::find($idUs);
        $input = $request->all();

        if (isset($input['name'])){
            if ($input['name'] !== $user->name){
                $validator = Validator::make($request->all(), ['name'=>'unique:users']);
                if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
                }
            }
        }

        if(isset($input['name'])){$user->name = $input['name'];}
        if(isset($input['phone'])){$user->phone = $input['phone'];}
        if(isset($input['gender'])){$user->gender = $input['gender'];}
        if(isset($input['address'])){$user->address = $input['address'];}
        if(isset($input['XM'])){$user->XM = $input['XM'];}
        if(isset($input['TNFX'])){$user->TNFX = $input['TNFX'];}
        if(isset($input['joinDay'])){$user->joinDay = $input['joinDay'];}
        if(isset($input['joinDate'])){$user->joinDate = $input['joinDate'];}

        $user->save();
        return $this->sendResponse($user->toArray(), 'User Updated Succesfully');
    }

    // ===================== Delete User ========================

    public function destroy($idUs){
        $user = User::find($idUs);
        $user->delete();
        return $this->sendResponse($user->toArray(), 'User Deleted Succesfully');
    }

}
