<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function store(Request $request){

    	//dd($request);

    	$this->validate($request, [
			'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
		]);

		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
      	        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'image';
		$file->move($tujuan_upload,$nama_file);

    	Absensi::create([
    		'id_user' => Auth()->id(),
    		'tanggal' => Carbon::now()->format('Y-m-d'),
    		'jam_masuk' => Carbon::now()->toTimeString(),
    		'foto'		=> $nama_file,
    	]);
    	
    	return redirect()->back();
    }

    public function detail(Request $request){
        $id = $request->id;
        $data = Absensi::find($id);
        

        return response()->json([
            'data' => $data
        ]);
    }
}
