<?php

namespace App\Service;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\HariLibur;

use Illuminate\Http\Request;
use Carbon\Carbon;

class JadwalService
{

    //1 = buka
    //0 = pending
    //2 = recorded
    //3 = alpha

    public static function custom($id) //buat bulan
    {
        //get libur
        $liburs = HariLibur::all();
        //get user data
        $user = User::find(Auth()->id());
        //get user jadwal
        $jadwal = $user->jadwal;
        //get user absensi
        $absensis = $user->absensi;
        //define time now
        $time_now = Carbon::now()->format('H:i:s');
        //define time expired for present
        $time_end = explode(":",$jadwal['jam_masuk']);
        $minute = (int)$time_end['1'] + $jadwal['toleransi_waktu'];
        $time_end   = Carbon::createFromTime($time_end['0'], $minute, $time_end['2'])
        ->format('H:i:s');

        $month = '2021-' . $id;
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();

        $jadwals = [];
        while ($start->lte($end)) {
            $status = 0;
            $carbon = Carbon::parse($start);
            $libur = '';

            
            //jika tanggal == skrg && waktu jam == ketentuan absensi
            if( $start->format('Y-m-d') == Carbon::now()->format('Y-m-d') && $jadwal['jam_masuk'] <= $time_now && $time_now <= $time_end){
                $status = 1;
                //break;
            //jika tangggal loop krg dari skrg
            }else if(  $start->format('Y-m-d') < Carbon::now()->format('Y-m-d') ){
                $status = 3;
                //break;
            }else{
                $status = 0;
            }
            

            foreach($absensis as $val) {
              if($start->format('Y-m-d') == $val['tanggal']->format('Y-m-d')){
                $status = 2;
                break;
              }
            }

            foreach($liburs as $lb) {
              if($start->format('Y-m-d') == $lb['tanggal']->format('Y-m-d')){
                $status = 4;
                $libur = $lb['nama'];
                break;
              }
            }



            // if ($carbon->isWeekend() !=true) { 
                $jadwals[] = [
                    'tanggal' => $start->copy()->isoFormat('dddd, D MMMM Y'),
                    'nama' => $jadwal['nama'],
                    'waktu'   => $jadwal['jam_masuk'] . '-' . $time_end,
                    'status'  => $status,
                    'libur'   => $libur,
                ];
                
            //}
            $start->addDay();
        }

        //dd($jadwals);

        return $jadwals;
    }

    public static function byUser($id_user,$id)
    {
        //get user data
        $user = User::find($id_user);
        //get user jadwal
        $jadwal = $user->jadwal;
        //get user absensi
        $absensis = $user->absensi;
        //define time now
        $time_now = Carbon::now()->format('H:i:s');
        //define time expired for present
        $time_end = explode(":",$jadwal['jam_masuk']);
        $minute = (int)$time_end['1'] + $jadwal['toleransi_waktu'];
        $time_end   = Carbon::createFromTime($time_end['0'], $minute, $time_end['2'])
        ->format('H:i:s');

        $month = '2021-' . $id;
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();

        $jadwals = [];
        while ($start->lte($end)) {
            $status = 0;
            $time = '';
            $id_jadwal = '';
            $carbon = Carbon::parse($start);

            
            //jika tanggal == skrg && waktu jam == ketentuan absensi
            if( $start->format('Y-m-d') == Carbon::now()->format('Y-m-d') && $jadwal['jam_masuk'] <= $time_now && $time_now <= $time_end){
                $status = 1;
                //break;
            //jika tangggal loop krg dari skrg
            }else if(  $start->format('Y-m-d') < Carbon::now()->format('Y-m-d') ){
                $status = 3;
                //break;
            }else{
                $status = 0;
            }
            

            foreach($absensis as $val) {
              if($start->format('Y-m-d') == $val['tanggal']->format('Y-m-d')){
                $status = 2;
                $time = $val['created_at']->format('H:i:s');
                $id_jadwal =$val['id']; 
                break;
              }
            }

            // if ($carbon->isWeekend() !=true) { 
                $jadwals[] = [
                    'tanggal' => $start->copy()->isoFormat('dddd, D MMMM Y'),
                    'nama' => $jadwal['nama'],
                    'waktu'   => $jadwal['jam_masuk'] . '-' . $time_end,
                    'status'  => $status,
                    'time'	  => $time,
                    'id'    => $id_jadwal,
                ];
                
            //}
            $start->addDay();
        }

        //dd($jadwals);

        return $jadwals;
    }


}