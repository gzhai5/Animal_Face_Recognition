<?php
  // Check if a file was uploaded
  if (isset($_FILES['fileToUpload'])) {
    // Set the target directory for the file
    $target_dir = "home/pi/";

    // Get the original file name
    $file_name = basename($_FILES["fileToUpload"]["name"]);

    // Create the full target path for the file
    $target_file = $target_dir . $file_name;

    // Attempt to move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      // File was successfully uploaded and saved
      echo "The file " . $file_name . " has been uploaded and saved to " . $target_dir;
    } else {
      // There was an error uploading the file
      echo "Sorry, there was an error uploading your file.";
    }
  } else {
    // No file was uploaded
    echo "No file was uploaded.";
  }
?>
