<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade as GoutteFacade;
use Goutte\Client;

class ScrapingController extends Controller {
    public function index() {
        $goutte = GoutteFacade::request('GET', 'https://zabuu.site/user/detail/2935683650');
        $user_name = "";
        $answered_count = "";
        $favorite_count = "";
        $ans_before = array();
        sleep(1);
        $goutte->filter('.user_name_za')->each(function ($node) use (&$user_name) {
            $user_name = $node->text();
        });
        sleep(1);
        $goutte->filter('.answered_count')->each(function ($node) use (&$answered_count) {
            $answered_count = $node->text();
            $answered_count = str_replace('&nbsp', '', $answered_count);
        });
        sleep(1);
        $goutte->filter('.favorite_count')->each(function ($node) use (&$favorite_count) {
            $favorite_count = $node->text();
            $favorite_count = str_replace('&nbsp', '', $favorite_count);
        });
        sleep(1);
        $goutte->filter('.ans_before')->each(function ($node) use (&$ans_before) {
            $ans_before[] = $node->filter('a')->attr('href');
        });
        sleep(1);
        $ans_before_count = count($ans_before);
        return view('scraping.result', compact('user_name', 'answered_count', 'favorite_count', 'ans_before', 'ans_before_count'));
    }

    public function getLoginInformation() {
        $client = new Client();
        $login_page = $client->request('GET', 'https://procir-study.site/maegawa207/laravel5.5/public/login');
        $login_form = $login_page->filter('.form-horizontal')->form();
        $login_form['email'] = 'XXXXXX';
        $login_form['password'] = 'XXXXXX';
        $submit_result = $client->submit($login_form);
        sleep(1);
    }
}
