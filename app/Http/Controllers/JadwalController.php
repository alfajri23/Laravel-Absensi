<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Service\JadwalService;


class JadwalController extends Controller
{
    public function index(){
    	$jadwal = Jadwal::all();
    	//dd($jadwal);
    	
    	return view('admin.listJadwal',compact('jadwal'));

    }

    public function store(Request $request){
    	
    	$jadwal = Jadwal::create([
		    'nama' => $request->nama,
		    'jam_masuk' => $request->time,
		    'toleransi_waktu' => $request->toleransi,
		]);

    }

    public function getUser($ids,$id){
        $jadwals = JadwalService::byUser($ids,$id);

        return view('admin.jadwalUser',compact('jadwals'));

    }
}
