<?php
session_start();
include_once '../../php/Database.php';
include_once '../../php/Foreign.php';
include('../../php/Addproduct.php');
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

<body class="admin_body">

    <div class="navigation_section">
        <?php
        include('../../html/layouts/navbar.php');
        ?>
    </div>



    <div class="addwrapper">
        <div class="formcontainer">

            <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <div class="inputrow">
                    <div class="leftcolumn">
                        <label>Name:</label>
                    </div>
                    <div class="rightcolumn">
                        <input type="text" name="name" placeholder="e.g. Dhaka Topi" value="<?php echo $args["name"] ?>" required/>
                    </div>
                    <span class="error"><?php echo $args_error["name"]; ?></span>
                </div>

                <div class="inputrow">
                    <div class="leftcolumn">
                        <label>Price:</label>
                    </div>
                    <div class="rightcolumn">
                        <input type="numbers" name="price" placeholder="e.g. $50.55" value="<?php echo $args["price"] ?>" required/>
                    </div>
                    <span class="error"><?php echo $args_error["price"]; ?></span>
                </div>


                <div class="inputrow">
                    <div class="leftcolumn">
                        <label>Quantity:</label>
                    </div>
                    <div class="rightcolumn">
                        <input type="numbers" name="quantity" placeholder="e.g. 50" value="<?php echo $args["quantity"] ?>" required/>
                    </div>
                    <span class="error"><?php echo $args_error["quantity"]; ?></span>
                </div>


                <div class="inputrow">
                    <div class="leftcolumn">
                        <label>Colour:</label>
                    </div>
                    <div class="rightcolumn">
                        <select class="select" name="colorid" id="colorid" required>
                            <option value="" selected>Select Colour</option>
                        <?php
                            $db = new Database();
                            $conn = $db->connect();
                            $group = new ForeignTables($conn);
                            $result = $group->showAll("color", array("id", "color"));
                            while($row = mysqli_fetch_assoc($result)){
                                echo
                                '
                                <option value="'.$row['id'].'">'.$row['color'].'</option>
                                ';
                            }
                            $conn->close();
                        ?>
                        </select>
                    </div>
                    <span class="error"><?php echo $args_error["colorid"]; ?></span><br>
                </div>

                <div class="inputrow">
                    <div class="leftcolumn">
                        <label>Social Group:</label>
                    </div>
                    <div class="rightcolumn">
                        <select class="select" name="groupid" id="groupid" required>
                            <option value="" selected>Select Group</option>
                        <?php
                            $db = new Database();
                            $conn = $db->connect();
                            $group = new ForeignTables($conn);
                            $result = $group->showAll("socialgroup", array("id", "socialgroup"));
                            while($row = mysqli_fetch_assoc($result)){
                                echo
                                '
                                <option value="'.$row['id'].'">'.$row['socialgroup'].'</option>
                                ';
                            }
                            $conn->close();
                        ?>
                        </select>
                    </div>
                    <span class="error"><?php echo $args_error["groupid"]; ?></span><br>
                </div>

                <div class="inputrow">
                    <div class="leftcolumn">
                        <label>Size:</label>
                    </div>
                    <div class="rightcolumn">
                        <select class="select" name="sizeid" id="sizeid" required>
                            <option value="" selected>Select Size</option>
                        <?php
                            $db = new Database();
                            $conn = $db->connect();
                            $group = new ForeignTables($conn);
                            $result = $group->showAll("size", array("id", "size"));
                            while($row = mysqli_fetch_assoc($result)){
                                echo
                                '
                                <option value="'.$row['id'].'">'.$row['size'].'</option>
                                ';
                            }
                            $conn->close();
                        ?>
                        </select>
                    </div>
                    <span class="error"><?php echo $args_error["sizeid"]; ?></span><br>
                </div>

                <div class="inputrow">
                    <div class="leftcolumn">
                        <label>Category:</label>
                    </div>
                    <div class="rightcolumn">
                        <select class="select" name="categoryid" id="categoryid" required>
                            <option value="" selected>Select Category</option>
                        <?php
                            $db = new Database();
                            $conn = $db->connect();
                            $group = new ForeignTables($conn);
                            $result = $group->showAll("category", array("id", "category"));
                            while($row = mysqli_fetch_assoc($result)){
                                echo
                                '
                                <option value="'.$row['id'].'">'.$row['category'].'</option>
                                ';
                            }
                            $conn->close();
                        ?>
                        </select>
                    </div>
                    <span class="error"><?php echo $args_error["categoryid"]; ?></span><br>
                </div>


                <div class="customrow">
                    <div class="customleftcolumn">
                        <label>Description:</label>
                    </div>

                    <div class="customrightcolumn">
                        <textarea name="description" id="description"></textarea>
                    </div>
                    <span class="error"><?php echo $args_error["description"]; ?></span>
                </div>

                <div class="inputrow">
                    <div class="leftcolumn">
                        <label>Select Image:</label>
                    </div>
                    <div class="rightcolumn">
                        <input class="inputnoborder" type="file" name="image" />
                    </div>
                    <span class="error"><?php echo $args_error["pic"]; ?></span>
                </div>

                <div class="inputrow">
                    <button id="submit" type="submit">Add Product</button>
                </div>

            </form>
        </div>

    </div>
    
    <script type="text/javascript">
        document.getElementById('colorid').value = "<?php echo $args['colorid'];?>";
        document.getElementById('groupid').value = "<?php echo $args['groupid'];?>";
        document.getElementById('sizeid').value = "<?php echo $args['sizeid'];?>";
        document.getElementById('categoryid').value = "<?php echo $args['categoryid'];?>";
        document.getElementById('description').value = "<?php echo $args['description'];?>";
    </script>

    <div class="footer_section">
        <?php
        include('../../html/layouts/footer.php');
        ?>
    </div>

    <!--custom javascript-->
    <script src="../../js/pagemanager.js"></script>



</body>

</html>