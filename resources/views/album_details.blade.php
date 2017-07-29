@extends('layouts.master')
<h1>Album Details - {{isset($album->name) ? $album->name : 'Create Album'}}</h1>


@section('main')
	<form method="post" action="/update_album" id="album_form">
		{{csrf_field()}}
		<input type="hidden" name="album_id" value="{{$album->id ?? '0'}}">
		<div class="band-details">
			<div class="row">
				<label class="detail-label">Band Name: </label><span class="attribute" id="band_name">{{ $album->band->name ?? ''}}</span>
			</div>
			<div class="row">
				<label class="detail-label">Album Name: </label><span class="attribute" id="name">{{$album->name ?? ''}}</span>
			</div>
			<div class="row">
				<label class="detail-label">Recorded Date: </label><span class="attribute" id="recorded_date">{{$album->recorded_date ?? ''}}</span>
			</div>
			<div class="row">
				<label class="detail-label">Release Date: </label><span class="attribute" id="release_date">{{$album->release_date ?? ''}}</span>
			</div>
			<div class="row">
				<label class="detail-label">Number of Tracks: </label><span class="attribute" id="number_of_tracks">{{$album->number_of_tracks ?? ''}}</span>
			</div>
			<div class="row">
				<label class="detail-label">Label: </label><span class="attribute" id="label">{{$album->label ?? ''}}</span>
			</div>
			<div class="row">
				<label class="detail-label">Producer: </label><span class="attribute" id="producer">{{$album->producer ?? ''}}</span>
			</div>
			<div class="row">
				<label class="detail-label">Genre: </label><span class="attribute" id="genre">{{$album->genre ?? ''}}</span>
			</div>
			<div class="row">
				@if($action == 'view')
					<button type="button" onclick="show_submit_button()" id="edit_button">Edit</button>
					<button type="button" onclick="location.href='/album'" id="back_button">Back</button>
					<button type="submit" id="save_button" style="display:none">Save</button>
					<button type="button" onclick="show_edit_button()" style="display:none" id="cancel_button">Cancel</button>
				@else
					<button type="button" onclick="show_submit_button()" id="edit_button" style="display:none">Edit</button>
					<button type="submit" id="save_button">Save</button>
					@if ($previous == '')
						<button type="button" onclick="show_edit_button(location.href)" id="cancel_button">Cancel</button>
					@else 
						<button type="button" onclick="show_edit_button('{{$previous}}')" id="cancel_button">Cancel</button>
					@endif
				@endif
			</div>
		</div>
	</form>
@endsection

@section('js')
	<script type="text/javascript">
		$(function() {
			//this will add text boxes 
			if ('{{$action}}' != 'view') {
				add_attribute_inputs(function() {
					if ('{{$default}}' != '') {
						$('#band_name_dropdown').val({{$default}});
					}
					if ('{{$action}}' == 'create') {
						$("#album_form").attr('action', '/create_album')
					}
				});
				
			}
		})

	</script>


@endsection