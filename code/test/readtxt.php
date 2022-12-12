<!DOCTYPE html>
<html>
<body>

<?php
$file = fopen('py_result.txt', 'r');
$number = fgets($file);
fclose($file);
echo $number;
if ($number == "1") {
  echo "nb";
} else {
  echo "cnm";
}
?>

</body>
</html>