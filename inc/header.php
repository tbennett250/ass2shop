<!doctype html>

<?php
session_start();
include_once __DIR__ . '/functions.php';

 if(isset($_SESSION['user'])){
  //$Log = $_SESSION['user'] . " , <a class='nav-link' href='/inc/logout.php'> Log out </a>";
  $Log = '<a class="nav-link" href="./logout.php"><i class="bi bi-door-closed" style="font-size: 2rem"></i></a> ';
 } else {
  $Log = '<a class="nav-link" href="./login.php"><i class="bi bi-person-circle" style="font-size: 2rem"></i></a>';
 }


?>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title><?= $title ?? 'Welcome' ?></title>
  </head>
  <body class="bg-primary">
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php">Online Shop</a>
      
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <!-- <a class="nav-link" href="./login.php"><i class="bi bi-person-circle" style="font-size: 2rem"></i></a> -->
                <?= $Log ?>
            </li>
          </ul>
    </div>
  </div>
</nav>

<?php

if(isset($_SESSION['user'])){
  if($_SESSION['user']['userRole'] = 1){
    require_once "./components/admin-nav.php";
}
}

?>