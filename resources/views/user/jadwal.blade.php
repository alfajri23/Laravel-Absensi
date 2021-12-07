@extends('layouts.app')
@section('content')

<div class="container bg-white p-3">
	<h4>Jadwal Anda</h4>
	<div class="row flex-row-reverse">
		<div class="col-6">
			<form action="{{ route('getMount') }}" method="GET" class="row align-items-end flex-row flex-row-reverse">
			@csrf
			
		    <div class="col-2">
		    	<button type="submit" class="btn btn-primary">Pilih</button>
		    </div>
		    <div class="form-group col-md-6">
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
		    </form>
		</div>
		
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
	      	<td>
	      		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  				Present
				</button>
			</td>
	      @elseif($jadwal['status'] == 2)
	      	<td>Recorded</td>
	      	<td></td>
	      @elseif($jadwal['status'] == 3)
	      	<td>Alpha</td>
	      	<td></td>
	      @else
	      	<td>Libur {{$jadwal['libur']}} </td>
	      	<td></td>
	      @endif
	      
	    </tr>
	    @endforeach
	  </tbody>
	</table>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="{{route('saveAbsensi')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<b>Upload bukti</b><br/>
					<input type="file" name="file">
				</div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary">Upload</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>

</div>

@endsection