<?php
  include($_SERVER['DOCUMENT_ROOT'] . '/db_connect.php');
  $db = new DB();
  $con = $db->connect();
  header('Content-type: text/html; charset=utf-8');
  error_reporting(E_ALL ^ E_WARNING);

  $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
  $file = $target_dir . basename($_FILES["upload_file"]["name"]);

  $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
  move_uploaded_file($_FILES["upload_file"]["tmp_name"], $file);
  $opfile = fopen($file, "r");
  if ($opfile) {
    $start_time = microtime(true);
    $i = 0;
    while (!feof($opfile)) {
      $content = fgets($opfile);
      $carray = explode(";", $content);
      $carray = str_replace('"', '', $carray);
      $carray = str_replace("'", "", $carray);
      $count_keys = count($carray);
      if ($count_keys == 5) {
          list($personal_account, $full_name, $address, $period, $sum, $water_meters) = $carray;
          $insert_query = "INSERT INTO parsed(personal_account, full_name, address, period, sum, water_meters) VALUES ('$personal_account', '$full_name', '$address', '$period', '$sum', '$water_meters');";
      }
      else {
          list($personal_account, $full_name, $address, $period, $sum, $water_meters) = $carray;
          $meters = explode(";", $water_meters);
          list($sxv, $idk) = $meters;
          $insert_query = "INSERT INTO parsed(personal_account, full_name, address, period, sum, water_meters) VALUES ('$personal_account', '$full_name', '$address', '$period', '$sum', '$sxv');";
      }
      //echo $address;
      $insert = mysqli_query($con, $insert_query);
      if (!$insert) {
        echo mysqli_error($con);
      }
      $i++;
    }
    $end_time = microtime(true);
    $time = $end_time - $start_time;
    echo ("Time: ". $time . "; Inserted " . $i . " strings.");
  }
  else {
    echo "Error: file not found.";
  }

  mysqli_close($con);
