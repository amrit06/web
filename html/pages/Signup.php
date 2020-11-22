<?php
session_start();
include('../../php/Registeruser.php');
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

    <!-- stylesheet -->
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">

</head>

<body>

    <div class="navigation">

        <?php
        include('../../html/layouts/navbar.php');
        ?>
    </div>

    <div class="signup_heading">
        <h2>Please Fill in The Form</h2>
    </div>

    <div class="signup_form_wrapper">

        <div class="signup_form_image">
            <img src="../../assets/bhoto.jpeg">
            <h3>De-Sire</h3>
        </div>

        <div class="signup_form">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <div class="row10">
                    <div class="col5">
                        <div class="form_input_con">
                            <div class="input_field_wrapper">
                                <i class="fas fa-user"></i>
                                <input type="text" name="firstname" placeholder="e.g. James" value="<?php echo $args["firstname"] ?>" required/>
                            </div>
                            <span class="error"><?php echo $args_error["firstname"]; ?></span>
                        </div>
                    </div>

                    <div class="col5">
                        <div class="form_input_con">
                            <div class="input_field_wrapper">
                                <i class="fas fa-user"></i>
                                <input type="text" name="lastname" placeholder="e.g. Smith" value="<?php echo $args["lastname"] ?>" required/>
                            </div>
                            <span class="error"><?php echo $args_error["lastname"]; ?></span>
                        </div>
                    </div>

                </div>

                <div class="row10">
                    <div class="form_input_con">
                        <div class="input_field_wrapper">
                            <i class="fas fa-inbox"></i>
                            <input type="text" name="email" placeholder="e.g. examle@gmail.com" value="<?php echo $args["email"] ?>" required/>
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


                <div class="row10">
                    <div class="form_input_con">
                        <div class="input_field_wrapper">
                            <i class="fas fa-key"></i>
                            <input type="password" name="retry_password" placeholder="e.g. Retry Password" value="<?php echo $args["retry_password"] ?>" required/>
                        </div>
                        <span class="error"><?php echo $args_error["retry_password"]; ?></span>
                    </div>
                </div>

                <div class="row10">
                    <div class="radio_section">
                        <label>Select Gender: </label><span class="error"><?php echo $args_error["gender"]; ?></span><br>
                        <input type="radio" name="gender" value="Male" required/>
                        <label for="Male">Male</label><br>
                        <input type="radio" name="gender" value="Female" required/>
                        <label for="Male">Female</label><br>
                        <input type="radio" name="gender" value="Other" required/>
                        <label for="Other">Other</label><br>
                    </div>
                </div>


                <!--Address-->
                <?php
                    include('./subpage/Addressform.php');
                ?>
                
                <div class="form_submit">
                    <button id="submit" type="submit">Sign UP</button>
                </div>
            </form>
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