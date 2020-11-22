<?php
session_start();
include_once '../../php/Database.php';
include_once '../../php/Foreign.php';
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

    <!--css-->
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
</head>




<body>

    <?php
    include('../../html/layouts/navbar.php');
    ?>

    <div class="cart_wrapper">

        <div class="list_header">
            <h3>Shopping Cart</h3>
        </div>

        <hr>
        <div class="list">
            <?php
            include('./subpage/Cartlist.php');
            ?>
        </div>

        <?php

            $total = 0;
            if( $_SESSION['user'] ){
                $db = new Database();
                $conn = $db->connect();
                $cart = new ForeignTables($conn);
                $result = $cart->showByCondition("cart", array("totalprice"), array("userid = ". $_SESSION['user'] ));
                while($row = mysqli_fetch_assoc($result) ){
                    $total += $row['totalprice'];
                }
            }else{
                foreach ($_SESSION['cart'] as $c) {
                    $cart = unserialize($c);
                    $total += $cart->totalprice;
                }                
            }

            if( $total > 0){
                echo
                '
                <div class="cart_total_con">
                <h3>Total: </h3>
                <h3>'. $total .'</h3>
                <br>
                <div class="cart_buy_con">
                    <a href="Oderpage.php">Buy</a>
                </div>
                </div>
                    ';
            }
           


        ?>


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