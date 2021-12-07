@extends('layouts.admin')
@section('content')

<div class="container bg-white p-3">
	<div class="row flex-row justify-content-between">
		<div class="col-10">
			<h4>List libur</h4>
		</div>
		
		<div class="col-2">
			<button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah</button>
		</div>
		
	</div>
	
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">Nama</th>
	      <th scope="col">Tanggal</th>
	      <th scope="col">Aksi</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($datas as $jdw)
	    <tr>
	      <td>{{ $jdw['nama'] }}</td>
	      <td>{{ $jdw['tanggal'] }}</td> 
	      <td>
	      	<button type="button" onclick="modalEdit({{ $jdw['id'] }})" class="btn btn-primary btn-sm">edit</button>
			<button type="button" onclick="deletes({{ $jdw['id'] }})" class="btn btn-secondary btn-sm">hapus</button>
		  </td>  
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
        	<input type="hidden" class="form-control" name="id" id="id" aria-describedby="emailHelp" >
		  <div class="form-group">
		    <label for="exampleInputEmail1">Nama</label>
		    <input type="text" class="form-control" name="nama" id="nama" aria-describedby="emailHelp" >
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Tanggal</label>
		    <input type="date" class="form-control" name="tanggal" id="tanggal" aria-describedby="emailHelp" >
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

	function modalEdit(id) {
		$.ajax({
			type : "post",
			url  : "{{ route('liburOne')}}",
			data : {
				'id' : id
			},
			success : (data)=>{
				console.log(data);
				$('#id').val(data.data.id);
				$('#nama').val(data.data.nama);
				$('#tanggal').val(data.data.tanggal);
				$('#exampleModal').modal('show');
			}

		});
	}

	function deletes(id){
		$.ajax({
			type : "post",
			url  : "{{ route('liburDelete')}}",
			data : {
				'id' : id
			},
			success : (data)=>{

				window.location.reload();
			}

		});
	}

	$('#formEdit').on('submit',function(){
		let data = $(this).serialize();
        console.log(data);
        $.ajax({
            type : "post",
            url  : "{{ route('liburStore') }}",
            data : data,
            success : (data) =>{
                $('#exampleModal').modal('hide');
                window.location.reload();
            }
        }); 
	});




</script>


@endsection