
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NRS</title>
  <link rel="stylesheet" href="style/home.css">
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
</head>

<body>
  <section id="home">
    <div class="main">
      <div class="navbar">
        <div class="icon">
          <h2 class="logo">NRS</h2>
        </div>

        <div class="menu">
          <ul>
            <li><a href="#home">HOME</a></li>
            <li><a href="#about">ABOUT</a></li>
            <li><a href="#news">NEWS</a></li>
            <li><a href="#contact">CONTACT</a></li>
            <li><a href="user/loginsignup.php">LOGIN</a></li>

          </ul>
        </div>

        <!-- <div class="search">
          <input class="srch" type="search" name="" placeholder="Type To Text">
          <a href="#"><button class="btn">Search</button></a>

        </div> -->
      </div>

      <div class="content">
        <img src="image/sm.jpg">
        <div class="hwrap">
          <div class="hmove">
            <div class="hslide">
              <h3>Looking for an awesome news <span></span></h3>
              <p>Come visit our website <span></span></p>
              <br>
              <a href="#about" type="button" class="cta">Read More</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <br><br><br><br>
  <section id="about">
    <h3 class="h3">ABOUT US</h3><br><br><br>
    <!-- <img src="image/po.jpg" class="img"> -->
    <div class="tea">
      <div class="tea_m">
        <h3>100% Real News </h3>
        <p>We gurantee that every news placed on our website is fresh. </p>
      </div>
      <div class="tea_m">
        <h3>NEW News EVERYDAY</h3>
        <p>We daily update our catalog of news with new article from different resources and industries.</p>
      </div>
      <div class="tea_m">
        <h3>24/7 ONLINE SUPPORT</h3>
        <p>Our support team is always ready to help you solve any question connected with performance of our website. We can resolve any issue efficiently 24/7.</p>
      </div>
    </div>


  </section>

  <br><br><br><br>



  <section id="product">
    <div class="imgs">

      <?php
      $i = 0;
      $sql = mysqli_query($conn, "select * from productdb");
      echo "<table><tr>";
      while ($r_res = mysqli_fetch_assoc($sql)) {
          
          if($i<4)
{          
      ?>


              <td>
                <div class="gallerys">
                  <img src="./image/upload/<?php echo $r_res['image']; ?>" alt="Image" id="img1" width="400" height="300" style="width: 300px; height: 300px;">
                  <div class="desc"><b> <?php echo $r_res['name']; ?></b></div>
                  <div class="desc"><?php echo substr($r_res['startingbid'], 0, 100); ?></div><br>
                  <button style="background-color: grey; width: 100px;height: 40px;"><a href="detail.php">Quick View</a></button>
                </div>
              </td>



          <?php 
              $i++;
              
                
            }
            else{
              echo "</tr>";
              break;
            }
            } ?>

          
        </table>
        
    </div><br><br>
    <center><button><a href="fetchproduct.php">View More</a></button></center>
  </section>

  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

  <section id="contact">
    <h3 class="h3">CONTACT US</h3><br>
    <h4 class="text">Need a Hand? or a high five?<br>Here's how to reach us.</h4>

    <div class="contact container">
      <div class="contact-items">
        <div class="contact-item">
          <div class="icon"><img src="images/images.png" /></div>
          <div class="contact-info">
            <h1>Phone</h1>
            <h2>01-4285780</h2>
            <h2>01-5100361</h2>
          </div>
        </div>
        <div class="contact-item">
          <div class="icon"><img src="images/imagess.jpg" /></div>
          <div class="contact-info">
            <h1>Email</h1>
            <h2>info.nrs@gmail.com</h2>
          </div>
        </div>
        <div class="contact-item">
          <div class="icon"><img src="images/downloads.png" /></div>
          <div class="contact-info">
            <h1>Address</h1>
            <h2>Tinthana, Kathmandu, Nepal</h2>
          </div>
        </div>
      </div>
    </div>

  </section>
  <br><br><br><br>
  <footer class="foot">
    <div class="copyright" style=" position: relative; left: 0; bottom: 0; width: 100%; text-align: center; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
      <div class="container">

        <p>Copyright &copy; <script>
            document.write(new Date().getFullYear())
          </script> NRS All Rights Reserved</p>
      </div>
    </div>
  </footer>
</body>

</html>