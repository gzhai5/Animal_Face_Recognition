<!DOCTYPE html>
<html>
<body>

<?php

$file = fopen('py_result.txt', 'r');
$num = fgets($file);
fclose($file);
echo $num;

if ($num == "1") {
  echo "get 1";
  header("Location: result/result_cat.html");
} elseif ($num == "2"){
  echo "get 2";
  header("Location: result/result_dog.html");
} elseif ($num == "3"){
  echo "get 3";
  header("Location: result/result_fox.html");
} elseif ($num == "4"){
  echo "get 4";
  header("Location: result/result_koala.html");
} elseif ($num == "5"){
  echo "get 5";
  header("Location: result/result_lion.html");
} elseif ($num == "6"){
  echo "get 6";
  header("Location: result/result_rabbit.html");
} elseif ($num == "7"){
  echo "get 7";
  header("Location: result/result_tiger.html");
} else {
  echo "you made wrong";
}

?>

</body>
</html>