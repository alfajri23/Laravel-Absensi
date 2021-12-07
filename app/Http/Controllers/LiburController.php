<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HariLibur;
use Carbon\Carbon;

class LiburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = HariLibur::all();
        //dd($datas);

        return view('admin.listLibur',compact('datas'));
    }

    public function store(Request $request){

        if($request->id != null){
            $data = HariLibur::find($request->id);
            $data->nama = $request->nama;
            $data->tanggal = $request->tanggal;
            $data->save();
        }else{
            $jadwal = HariLibur::create([
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
            ]);
        }
    }

    
    public function show(Request $request){
        $id = $request->id;

        $data = HariLibur::find($id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function edit(Request $request){
        
        $data = HariLibur::find($request->id);
        $data->name = $request->nama;
        $data->tanggal = $request->tanggal;
        $data->save();

    }

    
    public function delete(Request $request)
    {
        $data = HariLibur::find($request->id);
        $data = $data->delete();


    }
}
