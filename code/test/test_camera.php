<?php
$raspivid = '/usr/bin/raspivid';

$width = 640;
$height = 480;

$options = "-w $width -h $height -fps 15 -b 2000000 -t 0";

$cmd = "$raspivid $options &";
exec($cmd);

ignore_user_abort(true);
set_time_limit(0);

$streaming = true;

while ($streaming){
    $data = file_get_contacts('/dev/stdin');

    if(strlen($data) == 0) {
       $streaming = false;
       break;
    }

    $echo $data;
    ob-flush();
    flush();
}