<?php
// Check if a file has been uploaded
if(isset($_FILES['fileToUpload'])) {
  // Get the uploaded file information
  $name_of_uploaded_file = basename($_FILES['fileToUpload']['name']);

  // Get the file extension of the uploaded file
  $type_of_uploaded_file = substr($name_of_uploaded_file, 
                                  strrpos($name_of_uploaded_file, '.') + 1);

  $size_of_uploaded_file = $_FILES["fileToUpload"]["size"]/1024;

  // Specify the directory where the uploaded file will be saved
  $upload_folder = "/var/www/html/uploads/";

  // Create the full path of the uploaded file
  $path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;

  // Check if the file has the right extension
  $valid_extensions = array("jpg", "jpeg", "png");
  if (in_array($type_of_uploaded_file, $valid_extensions)) {
    // Check if the file size is less than 2 MB
    if ($size_of_uploaded_file < 2048) {
      // If the file is valid, move it to the specified directory
      if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], 
$path_of_uploaded_file)) {
        echo "The file has been uploaded successfully.";
      }
    } else {
      echo "The uploaded file is too large.";
    }
  } else {
    echo "Invalid file type.";
  }
}
?>

