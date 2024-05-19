<?php
  class DB {
    function __construct() {
      $this->connect();
    }

    function __destruct() {
      $this->close();
    }

    function connect() {
      @include 'db_config.php';
      $con = mysqli_connect(DB_SERVER, DB_LOGIN, DB_PASSWORD, DB_NAME) or die(mysql_error());
      if (mysqli_connect_errno()) {
        echo "Couldn't connect to DB server. Error: " . mysqli_connect_error();
      }
      return $con;
    }

    function close() {
      $con = $this->connect();
      mysqli_close($con);
    }
  }
