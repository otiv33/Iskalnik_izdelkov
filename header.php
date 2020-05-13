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
   <link rel="icon" href="img/favicon.png">
   <!-- Bootstrap/jQuery/Popper-->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

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
                     <span class="menu_icon"></span>
                  </button>

                  <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                     <li class="nav-item">
                           <a class="nav-link" href="index.php">Domov</a>
                        </li>
                     <?php
                        // Dinamično prikazovanje menija glede na to, če je prijavljen
                        if(isset($_SESSION['user_id'])){
                     ?>

                        <?php
                           if (is_admin()) {
                        ?>
                              <li class="nav-item">
                                 <a class="nav-link" href="verify.php">Verifikacija</a>
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
                        <form action="search_results.php" method="POST" class="form-inline my-2 my-lg-0">
                           <input class="form-control mr-sm-2" name="search_input" type="search" placeholder="Search" aria-label="Search">
                           <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Išči</button>
                        </form>
                     </ul>
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
