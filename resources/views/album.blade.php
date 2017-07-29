@extends('layouts.master')
<h1>Albums Page</h1>


@section('main')
	<div class="band-filter">
		<label class="band-filter-label">Filter by Band:</label>
		<select class="band-filter-dropdown">
			<option value="">All</option>
			@foreach($bands as $band)
				<option value="{{$band->id}}">{{$band->name}}</option>
			@endforeach
		</select>
	</div>

	<table class="album_table" cellspacing="0">
		<thead>
			<tr>
				<th class="button"></th>
				<th class="button"></th>
				<th>Album Name</th>
				<th>Recorded Date</th>
				<th>Release Date</th>
				<th>Number of Tracks</th>
				<th>Label</th>
				<th>Producer</th>
				<th>Genre</th>
			</tr>
		</thead>
		<tbody id="albums_table_body">
			@foreach($albums as $album) 
				<tr class="{{$class}}" id="album_row_{{$album->id}}">
					<td class="button"><a href="" onclick="delete_element({{$album->id}}, 'album');return false;"><img src="{{asset('images/delete.png')}}" class="button-img"></a></td>
					<td class="button"><a href="/album_details/update/{{$album->id}}?previous=album"><img src="{{asset('images/edit.png')}}" class="button-img"></a></td>
					<td><a href="/album_details/view/{{$album->id}}">{{$album->name}}</a></td>
					<td>{{date('F jS Y',strtotime($album->recorded_date))}}</td>
					<td>{{date('F jS Y', strtotime($album->release_date))}}</td>
					<td>{{$album->number_of_tracks}}</td>
					<td>{{$album->label}}</td>
					<td>{{$album->producer}}</td>
					<td>{{$album->genre}}</td>
				</tr>

				@php 
					$class = ($class == 'even') ? 'odd' : 'even';
				@endphp
			@endforeach
		</tbody>
	</table>

	<button type="button" id="add-album-button" onclick="location.href='/album_details/create'">Add Album</button>
@endsection

@section('js')
	<script type="text/javascript">
		$(function() {
			$('.band-filter-dropdown').change(function() {
				filter_bands($(this).val());
			});
		})
	</script>
@endsection