<?php
session_start();
include('../../php/Loguser.php');
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

    <div class="navigation">
        <?php
        include('../../html/layouts/navbar.php');
        ?>
    </div>

    <div class="login_wrapper">

        <div class="login_img_con">
            <img src="../../assets/avatar.png" alt="Avatar">
        </div>

        <div class="login_form">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <div class="row10">
                    <div class="form_input_con">
                        <div class="input_field_wrapper">
                            <i class="fas fa-inbox"></i>
                            <input type="text" name="email" placeholder="e.g. example@gmail.com" value="<?php echo $args["email"] ?>" required/>
                        </div>
                        <span class="error"><?php echo $args_error["email"]; ?></span>
                    </div>
                </div>


                <div class="row10">
                    <div class="form_input_con">
                        <div class="input_field_wrapper">
                            <i class="fas fa-key"></i>
                            <input type="password" name="password" placeholder="e.g. Password" value="<?php echo $args["password"] ?>" required/>
                        </div>
                        <span class="error"><?php echo $args_error["password"]; ?></span>
                    </div>
                </div>


                <div class="form_submit">
                    <button id="submit" type="submit">Login</button>
                </div>

            </form>
        </div>

        <br>
        <a href="#">Forgot Email</a>
        <br>
        <a href="#">Forgot Password</a>
        <br>
        <div class="link_con">
            <a class="login_link" href="../pages/Signup.php">Don't have account? click me</a>
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