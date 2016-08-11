<?php
/* echo strtotime("2016-09-08 20:06:05"); */
/* echo date("Y-m-d h:i:s",1470767336);
exit; */
// oauth2callback/index.php

require('config.php');
require('HttpPost.class.php');

/**
 * the OAuth server should have brought us to this page with a $_GET['code']
 */
if(isset($_GET['code']) && !isset($home)) {
    // try to get an access token
    $code = $_GET['code'];
    /* $url = 'https://accounts.google.com/o/oauth2/token'; */
    $url = $url_app.'/oauthserver/oauth/access_token';
    // this will be our POST data to send back to the OAuth server in exchange
	// for an access token
    $params = array(
        "code" => $code,
        "client_id" => $oauth2_client_id,
        "client_secret" => $oauth2_secret,
        "redirect_uri" => $oauth2_redirect,
        "grant_type" => "authorization_code"
    );
 
	// build a new HTTP POST request
    $request = new HttpPost($url);
    $request->setPostData($params);
    $request->send();
	// decode the incoming string as JSON
    $responseObj = json_decode($request->getHttpResponse());
    $myfile = fopen("token.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $responseObj->access_token);
    fclose($myfile);
    header('Location: ' . $url_app.'/myapp/home.php');
	
}else{    
    $myfile = fopen("token.txt", "r") or die("Unable to open file!");
    $token = fgets($myfile);
    fclose($myfile);
    
}

if($token){
    // Tada: we have an access token!
    //    echo "OAuth2 server provided access token: " . $responseObj->access_token;
    echo "<br>";
    echo "Get Balance : <a href='".$url_app."/myapp/getuserbalance.php?access_token=".$token."'>Click here</a>";
    echo "<br>";
    //	echo "Add Balance : <a target='_blank' href='".$url_app."/oauthserver/userbalance/add?access_token=".$responseObj->access_token."'>Click here</a>";        
    echo "<br>";
    echo "Logout : <a href='".$url_app."/myapp/logout.php'>Click here</a>";
}else{
    echo "<a href='".$url_app."/myapp'>LOGIN</a>";
}


?>