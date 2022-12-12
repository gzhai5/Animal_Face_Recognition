<!DOCTYPE html>
<html>
<body>

<?php
$output = shell_exec('python 3_Recognize_Image.py --image_path 1.jpg');
sleep(20);
echo "<pre>$output</pre>";
?>

</body>
</html>