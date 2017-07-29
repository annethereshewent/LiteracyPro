<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\band;
use App\album;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function band() {
    	$bands = band::all();

    	return view('band', ['bands' => $bands, 'class' => 'odd']);
    }

    public function get_bands(Request $request) {
    	$bands = band::all();

    	$select_str = '<select name="band_name" id="band_name_dropdown"><option value=""></option>';

    	foreach($bands as $band) {
    		$select_str .= '<option value="' . $band->id . '"' . ($request->input('selected') == $band->name ? 'selected' : '') . '>' . $band->name . '</option>';
    	}

    	$select_str .= '</select>';

    	echo $select_str;
    }

    public function get_albums() {
    	$albums = album::all();

    	echo $this->get_filter_html($albums);
    }

    public function get_band_name($id) {
    	$band = band::find($id);

    	echo $band->name;
    }

    public function album() {
    	$bands = band::all();
    	$albums = album::all();

    	return view('album', ['bands' => $bands, 'albums' => $albums, 'class' => 'odd']);
    }

    public function delete($type, $id) {

    	$type == 'band' ? band::destroy($id) : album::destroy($id); 

    	echo 'success';
    }

    public function filter_albums($id) {
    	$albums = band::find($id)->albums;
    	
    	echo $this->get_filter_html($albums);
    }

    public function get_filter_html($albums) {
    	$html = '';
    	$class = 'odd';

    	foreach($albums as $album) {
    		$html .= view('filtered_albums', ['class' => $class, 'album' => $album])->render();
    		$class = $class == 'even' ? 'odd' : 'even';
    	}

    	return $html;
    }

    //actions can be view, update or create
    public function album_details($action, $id=null, Request $request) {
    	$album = album::find($id);

    	return view('album_details', [
    		'album'    => $album, 
    		'action'   => $action, 
    		'default'  => $request->input('default') ?? '', 
    		'previous' => $request->input('previous') ?? ''
		]);
    }

    public function band_details($action, $id=null, Request $request) {
    	$band = band::find($id);

    	return view('band_details', ['band' => $band, 'action' => $action, 'previous' => $request->input('previous') ?? '']);
    }

    public function update_band(Request $request) {
		$band = band::find($request->input('band_id'));

		

		$this->save_band($band, $request);

		return redirect()->action('Controller@band_details', ['action' => 'view', 'id' => $request->input('band_id')]);
    }	

    public function create_band(Request $request) {
    	
    	$band = new Band();    	

    	$band = $this->save_band($band, $request);

    	return redirect()->action('Controller@band_details', ['action' => 'view', 'id' => $band->id]);
    }

    public function save_band($band, $request) {
    	$this->validate($request, [
			'name' => 'required'
		]);

    	$band->name = $request->input('name');
		$band->start_date = date('Y-m-d', strtotime($request->input('start_date')));
		$band->website = $request->input('website');
		$band->still_active = $request->input('still_active');

		$band->save();

		return $band;
    }

    public function update_album(Request $request) {
    	$album = album::find($request->input('album_id'));

    	$this->save_album($album, $request);

    	return redirect()->action('Controller@album_details', ['action' => 'view', 'id' => $album->id]);
    }

    public function create_album(Request $request) {
    	$album = new album();

    	$album = $this->save_album($album, $request);

    	return redirect()->action('Controller@album_details', ['action' => 'view', 'id' => $album->id]);
    }

    public function save_album($album, $request) {

    	$this->validate($request, [
    		'band_name' => 'required',
    		'name'		=> 'required'
		]);

    	$album->name = $request->input('name');
    	$album->band_id = $request->input('band_name');
    	$album->recorded_date = date('Y-m-d', strtotime($request->input('recorded_date')));
    	$album->release_date = date('Y-m-d', strtotime($request->input('release_date')));
    	$album->number_of_tracks = $request->input('number_of_tracks');
    	$album->label = $request->input('label');
    	$album->producer = $request->input('producer');
    	$album->genre = $request->input('genre');

    	$album->save();

    	return $album;

    }
}
