<?php
include_once '../../../php/Database.php';
include_once '../../../php/Product.php';
include_once '../../../php/Foreign.php';
?>

<script type="text/javascript">
    var link  = window.location.search.substring(1);
    var id = link.split("=")[1];
    window.location.hash = id;
</script>


<div class="mian_img_con">
    <img src="../../assets/bigpic1.jpg">
</div>

<div class="main_collage_con">
    <div class="row10">
        <div class="collage_img_col">
            <img src="../../assets/pic01.jpg">
        </div>

        <div class="collage_img_col">
            <img src="../../assets/pic02.jpeg">
        </div>

        <div class="collage_img_col">
            <img src="../../assets/pic03.jpeg">
        </div>
    </div>

    <div class="row10">
        <div class="collage_img_col">
            <img src="../../assets/pic04.jpg">
        </div>

        <div class="collage_img_col">
            <img src="../../assets/pic05.jpg">
        </div>

        <div class="collage_img_col">
            <img src="../../assets/pic1.jpg">
        </div>
    </div>

</div>

<div class="main_list_content">
    <?php
    $db = new Database();
    $connection = $db->connect();

    $foreign = new ForeignTables($connection);
    $product = new Product($connection);

    $result = $foreign->showAll("category", array("id", "category"));
    while ($row = mysqli_fetch_assoc($result)) {
        $result2 = $product->showProductByQuery(array("id", "name", "pic"), array("categoryid = " . $row['id']));
        if (mysqli_num_rows($result2) > 0) {
            echo
                '
            <div class="index_list_wrapper">
                <div class="list_header">
                    <h3><a id = '.$row["id"].'>'. $row["category"].'</a></h3>
                </div>
                <div class="list_pic_card_wrapper">
            ';

            while ($row2 = mysqli_fetch_assoc($result2)) {
                echo
                    '
                    <div class="card_wrapper">
                        <a href="Productpage.php?id=' . $row2['id'] . '"><img class="categorypic" src="data:image/jpg;base64,' . base64_encode($row2['pic']) . '" /></a>
                        <h4> ' . $row2['name'] . ' </h4>
                        <hr>
                    </div>
                ';
            }
            echo
                '
                </div>
             </div> 
            ';
        }
    }
    $connection->close();
    ?>

</div>