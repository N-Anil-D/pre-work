@extends('layouts.app')
@section('content')
<div style="width:80%;margin: auto;">
	<table id="example" class="display" >
			<thead>
				<tr>
					<th>Name</th>
					<th>Amount</th>
					<th>Cost</th>
					<th>Date</th>
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

		var dataSet = {!! json_encode($dt_array, JSON_HEX_TAG) !!};

		$('#example').DataTable( {
					data: dataSet,
					columns: [
						{ title: "Name" },
						{ title: "Amount" },
						{ title: "Cost" },
						{ title: "Date" },
					]
				} );

	} );
</script>
@endsection