<?php
session_start();
include_once '../../php/Database.php';
include_once '../../php/Product.php';
include_once '../../php/Foreign.php';
include_once '../../php/Cart.php';


function updateCartSession()
{
    $db = new Database();
    $conn = $db->connect();
    $product = new Product($conn);
    $counter = 0;
    foreach ($_SESSION['cart'] as $c) {
        $cart = unserialize($c);
        $result = $product->showProductByQuery(array("price"), array("id = " . $cart->productid));
        $row = mysqli_fetch_assoc($result);
        $cart->totalprice = $cart->quantity * $row['price'];
        $_SESSION['cart'][$counter] = serialize($cart);
        $counter += 1;
    }
}


function updateCartDB($case, $id)
{   

    $db = new Database();
    $conn = $db->connect();
    $product = new Product($conn);
    $result = $product->showByConditionInnerJoin(
        "cart",
        "productid",
        array("product.price as price","cart.quantity as quantity"),
        array("cart.id = " . $id)
    );
    $row = mysqli_fetch_assoc($result);
    $conn->close();

    $db = new Database();
    $conn = $db->connect();
    $cart = new ForeignTables($conn);
    switch ($case) {
        case "add":
            $row['quantity'] += 1;
            $totalprice = $row['quantity'] * $row['price'];
            $cart->updateTable("cart", array("quantity = " . $row['quantity'], "totalprice = " . $totalprice), array("id = $id") );
            break;
        case "minus":
            if ($row['quantity'] >= 2) {
                $row['quantity'] -= 1;
            }
            $totalprice = $row['quantity'] * $row['price'];
            $cart->updateTable("cart", array("quantity = " . $row['quantity'], "totalprice = " . $totalprice), array("id = $id") );
            break;
        case "remove":
            $cart->deleteFromTable("cart", array("id = " . $id));
            break;
        default:
            exit(100);
    }
}

?>

<?php


echo '
        <div class="cart_list">
        <table>
            <tr>
                <th></th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th></th>
            </tr>';

if (isset($_SESSION['user'])) {
    // if logged in
    $db = new Database();
    $conn = $db->connect();
    $table = new Product($conn);
    $result = $table->showByConditionInnerJoin(
        "cart",
        "productid",
        array("product.name as name", "product.pic as pic", "product.price as price", "cart.id as cartid", "cart.quantity as quantity", "cart.totalprice as totalprice"),
        array("cart.userid = " . $_SESSION['user'])
    );

    
    if ($result->num_rows > 0) {
        // get result inner join product and cart
        while ($row = mysqli_fetch_assoc($result)) {
            // list them

            echo
                '
                        <tr class="table_content">
                        
                        <td><img src="data:image/jpg;base64,' . base64_encode($row['pic']) . '" /></td>
                        <td>
                            <h3>' . $row['name'] . '</h3>
                        </td>
                        <td>
                        <div class="cart_quantity">
    
                        <form method="POST">
                        
                        <div class="add">
                            <button type="submit" name="add" value="' . $row['cartid'] . '"><i class="fas fa-plus"></i></button>
                        </div>
    
                        <h3>' . $row['quantity'] . '</h3>
    
                        <div class="minus">
                            <button type="submit" name="minus" value="' . $row['cartid'] . '"><i class="fas fa-minus"></i></button>
                        </div>
    
                        </div>
                        </td>
                        <td>
                            <h3>$' . $row['price'] . '</h3>
                        </td>
                        <td>
                            <h3>$' . $row['totalprice'] . '</h3>
                        </td>
                        <td>
                            <button name="remove" value="' . $row['cartid'] . '" class="remove">Remove</button>
                        </td>
                        </form>
                        </tr>
                        ';
        }
    } else {
        echo
            '
            <h3>NO ITEMS IN CART</h3>
            ';
    }

} else {

    if (isset($_SESSION['cart'])) {

        $db = new Database();
        $conn = $db->connect();
        updateCartSession();
        $counter = 0;
        foreach ($_SESSION['cart'] as $c) {
            $cart = unserialize($c);
            $product = new Product($conn);
            $result = $product->showProductByQuery(array("name", "price", "pic"), array("id = " . $cart->productid));
            $row = mysqli_fetch_assoc($result);
            echo
                '
                        <tr class="table_content">
                        
                        <td><img src="data:image/jpg;base64,' . base64_encode($row['pic']) . '" /></td>
                        <td>
                            <h3>' . $row['name'] . '</h3>
                        </td>
                        <td>
                        <div class="cart_quantity">
    
                        <form method="POST">
                        
                        <div class="add">
                            <button type="submit" name="add" value="' . $counter . '"><i class="fas fa-plus"></i></button>
                        </div>
    
                        <h3>' . $cart->quantity . '</h3>
    
                        <div class="minus">
                            <button type="submit" name="minus" value="' . $counter . '"><i class="fas fa-minus"></i></button>
                        </div>
    
                        </div>
                        </td>
                        <td>
                            <h3>$' . $row['price'] . '</h3>
                        </td>
                        <td>
                            <h3>$' . $cart->totalprice . '</h3>
                        </td>
                        <td>
                            <button name="remove" value="' . $counter . '" class="remove">Remove</button>
                        </td>
                        </form>
                        </tr>
                        ';

            $counter++;
        }
    } else {
        echo
            '
            <h3>NO ITEMS IN CART</h3>
            ';
    }
}

// post buttons
if (array_key_exists('add', $_POST)) {
    if (isset($_SESSION['user'])) {
        updateCartDB("add", $_POST['add']);
    } else {
        $cart = unserialize($_SESSION['cart'][$_POST['add']]);
        $cart->quantity += 1;
        $_SESSION['cart'][$_POST['add']] = serialize($cart);
    }

   echo "<meta http-equiv='refresh' content='0'>";
}

if (array_key_exists('minus', $_POST)) {
    if (isset($_SESSION['user'])) {
        updateCartDB("minus", $_POST['minus']);
    } else {
        $cart = unserialize($_SESSION['cart'][$_POST['minus']]);
        if ($cart->quantity >= 2) {
            $cart->quantity -= 1;
        }
        $_SESSION['cart'][$_POST['minus']] = serialize($cart);
    }

   echo "<meta http-equiv='refresh' content='0'>";
}


if (array_key_exists('remove', $_POST)) {
    if (isset($_SESSION['user'])) {
        updateCartDB("remove", $_POST['remove']);
    } else {
        array_splice($_SESSION['cart'], $_POST['remove'], 1);
        if (sizeof($_SESSION['cart']) <= 0) {
            unset($_SESSION['cart']);
        }
    }
    echo "<meta http-equiv='refresh' content='0'>";
}


?>
</table>
</div>