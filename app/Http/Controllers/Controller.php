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

    public function get_bands() {
    	$bands = band::all();

    	$select_str = '<select name="band_name" id="band_name">';

    	foreach($bands as $band) {
    		$select_str .= '<option value="' . $band->id . '">' . $band->name . '</option>';
    	}

    	$select_str .= '</select>';

    	echo $select_str;
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

    	$html = '';

    	$class = 'odd';
    	foreach($albums as $album) {
    		$html .= view('filtered_albums', ['class' => $class, 'album' => $album])->render();
    		$class = $class == 'even' ? 'odd' : 'even';
    	}

    	echo $html;
    }

    //actions can be view, update or create
    public function album_details($action, $id=null) {
    	$album = album::find($id);

    	return view('album_details', ['album' => $album, 'action' => $action]);
    }

    public function band_details($action, $id=null) {
    	$band = band::find($id);

    	return view('band_details', ['band' => $band, 'action' => $action]);
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

    }

    public function save_album($album, $request) {

    	$album->name = $request->input('name');
    	$album->recorded_date = date('Y-m-d', strtotime($request->input('recorded_date')));
    	$album->release_date = date('Y-m-d', strtotime($request->input('release_date')));
    	$album->number_of_tracks = $request->input('number_of_tracks');
    	$album->label = $request->input('label');
    	$album->producer = $request->input('producer');
    	$album->genre = $request->input('genre');

    	$album->save();

    }
}
