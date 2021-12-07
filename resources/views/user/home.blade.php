@extends('layouts.app')
@section('content')

<div class="container bg-white p-3">
	<div class="row">
		<form action="{{ route('getMount') }}" method="GET" class="row align-items-end">
			@csrf
		<div class="form-group col-md-4">
	      <label for="inputState">Bulan</label>
	      <select id="inputState" name="bulan" class="form-control">
	        <option value="1">Januari</option>
	        <option value="2">Februari</option>
	        <option value="3">Maret</option>
	        <option value="4">April</option>
	        <option value="5">Mei</option>
	        <option value="6">Juni</option>
	        <option value="7">Juli</option>
	        <option value="8">Agustus</option>
	        <option value="9">September</option>
	        <option value="10">Oktober</option>
	        <option value="11">November</option>
	        <option value="12">Desember</option>
	      </select>
	    </div>
	    <div class="col-4">
	    	<button type="submit" class="btn btn-primary">Pilih</button>
	    </div>
	    </form>
	</div>
	

	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">Tanggal</th>
	      <th scope="col">Nama</th>
	      <th scope="col">Waktu</th>
	      <th scope="col">Status</th>
	      <th scope="col">Aksi</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($jadwals as $jadwal)
	    <tr>
	      <th>{{ $jadwal['tanggal'] }}</th>
	      <td>{{ $jadwal['nama'] }}</td>
	      <td>{{ $jadwal['waktu'] }}</td>

	      @if($jadwal['status'] == 0)
	      	<td>?</td>
	      	<td></td>
	      @elseif($jadwal['status'] == 1)
	      	<td>Self record</td>
	      	<td><a href="{{route('saveAbsensi')}}">Present</a></td>
	      @elseif($jadwal['status'] == 2)
	      	<td>Recorded</td>
	      	<td></td>
	      @else
	      	<td>Alpha</td>
	      	<td></td>
	      @endif
	      
	    </tr>
	    @endforeach
	  </tbody>
	</table>
</div>




@endsection