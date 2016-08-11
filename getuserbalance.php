<?php
// index.php
//http://localhost/cakephpapi/oauth/authorize?client_id=1&client_secret=test&response_type=code&redirect_uri=test&redir=oauth
require_once('config.php');
require('HttpPost.class.php');

$url = $url_app.'/oauthserver/userbalance/userbalance?access_token='.$_GET['access_token'];



$request = new HttpPost($url);
$request->send();
    // decode the incoming string as JSON
$responseObj = json_decode($request->getHttpResponse());
echo "Balance: " . $responseObj[0]->balance;
echo "<br>";
echo "<a href='".$url_app."/myapp/home.php'>Back</a>";

