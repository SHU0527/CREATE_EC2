<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{
	public function searchWord(Request $request)
	{
		$requested_words = $request->validate(['word' => 'required']);
		$search_words = \Twitter::get('search/tweets', array('q' => $requested_words, 'count' => '1',  'result_type' => 'recent'))->statuses;
		return view('result', compact('search_words'));
	}
	public function getSearchWordForm() {
		return view('search');
	}
}
