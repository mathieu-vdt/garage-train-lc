<?php

function connectDB(){
  $host = 'localhost:8889';
  $user = 'root';
  $password = 'root';
  $database = 'garage_train';
  $conn = new mysqli($host, $user, $password, $database);

  if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
  }
  else{
    return $conn;
  }
}

