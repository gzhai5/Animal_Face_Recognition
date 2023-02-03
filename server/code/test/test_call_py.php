<?php
$img = file_get_contents("ball.png");
$data = base64_encode($img);
$content = $data;
$file = "myFile.base64";
$fp = fopen($file,"wb")
fwrite($fp,$content);
fclose($fp);
$output = shell_exec("python helloworld.py);
echo $output;
?>