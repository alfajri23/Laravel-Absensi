@extends('layouts.admin')
@section('content')

<div class="container bg-white p-3">
	<div class="row flex-row justify-content-between">
		<div class="col-10">
			<h4>List jadwal</h4>
		</div>
		
		<div class="col-2">
			<button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah</button>
		</div>
		
	</div>
	
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">Id</th>
	      <th scope="col">Nama</th>
	      <th scope="col">Jam masuk</th>
	      <th scope="col">Toleransi</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($jadwal as $jdw)
	    <tr>
	      <th>{{ $jdw['id'] }}</th>
	      <td>{{ $jdw['nama'] }}</td>
	      <td>{{ $jdw['jam_masuk'] }}</td> 
	      <td>{{ $jdw['toleransi_waktu'] }}</td>  
	    </tr>
	    @endforeach
	  </tbody>
	</table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Jadwal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEdit" action="javascript:void(0)" method="post">
        	@csrf
		  <div class="form-group">
		    <label for="exampleInputEmail1">Nama</label>
		    <input type="text" class="form-control" name="nama" id="nama" aria-describedby="emailHelp" >
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Jam Masuk</label>
		    <input type="time" class="form-control" name="time" id="nama" aria-describedby="emailHelp" >
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Toleransi</label>
		    <input type="number" class="form-control" name="toleransi" id="nama" aria-describedby="emailHelp" >
		  </div>
		  
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
	$.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	  });

	$('#formEdit').on('submit',function(){
		let data = $(this).serialize();
        console.log(data);
        $.ajax({
            type : "post",
            url  : "{{ route('jadwalStore') }}",
            data : data,
            success : (data) =>{
                $('#exampleModal').modal('hide');
                window.location.reload();
            }
        }); 
	});




</script>


@endsection