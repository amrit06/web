<?php
$con = mysqli_connect("101.112.244.156:3306", "amrit", "Kentst", "Bulli");
$response = array();

if($con){
    $sqlquery = "select * from Cash";
    $result = mysqli_query($con, $sqlquery);
    if($result){
        header("Content-Type: JSON");
        $counter = 0;
        while( $row = mysqli_fetch_assoc($result) ){
            $response[$counter]['ID'] = $row['ID'];
            $response[$counter]['Date'] = $row['Date'];
            $response[$counter]['Description'] = $row['Description'];
            $response[$counter]['Income'] = $row['Income'];
            $response[$counter]['Expense'] = $row['Expense'];
            $response[$counter]['Balance'] = $row['Balance'];
            $response[$counter]['GST'] = $row['GST'];
            $response[$counter]['Category'] = $row['Category'];
            $response[$counter]['Invoice'] = $row['Invoice'];

            $counter++;
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

}else{
    echo("error connecting DB");
}

?>