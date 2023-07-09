<?php

// 単語検索からサービスURLの検索に変更

namespace App\Http\Controllers;

// require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

class Twittercontroller extends Controller
{
    public function getTweet()
    {

        $connect = new TwitterOAuth(
            config('twitter.api_key'),
            config('twitter.secret_key'),
            null,
            config('twitter.bearer_token')
        );

        $connect->setApiVersion('2');
        $pref = '京都府';
        $params = [
            'query' => '観光 -is:retweet',
        ];

        $result = $connect->get('tweets/search/recent', $params);
        dd($result);

    }
}
