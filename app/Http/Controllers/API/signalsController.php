<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Signal;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class signalsController extends BaseController
{

    // ===================== Get signals ========================

    public function getsignals($idSi){
        $signals = Signal::orderBy('status', 'desc')->orderBy('idSi', 'desc')->where('idSi', '<', $idSi)->limit(15)->get();
        return $this->sendResponse($signals->toArray(), Signal::all()->count() . '-signals Read Succesfully');
    }



    // ===================== search signals ========================

    public function searchsignals(Request $request){
        $validator = Validator::make($request->all(), [
            'searchCol' => 'required',
            'searchText' => 'required'
        ]);
        if($validator->fails()){return response()->json($validator->errors()->toJson(), 400);}
        $signals = Signal::orderBy('status', 'desc')->orderBy('idSi', 'desc')->where($request->get('searchCol'), 'like',  '%' . $request->get('searchText') . '%')->get();
        return $this->sendResponse($signals->toArray(), Signal::all()->count() . '-Search Completed Succesfully');
    }

    // ===================== Store Signal ========================

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'action' => 'required|boolean',
            'pairs' => 'required|string|max:6',
            'tp' => 'required|numeric',
            'sl' => 'required|numeric',
            'lotXM' => 'required|numeric',
            'lotTNFX' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $signal = Signal::create([
            'name' => $request->get('name'),
            'action' => $request->get('action'),
            'pairs' => $request->get('pairs'),
            'tp' => $request->get('tp'),
            'sl' => $request->get('sl'),
            'lotXM' => $request->get('lotXM'),
            'lotTNFX' => $request->get('lotTNFX'),
            'status' => $request->get('status'),
            'date' => date("Y-m-d H:i")
        ]);
        return $this->sendResponse($signal->toArray(), 'Signal Created Succesfully');
    }



    // ===================== Get Signal ========================

    public function getSignal($idSi){
        $signal = Signal::find($idSi);
        if (is_null($signal)){
            return $this->sendError('Signal Not Found!', $idSi);
        }
        return $this->sendResponse($signal->toArray(), 'Signal Read Succesfully');
    }



    // ===================== Update Signal ========================

    public function update($idSi, Request $request){
        $signal = Signal::find($idSi);
        $input = $request->all();

        if(isset($input['action'])){$signal->action = $input['action'];}
        if(isset($input['pairs'])){$signal->pairs = $input['pairs'];}
        if(isset($input['tp'])){$signal->tp = $input['tp'];}
        if(isset($input['sl'])){$signal->sl = $input['sl'];}
        if(isset($input['lotXM'])){$signal->lotXM = $input['lotXM'];}
        if(isset($input['lotTNFX'])){$signal->lotTNFX = $input['lotTNFX'];}
        if(isset($input['status'])){$signal->status = $input['status'];}

        $signal->date = date("Y-m-d H:i");
        $signal->save();
        return $this->sendResponse($signal->toArray(), 'Signal Updated Succesfully');
    }



    // ===================== Delete Signal ========================

    public function destroy($idSi){
        $signal = Signal::find($idSi);
        $signal->delete();
        return $this->sendResponse($signal->toArray(), 'Signal Deleted Succesfully');
    }

}
