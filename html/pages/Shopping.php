<?php
session_start();
?>
<!DOCTYPE html>
<html>

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

  <!--css -->
  <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">

</head>

<body>

  <div class="navigation">
    <?php
    include('../../html/layouts/navbar.php');
    ?>
  </div>


  <!-- button to change subpage -->
  <div class="shopping_menu_button">
    <button onclick="switchpage('womens', '#subpage_section')">Womens</button>
    <button onclick="switchpage('girls', '#subpage_section')">Girls</button>
    <button onclick="switchpage('all', '#subpage_section')">View All</button>
    <button onclick="switchpage('boys', '#subpage_section')">Boys</button>
    <button onclick="switchpage('mens', '#subpage_section')">Mens</button>
  </div>

  <!-- display default page when on page load -->
  <script type="text/javascript">
      $.get('./subpage/Main.php', function(response) {
        $('#subpage_section').html(response);
      });
  </script>


  <!-- subpage is displayed here -->
  <div id="subpage_section">
  
  </div>

  <div class="footer_section">
    <?php
    include('../../html/layouts/footer.php');
    ?>
  </div>

  <!--custom javascript-->
  <script src="../../js/pagemanager.js"></script>


</body>

</html>