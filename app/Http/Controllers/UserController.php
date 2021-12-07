<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Jadwal;
use App\Service\JadwalService;


class UserController extends Controller
{
    public function index(){
    	$user = User::all();
    	$jadwal = Jadwal::all();
    	//dd($user);
    	
    	return view('admin.listUser',compact('user','jadwal'));

    }

    public function getOne(Request $request){
    	$id = $request->id;

    	$data = User::find($id);

    	return response()->json([
    		'data' => $data
    	]);
    }

    public function edit(Request $request){
    	
    	$data = User::find($request->id);
    	$data->name = $request->nama;
    	$data->id_jadwal = $request->jadwal;
    	$data->save();

    	return response()->json([
    		'data' => $data
    	]);
    }

    public function history(Request $request){
        $jadwals = JadwalService::custom(date('m'));

        return view('user.jadwal',compact('jadwals'));
    }
}
