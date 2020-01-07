<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Investor;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class investorsController extends BaseController
{

    // ===================== Get investors ========================

    public function getinvestors($idIn){
        $investors = Investor::orderBy('idIn', 'desc')->where('idIn', '<', $idIn)->limit(15)->get();
        return $this->sendResponse($investors->toArray(), Investor::all()->count() . '-investors Read Succesfully');
    }



    // ===================== search investors ========================

    public function searchinvestors(Request $request){
        $validator = Validator::make($request->all(), [
            'searchCol' => 'required',
            'searchText' => 'required'
        ]);
        if($validator->fails()){return response()->json($validator->errors()->toJson(), 400);}
        $investors = Investor::orderBy('idIn', 'desc')->where($request->get('searchCol'), 'like',  '%' . $request->get('searchText') . '%')->get();
        return $this->sendResponse($investors->toArray(), Investor::all()->count() . '-Search Completed Succesfully');
    }


    // ===================== Store Investor ========================

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:investors|max:20',
            'phone' => 'required|numeric',
            'email' => 'required|string||max:30',
            'price' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $investor = Investor::create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'price' => $request->get('price'),
            'date' => date("Y/m/d H:i")
        ]);
        return $this->sendResponse($investor->toArray(), 'Investor Created Succesfully');
    }



    // ===================== Get Investor ========================

    public function getInvestor($idIn){
        $investor = Investor::find($idIn);
        if (is_null($investor)){
            return $this->sendError('Investor Not Found!', $idIn);
        }
        return $this->sendResponse($investor->toArray(), 'Investor Read Succesfully');
    }



    // ===================== Update Investor ========================

    public function update($idIn, Request $request){
        $investor = Investor::find($idIn);
        $input = $request->all();

        if (isset($input['name'])){
            if ($input['name'] !== $investor->name){
                $validator = Validator::make($request->all(), ['name'=>'unique:investors']);
                if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
                }
            }
        }

        if(isset($input['name'])){$investor->name = $input['name'];}
        if(isset($input['phone'])){$investor->phone = $input['phone'];}
        if(isset($input['email'])){$investor->email = $input['email'];}
        if(isset($input['price'])){$investor->price = $input['price'];}

        $investor->date = date("Y/m/d H:i");
        $investor->save();
        return $this->sendResponse($investor->toArray(), 'Investor Updated Succesfully');
    }



    // ===================== Delete Investor ========================

    public function destroy($idIn){
        $investor = Investor::find($idIn);
        $investor->delete();
        return $this->sendResponse($investor->toArray(), 'Investor Deleted Succesfully');
    }
}
