<?php
session_start();
include_once './php/Database.php';
include_once './php/Product.php';
include_once './php/Foreign.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!--Meta Data Required-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DHAKA</title>

  <!--Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <!--owl css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />

  <!--icons-->
  <script src="https://kit.fontawesome.com/a3a8f8f585.js" crossorigin="anonymous"></script>

  <!--jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!--custom css file-->
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

</head>

<body class="index_body">

  <div id="navigation">
    <?php
    include('../dhaka/html/layouts/navbar.php');
    ?>
  </div>


  <div class="index_frame_wrapper">
    <div class="frame_big_pic_con">
      <img id="frame_big_pic" class="frame_big_pic" src="./assets/pic1.jpg" />
    </div>

    <div class="frame_small_pic_con">
      <img id="frame_small_pic" class="frame_small_pic" src="./assets/pic1.jpg" />
    </div>

    <div class="frame_right_button_con">
      <a onclick="slideright()"><i class="fas fa-chevron-right"></i></a>
    </div>

    <div class="frame_left_button_con">
      <a onclick="slideleft()"><i class="fas fa-chevron-left"></i></a>
    </div>
  </div>

  <div class="index_list_content">
    <div class="index_list_wrapper">
      <div class="list_header">
        <h3>Shop By Categories</h3>
      </div>

      <div class="list_pic_card_wrapper">
        <?php
        $db = new Database();
        $conn = $db->connect();
        $product = new Product($conn);
        // work here
        $result = $product->distinctCategoryFromProduct();
        while($row = mysqli_fetch_assoc($result)){
          echo '
                  <div class="card_wrapper">
                    <a href="./html/pages/Shopping.php?id='.$row['categoryid'].'">
                    <img src="data:image/jpg;base64,' . base64_encode($row['pic']) . '" />
                    </a>
                    <h4> ' . $row['category'] . ' </h4>
                    <hr>
                  </div>
              ';
        }
        $conn->close();
        ?>

      </div>
    </div>

    <div class="index_list_wrapper">
      <div class="list_header">
        <h3>Shop By Products</h3>
      </div>

      <div class="list_pic_card_wrapper">
        <?php
        $db = new Database();
        $connection = $db->connect();
        $product = new Product($connection);
        $result = $product->showAllProduct(array("id", "name", "pic"));
        while($row = mysqli_fetch_assoc($result)){
          echo '
                  <div class="card_wrapper">
                    <a href="./html/pages/Productpage.php?id='.$row['id'].'">
                    <img src="data:image/jpg;base64,' . base64_encode($row['pic']) . '" />
                    </a>
                    <h4> ' . $row['name'] . ' </h4>
                    <hr>
                  </div>
              ';
        }
        $connection->close();
        ?>
      </div>

    </div>

    <div class="index_list_wrapper">
      <div class="list_header">
        <h3>Find More Info!</h3>
      </div>

      <div class="list_info_wrapper">
        <div class="row10">

          <div class="col3">
            <h4>About US</h4>
            <p>
              The prevailing fashion/ trends/style is called ‘vogue’. Fashion can also simply mean our lifestyle: the
              clothing
              and accessories that we wear and the cosmetics that we apply. Besides clothing, ornaments, accessories,
              and make
              up, it also includes our mannerism and behavior.
            </p>
          </div>

          <div class="col3">
            <h4>About US</h4>
            <p>
              The prevailing fashion/ trends/style is called ‘vogue’. Fashion can also simply mean our lifestyle: the
              clothing
              and accessories that we wear and the cosmetics that we apply. Besides clothing, ornaments, accessories,
              and make
              up, it also includes our mannerism and behavior.
            </p>
          </div>

          <div class="col3">
            <h4>Find More</h4>
            <p>
              The prevailing fashion/ trends/style is called ‘vogue’. Fashion can also simply mean our lifestyle: the
              clothing
              and accessories that we wear and the cosmetics that we apply. Besides clothing, ornaments, accessories,
              and make
              up, it also includes our mannerism and behavior.
            </p>
          </div>

        </div>
      </div>

    </div>
  </div>


  <div class="footer_section">
    <?php
    include('../dhaka/html/layouts/footer.php');
    ?>
  </div>


  <!--Bootstrap JS-->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  <!--custom javascript-->
  <script src="./js/pagemanager.js"></script>

</body>


</html>