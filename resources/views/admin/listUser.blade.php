@extends('layouts.admin')
@section('content')

<div class="container bg-white p-3">
	<h4>List User</h4>
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">Nama</th>
	      <th scope="col">Role</th>
	      <th scope="col">Email</th>
	      <th scope="col">ID Jadwal</th>
	      <th scope="col">Aksi</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($user as $usr)
	    <tr>
	      <th>{{ $usr['name'] }}</th>
	      <td>{{ $usr['role'] }}</td>
	      <td>{{ $usr['email'] }}</td> 
	      <td>{{ $usr['id_jadwal'] }}</td>  
	      <td>
	      	@if($usr['role'] == 'siswa')
	      	<button type="button" onclick="modalEdit({{ $usr['id'] }})" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Edit</button>
	      	<a href="jadwal/{{$usr['id']}}/{{ date('m') }}"><button class="btn btn-primary btn-sm"> Detail</button></a>
	      	@endif
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
        <h5 class="modal-title">Modal title</h5>
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
		    <input type="hidden" class="form-control" name="id" id="ids" aria-describedby="emailHelp" >
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlSelect1">Jadwal</label>
		    <select class="form-control" name="jadwal" id="jadwal">
		      @foreach($jadwal as $jd)
		      <option value="{{$jd['id']}}">{{$jd['nama']}}</option>
		      @endforeach
		    </select>
		  </div>
		
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
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
			url  : "{{ route('userOne')}}",
			data : {
				'id' : id
			},
			success : (data)=>{
				console.log(data);
				$('#ids').val(data.data.id);
				$('#nama').val(data.data.name);
				$('#jadwal').val(data.data.id_jadwal);
				$('#exampleModal').modal('show');
			}

		});
	}

	$('#formEdit').on('submit',function(){
		let data = $(this).serialize();
        console.log(data);
        $.ajax({
            type : "post",
            url  : "{{ route('userEdit') }}",
            data : data,
            success : (data) =>{
                console.log(data);
                $('#exampleModal').modal('hide');
                window.location.reload();
            }
        }); 
	});


</script>


@endsection