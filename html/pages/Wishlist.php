<?php
session_start();
include_once '../../php/Database.php';
include_once '../../php/Foreign.php';
include_once '../../php/Product.php';
include_once '../../php/Cart.php';



// copied from another file put both of them in same folder
function createCart($productid)
{
  $db = new Database();
  $conn = $db->connect();
  $product = new Product($conn);
  $result = $product->showProductByQuery(array("price"), array("id = " . $productid));
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

// check whether certain user ahs certain product in any table provided
function checkIfInDB($tablename, $userid, $productid)
{
  $db = new Database();
  $conn = $db->connect();
  $table = new ForeignTables($conn);
  $conn->close();
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

function addToCart($cart, $wishid)
{
  $db = new Database();
  $conn = $db->connect();
  $table = new ForeignTables($conn);

  if (!checkIfInDB("cart", $cart->userid, $cart->productid)) {
    $args = array(
      "userid" => $cart->userid,
      "productid" => $cart->productid,
      "quantity" => $cart->quantity,
      "totalprice" => $cart->totalprice
    );
    $table->insertIntoTable("cart", $args);
    removefromwhishlist($wishid);
  }

  $conn->close();
  return TRUE;
}

function removefromwhishlist($wishid)
{

  $db = new Database();
  $conn = $db->connect();
  $table = new ForeignTables($conn);
  $table->deleteFromTable("whishlist", array("id = " . $wishid));
  $conn->close();
  return TRUE;
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

  <div class="navigation">
    <?php
    include('../../html/layouts/navbar.php');
    ?>
  </div>

  <div class="whishlist_wrapper">

    <div class="index_list_wrapper">
      <div class="list_header">
        <h3>My Wishlists</h3>
      </div>

      <div class="list_pic_card_wrapper">
        <?php

        $db = new Database();
        $conn = $db->connect();
        $product = new Product($conn);

        $result = $product->showByConditionInnerJoin(
          "whishlist",
          "productid",
          array("product.id as prodcutid", "product.name as name", "product.pic as pic", "whishlist.id as whishid"),
          array("whishlist.userid = " . $_SESSION['user'])
        );

        if ($result->num_rows > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="card_wrapper">
              <a href="../../html/pages/Purchasepage.php"><img src="data:image/jpg;base64,' . base64_encode($row['pic']) . '" /></a>
              
              <form method = "POST">
              <div class="row10">
                
                <div class="col2">
                  <button name="atc" value="' . $row['whishid'] . '" class="wish_icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart_tips">Add to Cart</span>
                   </button>
                 
                </div>
                
                <div class="col6">
                  <h4> ' . $row['name'] . ' </h4>
                </div>
                
                <div class="col2">
                  <button name="rfw" value="' . $row['whishid'] . '" class="wish_icon">
                    <i style="color:red;"; class="fas fa-heart"></i>
                    <span class="cart_tips">Remove wishlist</span>
                  </button>
                  
                </div>
  
              </div>
              </form>
            </div>
            ';
          }
        } else {
          echo "EMPTY WHISHLST";
        }

        $conn->close();
        ?>
      </div>

    </div>

  </div>

  <?php
  if (array_key_exists('atc', $_POST)) {
    $db = new Database();
    $conn = $db->connect();
    $table = new ForeignTables($conn);
    $result = $table->showByCondition("whishlist", array("productid"), array("id = " . $_POST['atc']));
    $row = mysqli_fetch_assoc($result);
    $cart = createCart($row['productid']);
    addtocart($cart, $_POST['atc']); //sending productid
    echo "<meta http-equiv='refresh' content='0'>";
  }

  if (array_key_exists('rfw', $_POST)) {
    removefromwhishlist($_POST['rfw']); //sending whishid
    echo "<meta http-equiv='refresh' content='0'>";
  }
  ?>




  <script type="text/javascript">
    if (window.performance && window.performance.navigation.type == window.performance.navigation.TYPE_BACK_FORWARD) {
      window.location.replace("http://developerenvironment.com/index.php");
    }
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