<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Jadwal;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Service\JadwalService;

class HomeController extends Controller
{
    public $user;

    //0 = pending,1= dpt mengisi,2=recorded,3=alpha

    public function index(){
        $user = User::find(Auth()->id());
        $user = $user->role;

        if($user == 'siswa'){
            $jadwals = JadwalService::custom(date('m'));

            return view('user.home',compact('jadwals'));
        }else{

            $user = User::all();
            $count = count($user);

            return view('admin.home');
        }
        

    }

    public function getMount(Request $request){

        if($request->bulan == null){
            $id = date('m');
        }else{
            $id = $request->bulan;
        }
        
        $jadwals = JadwalService::custom($id);

        return view('user.jadwal',compact('jadwals','id'));

    }
}
