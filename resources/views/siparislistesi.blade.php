@extends('layouts.app')
@section('content')
<div style="width:80%;margin: auto;">
	<table id="example" class="display" >
			<thead>
				<tr>
					<th>İsim</th>
					<th>Adet</th>
					<th>Fiyat</th>
					<th>Satın alım tarihi</th>
				</tr>
			</thead>
		</table>
</div>
@endsection
@section('scripts')

<script>
	$(document).ready(function() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var dataSet = {!! json_encode($tabloArrayi, JSON_HEX_TAG) !!};

		$('#example').DataTable( {
					data: dataSet,
					columns: [
						{ title: "İsim" },
						{ title: "Adet" },
						{ title: "Fiyat" },
						{ title: "Satın Alım Tarihi" },
					]
				} );

	} );
</script>
@endsection