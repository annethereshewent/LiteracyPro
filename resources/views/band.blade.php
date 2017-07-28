@extends('layouts.master')
<h1>Bands Page</h1>



@section('main')
	<table class="band_table" cellspacing="0">
		<tr>
			<th class="button"></th>
			<th class="button"></th>
			<th>Band Name</th>
			<th>Start Date</th>
			<th>Website</th>
			<th>Still Active</th>
		</tr>
		@foreach($bands as $band)
			<tr class="{{$class}}" id="band_row_{{$band->id}}">
				<td class="button"><a href="#" onclick="delete_element({{$band->id}}, 'band');return false;"><img src="{{asset('images/delete.png')}}" class="button-img"></a></td>
				<td class="button"><a href="/band_details/update/{{$band->id}}"><img src="{{asset('images/edit.png')}}" class="button-img"></a></td>	
				<td><a href="/band_details/view/{{$band->id}}/">{{ $band->name }}</a></td>
				<td>{{ date('F jS Y', strtotime($band->start_date)) }}</td>
				<td><a href="{{ $band->website }}">Click</a></td>
				<td>{{ $band->still_active == 0 ? 'no' : 'yes' }}</td>
			</tr>
			@php 
				$class = ($class == 'even') ? 'odd' : 'even';
			@endphp
		@endforeach
	</table>

	<button type='button' id='add-band-button' onclick='location.href="/band_details/create"'>Add Band</button>
@endsection
