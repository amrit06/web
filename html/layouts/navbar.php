<?php
session_start();

$home = "../../index.php";
$signup = "../../html/pages/Signup.php";
$login = "../../html/pages/Login.php";
$shop = "../../html/pages/Shopping.php";

if (isset($_SESSION['user'])) {
  $cart = "../../html/pages/Cart.php";
  $whishlist  = "../../html/pages/Wishlist.php";
  $purchases = "#";
  //$settting = "#";
  //$account = "#";
} else {
  $cart = "../../html/pages/Cart.php";
  $whishlist  = "../../html/pages/Login.php";
  $purchases = "../../html/pages/Login.php";
  //$settting = "../../html/pages/Login.php";
  //$account = "../../html/pages/Login.php";
}

?>


<div id="sidebar" class="sidebar">
  <h2 class="sidebarheader">Menu</h2>
  <a href="<?php echo $home; ?>"> <i class="fas fa-home"></i>Home</a>
  <a href="<?php echo $shop; ?>"> <i class="fas fa-tags"></i>Shopping</a>
  <a href="<?php echo $cart; ?>"> <i class="fas fa-cart-plus"></i>Cart</a>
  <a href="<?php echo $whishlist; ?>"> <i class="fas fa-heart"></i>WishList</a>
  <a href="<?php echo $purchases; ?>"> <i class="fas fa-shopping-bag"></i>Purchases</a>


  <?php
  if (isset($_SESSION['user'])) {
    if ($_SESSION['user'] == "15") {
      echo
        '
          <a href="../../html/pages/Addproduct.php" class="navbarmenu"><i class="fas fa-sign-in-alt"></i>Add Product</a>
          ';
    }
    echo
      '
        <a href="../../php/Logout.php" > <i class="fas fa-sign-out-alt .font-Osans"></i>Sign Out</a>
        ';
  }
  ?>
</div>




<div id="navcontainer" class="navbarcontainer">
  <a id="sidebarbtn" class="sidebarbtn" onclick="opencloseNav()"><i class="fas fa-bars"></i></a>

  <?php
  if (!isset($_SESSION['user'])) {
    echo
      '
        <a href="../../html/pages/Login.php" class="navbarmenu"><i class="fas fa-sign-in-alt"></i>Login</a>
        <a href="../../html/pages/Signup.php" class="navbarmenu"><i class="fas fa-user-plus"></i>Signup</a>
        ';
  } else {
  }
  ?>
</div>