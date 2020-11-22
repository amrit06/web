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

    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
</head>




<body>

    <div class="navigation">
        <?php
        include('../../html/layouts/navbar.php');
        ?>
    </div>

    <div class="oder_body">

        <div class="order_cart_wrapper">
            <div class="form_header">
                <h3>Cart:</h3>
            </div>
            <div class="list">
                <?php
                include('./subpage/Cartlist.php');
                ?>
            </div>
        </div>

        <div class="order_wrapper">
            <div class="col5">
                <div class="form_header">
                    <h3>Billing Form:</h3>
                </div>

                <?php
                include('./subpage/Addressform.php');
                ?>

                <div class="order_checkbox_con">
                    <input id="delivery_check" type="checkbox" name="delivery_check">
                    <label for="delivery_check">Same as Billing address</label><br>
                </div>

                <!--hide display delviery form on chekbox clicked-->
                <script>
                    $(document).ready(function() {
                        $('#delivery_check').change(function() {
                            if (!this.checked)
                                //  ^
                                $('#order_delivery_add').fadeIn('slow');
                            else
                                $('#order_delivery_add').fadeOut('slow');
                        });
                    });
                </script>

                <div id="order_delivery_add" class="order_delivery_add">
                    <div class="form_header">
                        <h3>Delivery Address:</h3>
                    </div>

                    <?php
                    include('./subpage/Addressform.php');
                    ?>
                </div>
            </div>



            <div class="col5">
                <?php
                include('./subpage/Billingform.php');
                ?>
            </div>

        </div>
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