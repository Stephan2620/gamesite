<?php
session_start(); 
  ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Game site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css" >
    </head>


    <?php

session_start(); 


if(isset($_SESSION['adgang'])){
  ?>
    


<nav class="navbar  navbar-dark navbar-expand-lg bg-dark" >
        <a class="navbar-brand" href="nyhed.php">Game site</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
              <?php if(isset($_SESSION['adgangadmin'])){   ?>
                            <li class="nav-item">
                            <a class="nav-link" href="addpost.php">
                              Addpost
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="registreradmin.php">
                              Registrer_Admin
                            </a>
                          </li>
                          <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="nyhed.php">
                Nyheder
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="games.php">
                Spil
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="kontakt.php">
              Kontakt
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logud.php">
                logud
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <?php
    }
    
    
    else{
      ?>
          
</head>

<nav class="navbar  navbar-dark navbar-expand-lg bg-dark" >
        <a class="navbar-brand" href="index.php">Game site</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
          <li class="nav-item">
              <a class="nav-link" href="index.php">
                Login
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="registrer.php">
                Registrer
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <?php
    }
