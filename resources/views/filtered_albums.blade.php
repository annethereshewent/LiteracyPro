<tr class="{{$class}}" id="album_row_{{$album->id}}">
	<td class="button"><a href="" onclick="delete_element({{$album->id}}, 'album');return false;"><img src="{{asset('images/delete.png')}}" class="button-img"></a></td>
	<td class="button"><a href="/album_details/update/{{$album->id}}"><img src="{{asset('images/edit.png')}}" class="button-img"></a></td>
	<td><a href="/album_details/view/{{$album->id}}">{{$album->name}}</a></td>
	<td>{{$album->recorded_date}}</td>
	<td>{{$album->release_date}}</td>
	<td>{{$album->number_of_tracks}}</td>
	<td>{{$album->label}}</td>
	<td>{{$album->producer}}</td>
	<td>{{$album->genre}}</td>
</tr>