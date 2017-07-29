@extends('layouts.master')
<h1>Band Details - {{isset($band->name) ? $band->name : 'Create Band'}}</h1>


@section('main')
	<form method="post" action="/update_band" id="band_form">
		{{csrf_field()}}
		<input type="hidden" name="band_id" value="{{$band->id ?? '0'}}">
		<div class="band-details">
			<div class="row">
				<label class="detail-label">Band Name: </label><span class="attribute" id="name">{{$band->name ?? ''}}</span>
			</div>
			<div class="row">
				<label class="detail-label">Start Date: </label><span class="attribute" id="start_date">{{$band->start_date ?? ''}}</span>
			</div>
			<div class="row">
				<label class="detail-label">Website: </label><span class="attribute" id="website">{{$band->website ?? ''}}</span>
			</div>
			<div class="row">
				<label class="detail-label">Still Active: </label><span class="attribute" id="still_active">{{isset($band->still_active) ? ($band->still_active == 0 ? 'No' : 'Yes') : 'No'}}</span>
			</div>
			<div class="row">
				@if ($action == 'view')
					<button type="button" onclick="show_submit_button()" id="edit_button">Edit</button>
					<button type="button" onclick="location.href='/'" id="back_button">Back</button>
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

	@if (isset($band))
		<div class="band-albums">
			<h3>Albums By {{$band->name}}:</h3>
			<ul class='band-album-list'>
				@foreach($band->albums as $album) 
					<li><a href='/album_details/view/{{$album->id}}'>{{$album->name}}</a></li>
				@endforeach
			</ul>
			<p><a class="add-link" href="/album_details/create?default={{$band->id}}">Add New Album</a></p>
		</div>
	@endif
@endsection

@section('js')
	<script type="text/javascript">
		$(function() {
			//this will add text boxes 
			if ('{{$action}}' != 'view') {
				add_attribute_inputs(function() {
					if ('{{$action}}' == 'create') {
						$("#band_form").attr('action', '/create_band')
					}
				});
			}
		})

	</script>


@endsection