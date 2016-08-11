<?php
// index.php
//http://localhost/cakephpapi/oauth/authorize?client_id=1&client_secret=test&response_type=code&redirect_uri=test&redir=oauth
require_once('config.php');

$oauth2_server_url = $url_app.'/oauthserver/oauth/authorize';

$query_params = array(
           'response_type' => 'code',
           'client_id' => $oauth2_client_id,
           'client_secret' => $oauth2_secret,
           'redirect_uri' => $oauth2_redirect,
           'scope' => 'one'
           );

$forward_url = $oauth2_server_url . '?' . http_build_query($query_params);

header('Location: ' . $forward_url);
?>