<?php
require "../db/connection.php";
if(!isset($_COOKIE['auth']) && $_COOKIE['auth']!="admintrue"){
  header('location: admin_login.php');
}

?>

<html>
  <head>
    <link rel="stylesheet" href="../style/sidebar.css">
  </head>
  <body><div class="area"></div><nav class="main-menu">
            <ul>
                <h2 class="headingsidebar">News Article</h2>
                <li>
                    <a href="adminhome.php">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                           Dashboard
                        </span>
                    </a>
                  
                </li>
                <li class="has-subnav">
                    <a href="addnews.php">
                        <i class="fa fa-globe fa-2x"></i>
                        <span class="nav-text">
                            Add News
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="muser.php">
                       <i class="fa fa-users fa-2x"></i>
                        <span class="nav-text">
                            Users
                        </span>
                    </a>
                    
                </li>
                <li>
                    <a href="category.php">
                        <i class="fa fa-book fa-2x"></i>
                        <span class="nav-text">
                            Category
                        </span>
                    </a>
                </li>
            </ul>

            <ul class="logout">
                <li>
                   <a href="logoutadmin.php">
                         <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                            Logout
                        </span>
                    </a>
                </li>  
            </ul>
        </nav>
  </body>
    </html>