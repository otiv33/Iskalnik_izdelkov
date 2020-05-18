<?php
   include_once "session.php";
   include_once "alert.php";
?>

<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Iskalnik izdelkov</title>
   <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
   <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
   <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
   <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
   <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
   <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
   <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
   <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
   <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
   <link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
   <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
   <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
   <link rel="manifest" href="favicon/manifest.json">
   <meta name="msapplication-TileColor" content="#ffffff">
   <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
   <meta name="theme-color" content="#ffffff">
   <!-- Bootstrap/jQuery/Popper-->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
   <!--CSS-->

<body>
   <!--::header part start::-->
   <header class="main_menu single_page_menu">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-12">
               <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                  <a class="navbar-brand" href="index.php">Iskalnik izdelkov</a>

                  <button class="navbar-toggler" type="button" data-toggle="collapse"
                     data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                     aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                     <ul class="navbar-nav mr-auto">
                     <li class="nav-item">
                           <a class="nav-link" href="index.php">Domov</a>
                        </li>
                     <?php
                        if(isset($_SESSION['user_id'])){
                     ?>
                        <?php
                           if (is_admin()) {
                        ?>
                              <li class="nav-item">
                                 <a class="nav-link" href="verify.php">Verifikacija</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="admin_products_all.php">Vsi produkti</a>
                              </li>
                        <?php
                           }
                        ?>
                        <?php
                           if (is_store_owner()) {
                        ?>
                              <li class="nav-item">
                                 <a class="nav-link" href="product_add_edit.php">Uredi ali dodaj izdelek</a>
                              </li>
                        <?php
                           }
                        ?>
                        <li class="nav-item">
                           <a class="nav-link" href="favourites.php">Priljubljeni</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="logout.php">Odjava</a>
                        </li>
                     <?php
                        }
                        else{
                     ?>
                        <li class="nav-item">
                           <a class="nav-link" href="login.php">Prijava</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="register.php">Registracija</a>
                        </li>      
                     <?php
                        }
                     ?>
                     </ul>
                        <form action="search_results.php" method="POST" class="form-inline my-2 my-lg-0">
                           <input class="form-control mr-sm-2" name="search_input" type="search" placeholder="Search" aria-label="Search">
                           <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Išči</button>
                        </form>
                  </div>
               </nav>
            </div>
         </div>
      </div>
   </header>
   <!-- Header part end-->
   <br/>
   
   <!-- Start of content -->
   <section class="blog_area single-post-area section_padding">
      <div class="container">
