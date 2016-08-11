<?php
require('config.php');
$myfile = fopen("token.txt", "w") or die("Unable to open file!");
fwrite($myfile, "");
fclose($myfile);
echo "<a href='".$url_app."/myapp'>Click TO LOGIN</a>";
?>

