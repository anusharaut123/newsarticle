<?php
if(isset($_COOKIE['userauth']) && $_COOKIE['userauth']=="true"){
    require "algorithm.php"; 
}else {
    header('location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>NRS</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    
    <!-- Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="../style/version/bootstrap.css" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="../style/version/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../style/version/styyllee.css" rel="stylesheet">

    <!-- Responsive styles for this template -->
    <link href="../style/version/responsive.css" rel="stylesheet">

    <!-- Colors for this template -->
    <link href="../style/version/colors.css" rel="stylesheet">

    <!-- Version Tech CSS for this template -->
    <link href="../style/version/tech.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <div id="wrapper">
    <header class="tech-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="tech-index.html"><img src="images/version/tech-logo.png" alt=""></a>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="tech-index.html">Home</a>
                    </li>
                    <?php
                    $i=1;
                $query = "SELECT * FROM category WHERE state != 'block'";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_array($result)) {
                        if($i<=5){
                         echo '<li class="nav-item"><a class="nav-link" href="news.php?category=' . $row['categoryid'] . '">' . $row['categoryname'] . '</a></li>';
                         if($i==5) { 
                            echo '<li class="nav-item"><select name="category" id="category" class="form-control">';
                        }
                        else{
                            continue;
                        }
                        }
                        else{
                            echo '<a  href="news.php?category=' .$row['categoryid'] . '"> <option >Fashion</option> </a>';
                        }

                    }
                    echo '</select></li>';
                }
    ?>
    </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="myprofile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userlogout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div><!-- end container-fluid -->
</header>

        <section class="section first-section">
            <div class="container-fluid">
                <div class="masonry-blog clearfix">
                    <div class="first-slot">
                        <?php
                            $placeholders = implode(',', array_fill(0, count($recommendationResult), '?'));

                            $query = "SELECT *, (SELECT imagename FROM news_image WHERE imageid = (SELECT MIN(imageid) FROM news_image WHERE news.newsid = news_image.newsid)) as imagename, (SELECT categoryname from category where news.category = category.categoryid ) as categoryname FROM news WHERE newsid IN ($placeholders)";
                            $stmt = $conn->prepare($query);

                            if ($stmt === false) {
                                die("Error preparing the statement: " . $conn->error);
                            }

                            // Bind parameters
                            $types = str_repeat('i', count($recommendationResult));  // 'i' denotes integer type
                            $stmt->bind_param($types, ...$recommendationResult);

                            $stmt->execute();
                            $result = $stmt->get_result();
                            $rowResult = $result->fetch_assoc();
                           

                        ?>
                        <div class="masonry-box post-media">
                             <img style="height:100%" src="../admin/newsimage/<?php echo $rowResult['imagename'] ?>" alt="" class="img-fluid">
                             <div class="shadoweffect">
                                <div class="shadow-desc">
                                    <div class="blog-meta">
                                        <span class="bg-orange"><a href="fullnews.php?newsid=<?php echo $rowResult['newsid'] ?>" title=""><?php echo $rowResult['categoryname'] ?></a></span>
                                        <h4><a href="fullnews.php?newsid=<?php echo $rowResult['newsid'] ?>" title=""><?php echo $rowResult['title'] ?></a></h4>
                                        <small><a href="fullnews.php?newsid=<?php echo $rowResult['newsid'] ?>" title=""><?php echo $rowResult['date'] ?></a></small>
                                        <small><a href="fullnews.php?newsid=<?php echo $rowResult['newsid'] ?>" title="">by <?php echo $rowResult['authorname'] ?></a></small>
                                    </div><!-- end meta -->
                                </div><!-- end shadow-desc -->
                            </div><!-- end shadow -->
                        </div><!-- end post-media -->
                    </div><!-- end first-side -->
                    <div class="second-slot">
                    <?php
                        $rowResult = $result->fetch_assoc();
                    ?>
                    <div class="masonry-box post-media">
                             <img style="height:100%" src="../admin/newsimage/<?php echo $rowResult['imagename'] ?>" alt="" class="img-fluid">
                             <div class="shadoweffect">
                                <div class="shadow-desc">
                                    <div class="blog-meta">
                                        <span class="bg-orange"><a href="fullnews.php?newsid=<?php echo $rowResult['newsid'] ?>" title=""><?php echo $rowResult['categoryname'] ?></a></span>
                                        <h4><a href="fullnews.php?newsid=<?php echo $rowResult['newsid'] ?>" title=""><?php echo $rowResult['title'] ?></a></h4>
                                        <small><a href="fullnews.php?newsid=<?php echo $rowResult['newsid'] ?>" title=""><?php echo $rowResult['date'] ?></a></small>
                                        <small><a href="fullnews.php?newsid=<?php echo $rowResult['newsid'] ?>" title="">by <?php echo $rowResult['authorname'] ?></a></small>
                                    </div><!-- end meta -->
                                </div><!-- end shadow-desc -->
                            </div><!-- end shadow -->
                        </div><!-- end post-media -->
                    </div><!-- end first-side -->

                    <div class="last-slot">
                        <?php
                            $rowResult = $result->fetch_assoc();
                        ?>
                        <div class="masonry-box post-media">
                             <img style="height:100%" src="../admin/newsimage/<?php echo $rowResult['imagename'] ?>" alt="" class="img-fluid">
                             <div class="shadoweffect">
                                <div class="shadow-desc">
                                    <div class="blog-meta">
                                        <span class="bg-orange"><a href="fullnews.php?newsid=<?php echo $rowResult['newsid'] ?>" title=""><?php echo $rowResult['categoryname'] ?></a></span>
                                        <h4><a href="fullnews.php?newsid=<?php echo $rowResult['newsid'] ?>" title=""><?php echo $rowResult['title'] ?></a></h4>
                                        <small><a href="fullnews.php?newsid=<?php echo $rowResult['newsid'] ?>" title=""><?php echo $rowResult['date'] ?></a></small>
                                        <small><a href="fullnews.php?newsid=<?php echo $rowResult['newsid'] ?>" title="">by <?php echo $rowResult['authorname'] ?></a></small>
                                    </div><!-- end meta -->
                                </div><!-- end shadow-desc -->
                            </div><!-- end shadow -->
                        </div><!-- end post-media -->
                    </div><!-- end first-side -->
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-top clearfix">
                                <h4 class="pull-left">Recent News <a href="#"><i class="fa fa-rss"></i></a></h4>
                            </div><!-- end blog-top -->

                            <div class="blog-list clearfix">
                            <?php
                            $recentQuery = "SELECT *, (SELECT imagename FROM news_image WHERE imageid = (SELECT MIN(imageid) FROM news_image WHERE news.newsid = news_image.newsid)) as imagename, (SELECT categoryname from category where news.category = category.categoryid ) as categoryname FROM news WHERE date >= NOW() - INTERVAL 30 DAY ORDER BY date DESC";
                            $recentResult = mysqli_query($conn, $recentQuery);
                            if($recentQuery){
                                while($recentRow = mysqli_fetch_array($recentResult)){
                            ?>

                                <div style="height:50%;" class="blog-box row">
                                    <div class="col-md-4">
                                        <div style="height: 100%;" class="post-media">
                                            <a href="fullnews.php?newsid=<?php echo $recentRow['newsid'] ?>" title="">
                                                <img style="height: 100%;" src="../admin/newsimage/<?php echo $recentRow['imagename'] ?>" alt="" class="img-fluid">
                                                <div class="hovereffect"></div>
                                            </a>
                                        </div><!-- end media -->
                                    </div><!-- end col -->

                                    <div class="blog-meta big-meta col-md-8">
                                        <h4><a href="fullnews.php?newsid=<?php echo $recentRow['newsid'] ?>" title=""><?php echo $recentRow['title'] ?></p>
                                        <small class="firstsmall"><a class="bg-orange" href="fullnews.php?newsid=<?php echo $recentRow['newsid'] ?>" title=""><?php echo $recentRow['categoryname'] ?></a></small>
                                        <small><a href="fullnews.php?newsid=<?php echo $recentRow['newsid'] ?>" title=""><?php echo $recentRow['date'] ?></a></small>
                                        <small><a href="fullnews.php?newsid=<?php echo $recentRow['newsid'] ?>" title="">by <?php echo $recentRow['authorname'] ?></a></small>
                                        <small><a href="fullnews.php?newsid=<?php echo $recentRow['newsid'] ?>" title=""><i class="fa fa-eye"></i><?php echo $recentRow['views'] ?></a></small>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->

                            <hr class="invis">
                            
                            <?php
                                }
                            }
                            ?>
                            
                            </div><!-- end blog-list -->
                        </div><!-- end page-wrapper -->

                        <hr class="invis">
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar">
                            <div class="widget">
                                <div class="banner-spot clearfix">
                                    <div class="banner-img">
                                        <img src="upload/banner_07.jpg" alt="" class="img-fluid">
                                    </div><!-- end banner-img -->
                                </div><!-- end banner -->
                            </div><!-- end widget -->

                            <div class="widget">
                                <h2 class="widget-title">Trend News</h2>
                                <div class="trend-videos">
                                    <?php
                                    $trendQuery = "SELECT *, (SELECT imagename FROM news_image WHERE imageid = (SELECT MIN(imageid) FROM news_image WHERE news.newsid = news_image.newsid)) as imagename FROM news ORDER BY date DESC, views DESC LIMIT 3";
                                    $trendResult = mysqli_query($conn, $trendQuery);
                                    if($trendQuery){
                                        while($trendRow = mysqli_fetch_array($trendResult)){
                                    ?>
                                    <div class="blog-box">
                                        <div style="height: 300px" class="post-media">
                                            <a href="fullnews.php?newsid=<?php echo $recentRow['newsid'] ?>" title="">
                                                <img style="height: 100%;" src="../admin/newsimage/<?php echo $trendRow['imagename'] ?>" alt="" class="img-fluid">
                                                <div style="height:300px;" class="hovereffect">
                                                    <span class="videohover"></span>
                                                </div><!-- end hover -->
                                            </a>
                                        </div><!-- end media -->
                                        <div class="blog-meta">
                                            <h4><a href="fullnews.php?newsid=<?php echo $trendRow['newsid'] ?>" title=""><?php echo $trendRow['title'] ?></a></h4>
                                        </div><!-- end meta -->
                                    </div><!-- end blog-box -->

                                    <hr class="invis">
                                    <?php
                                        }
                                    }
                                    ?>

                                    
                                </div><!-- end videos -->
                            </div><!-- end widget -->

                            <div class="widget">
                                <div class="banner-spot clearfix">
                                    <div class="banner-img">
                                        <img src="upload/banner_03.jpg" alt="" class="img-fluid">
                                    </div><!-- end banner-img -->
                                </div><!-- end banner -->
                            </div><!-- end widget -->
                        </div><!-- end sidebar -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
        
        <footer class="foot">
            <div class="copyright" style=" position: relative; left: 0; bottom: 0; width: 100%; text-align: center; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
            <div class="container">
                <p>Copyright &copy; <script>
                document.write(new Date().getFullYear())
                </script> NRS All Rights Reserved</p>
                </div>
            </div>
        </footer>
    </div><!-- end wrapper -->
    <!-- Core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
