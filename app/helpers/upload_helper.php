<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

// Function to upload images for users and  products.
function uploadPic($file, $url) {
  $targetDir = PUBLICROOT . $url;
  $targetFile = $targetDir . basename($file["image"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
  $encryptFileName = md5(date("Y-m-d H:i:s").$file['image']['tmp_name']);
  $newFileName = $encryptFileName . '.'. $imageFileType;
  $targetFile = $targetDir . basename($newFileName);
// Check if image file is a actual image or fake image
  if (isset($_POST["submit"])) {
    $check = getimagesize($file["image"]["tmp_name"]);
    if ($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
     flash('edit_profile', 'File is not an image.', ' alert alert-warning');
      $uploadOk = 0;
    }
  }
// Check if file already exists
  if (file_exists($targetFile)) {
    flash('upload_image', 'Sorry, file already exists.', ' alert alert-warning');
    $uploadOk = 0;
  }
// Check file size
  if ($file["image"]["size"] > 200000) {
    flash('upload_image', 'Sorry, your file is to large', ' alert alert-warning');
    $uploadOk = 0;
  }
// Allow certain file formats
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    flash('upload_image', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.', ' alert alert-warning');
    $uploadOk = 0;
  }
// Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    flash('upload_image', 'Sorry, your file was not uploaded.', ' alert alert-warning');
    return false;
// if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($file["image"]["tmp_name"], $targetFile)) {
      flash('upload_image', 'The image has been uploaded.');

      $file = $newFileName;
      return $file;
    } else {
      flash('upload_image', 'Sorry, there was an error uploading your file.', ' alert alert-warning');
      return false;
    }
  }
}
