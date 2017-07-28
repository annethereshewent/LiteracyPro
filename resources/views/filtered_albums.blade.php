<tr class="{{$class}}" id="album_row_{{$album->id}}">
	<td class="button"><img src="{{asset('images/delete.png')}}" class="button-img"></td>
	<td class="button"><img src="{{asset('images/edit.png')}}" class="button-img"></td>
	<td>{{$album->name}}</td>
	<td>{{$album->recorded_date}}</td>
	<td>{{$album->release_date}}</td>
	<td>{{$album->number_of_tracks}}</td>
	<td>{{$album->label}}</td>
	<td>{{$album->producer}}</td>
	<td>{{$album->genre}}</td>
</tr>