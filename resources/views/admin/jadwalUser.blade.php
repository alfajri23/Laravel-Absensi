@extends('layouts.admin')
@section('content')

<div class="container bg-white p-3">

	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">Tanggal</th>
	      <th scope="col">Nama</th>
	      <th scope="col">Waktu</th>
	      <th scope="col">Status</th>
	      <th scope="col">Bukti</th>
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
	      	<td>Waiting</td>
	      	<td></td>
	      	
	      @elseif($jadwal['status'] == 2)
	      	<td>Recorded at <br> {{ $jadwal['time'] }} </td>
	      	<td>
	      		<button class="btn btn-primary btn-sm" onclick="bukti({{ $jadwal['id'] }})">lihat</button>
	      	</td>
	      	
	      @else
	      	<td>Alpha</td>
	      	
	      @endif
	      
	    </tr>
	    @endforeach
	  </tbody>
	</table>
</div>

<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bukti kehadiran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="image">
        	
        </div>
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

	function bukti(id){
		$.ajax({
			type : "post",
			url  : "{{ route('detailAbsensi')}}",
			data : {
				'id' : id
			},
			success : (data)=>{
				console.log(data);
				$('#modalDetail').modal('show');
				$('.image').html(`
					<img src="{{ url('/image/${data.data.foto}') }}" alt="bukti" width="450px">
				`);
			}

		});
	}
</script>




@endsection