<?php
include_once '../../../php/Database.php';
include_once '../../../php/Product.php';
?>

<div class="body">

    <div class="columnleft">
        <?php
        include('../../../html/layouts/Categoy.php');
        ?>
    </div>

    <div class="columnright">
        <div class="subpage_product_section">
            <?php
            $db = new Database();
            $connection = $db->connect();
            $product = new Product($connection);
            $result = $product->showProductByQuery(array("id", "name", "pic"), array("groupid=4"));

            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                            <div class="card_wrapper">
                                 <a href="../../html/pages/Productpage.php?id=' . $row['id'] . ' ">
                                    <img src="data:image/jpg;base64,' . base64_encode($row['pic']) . '" /></a>
                                 </a>
                                 <h4> ' . $row['name'] . ' </h4>
                             </div>
                           ';
            }

            $connection->close();
            ?>

        </div>

    </div>

</div>