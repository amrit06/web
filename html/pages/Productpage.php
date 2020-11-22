<?php
session_start();
include_once '../../php/Database.php';
include_once '../../php/Product.php';
include_once '../../php/Cart.php';
include_once '../../php/Foreign.php';


function createCart($productid)
{
    $db = new Database();
    $conn = $db->connect();
    $product = new Product($conn);
    $result = $product->showProductByQuery(array("price"), array("id = " . $productid) );
    $row = mysqli_fetch_assoc($result);
    $conn->close();

    // create a cart
    $cart = new Cart();
    $cart->productid = $productid;
    $cart->quantity = 1;
    $cart->totalprice = $row['price'];
    if (isset($_SESSION['user'])) {
        $cart->userid = $_SESSION['user'];
    } else {
        $cart->userid = NULL;
    }
    return $cart;
}


function addRemoveFromCartDatabase($cart)
{
    $db = new Database();
    $conn = $db->connect();
    $table = new ForeignTables($conn);


    if (checkIfInDB("cart", $cart->userid, $cart->productid)) {
        $table->deleteFromTable("cart", array("userid = " . $cart->userid, "productid = " . $cart->productid));
    } else {



        $args = array(
            "userid" => $cart->userid,
            "productid" => $cart->productid,
            "quantity" => $cart->quantity,
            "totalprice" => $cart->totalprice
        );
        $table->insertIntoTable("cart", $args);
    }

    $conn->close();
    return TRUE;
}


function addRemoveFromWishListDatabase($item)
{
    $db = new Database();
    $conn = $db->connect();
    $table = new ForeignTables($conn);

    if (checkIfInDB("whishlist", $item->userid, $item->productid)) {
        $table->deleteFromTable("whishlist", array("userid = " . $item->userid, "productid = " . $item->productid));
    } else {
        $args = array(
            "userid" => $item->userid,
            "productid" => $item->productid
        );

        $table->insertIntoTable("whishlist", $args);
    }

    $conn->close();
    return TRUE;
}



function addRemoveFromCartSession($cart)
{
    if (isset($_SESSION['cart'])) {
        $counter = 0;
        foreach ($_SESSION['cart'] as $c) {
            $old = unserialize($c);
            if ($cart == $old) {
                array_splice($_SESSION['cart'], $counter, 1);
                if (sizeof($_SESSION['cart']) <= 0) {
                    unset($_SESSION['cart']);
                }
                return;
            }
            $counter++;
        }
        array_push($_SESSION['cart'], serialize($cart));
    } else {
        // session array work on it
        $_SESSION['cart'] = [];
        $_SESSION['cart'][] =  serialize($cart);
    }
}


// check whether certain user ahs certain product in any table provided
function checkIfInDB($tablename, $userid, $productid)
{
    $db = new Database();
    $conn = $db->connect();
    $table = new ForeignTables($conn);

    $result = $table->showAll($tablename, array("userid", "productid"));
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($userid == $row['userid'] && $productid == $row['productid']) {
                return TRUE;
            }
        }
        return FALSE;
    } else {
        return FALSE;
    }
}



function checkIfInCartSession($userid, $productid)
{

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $c) {
            $cart = unserialize($c);
            if ($cart->userid == $userid && $cart->productid == $productid) {
                return TRUE;
            }
        }
        return FALSE;
    } else {
        return FALSE;
    }
}



function applyCartStyle()
{

    if (isset($_SESSION['user'])) {
        if (checkIfInDB("cart", $_SESSION['user'], $_GET['id'])) {
            return "style='color:red;'";
        } else {
            return;
        }
    } else {
        if (checkIfInCartSession($_SESSION['user'], $_GET['id'])) {
            return "style='color:red;'";
        } else {
            return;
        }
    }
}



function applyWishStyle()
{
    if (isset($_SESSION['user'])) {
        if (checkIfInDB("whishlist", $_SESSION['user'], $_GET['id'])) {
            return "style='color:red;'";
        } else {
            return;
        }
    }
    // no wishlist session for guest visitor 
    return;
}

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

    <div id="navigation">
        <?php
        include('../../html/layouts/navbar.php');
        ?>
    </div>


    <div class="product_detail_wrapper">
        <div class="leftcolumn">
            <div class="product_pic_con">
                <?php
                $id = $_GET['id'];
                $db = new Database();
                $connection = $db->connect();
                $product = new Product($connection);
                $result = $product->showProductByQuery(array("name", "description", "price", "pic"), array("id = $id"));
                $row = mysqli_fetch_assoc($result);
                $connection->close();
                echo
                    '
                <img src="data:image/jpg;base64,' . base64_encode($row['pic']) . '" />
                ';
                ?>

            </div>
            <div class="product_img_scroller">
                <div class="scroller_img_con">
                    <img src="/assets/pic1.jpg">
                </div>
                <div class="scroller_img_con">
                    <img src="/assets/pic1.jpg">
                </div>
                <div class="scroller_img_con">
                    <img src="/assets/pic1.jpg">
                </div>
                <div class="scroller_img_con">
                    <img src="/assets/pic1.jpg">
                </div>
            </div>
        </div>
        <div class="rightcolumn">

            <div class="product_option_con">
                <?php
                include('../../html/layouts/Productcategory.php');
                ?>
            </div>

            <div class="product_price_con">
                <label>$<?php echo $row['price']; ?></label>
            </div>

            <div class="product_btn_row">
                <div class="buybtn">
                    <a href="../../html/pages/Oderpage.php">Buy</a>
                </div>
                <form method="POST">
                    <div class="atcbtn">
                        <button type="submit" name="atw" value="<?php echo $id; ?>"><i <?php echo applyWishStyle(); ?>class="fas fa-heart"></i></button>
                    </div>
                    <div class="atwbtn">
                        <button type="submit" name="atc" value="<?php echo $id; ?>"><i <?php echo applyCartStyle(); ?>class="fas fa-shopping-cart"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php
    // adding removing from cart 
    if (array_key_exists('atc', $_POST)) {
        $cart = createCart($_POST['atc']);

        if (isset($_SESSION['user'])) {
            //use database
            addRemoveFromCartDatabase($cart);
        } else {
            // use session
            addRemoveFromCartSession($cart);
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }

    // adding removing from whishlist 
    if (array_key_exists('atw', $_POST)) {

        if (isset($_SESSION['user'])) {
            $wish = new Whishlist();
            $wish->userid = $_SESSION['user'];
            $wish->productid = $_POST['atw'];

            addRemoveFromWishListDatabase($wish);
        } else {
            echo '
            <script type="text/javascript">
            window.location.replace("Login.php");
            </script>
            ';
            exit;
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }

    ?>

    <div class="product_infosection">
        <div class="description">
            <h3><?php echo $row['name']; ?></h3>
            <label><?php echo $row['description']; ?></label>
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