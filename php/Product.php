<?php

class Product
{
    private $connection;
    // may be validation


    function __construct($dbconnection)
    {
        $this->connection = $dbconnection;
    }

    function showAllProduct($args)
    {
        $args = implode(',', $args);
        $query = "select $args from product";
        $result = mysqli_query($this->connection, $query);

        if ($result) {
            return $result;
        } else {
            return NULL;
        }
    }


    function showByConditionInnerJoin($table, $column, $args, $condition){
        
        $args = implode(',', $args);
        $condition = implode(' and ', $condition);
        $query = "select $args 
        from product
        inner join $table
        on product.id = $table.$column
        where $condition";
        
        $result = mysqli_query($this->connection, $query);

        if ($result) {
            return $result;
        } else {
            return NULL;
        }
    }

    function showProductByQuery($args, $condition)
    {
        $args = implode(',', $args);
        $condition = implode(' and ', $condition);

        $query = "select $args from product where $condition";
        $result = mysqli_query($this->connection, $query);
        //echo $query;
        if ($result) {
            return $result;
        } else {
            return NULL;
        }
    }

    function addProduct($args)
    {
        $keys = [];
        $values = [];
        foreach ($args as $k => $v) {
            $keys[] = "$k";
            if ($k != "categoryid" || $k != "quantity" || $k != "price") {
                $values[] = "'$v'";
            } else {
                $values[] = "$v";
            }
        }
        $keys = implode(",", $keys);
        $values = implode(",", $values);

        $query = "INSERT INTO product ($keys) VALUES ($values)";
        if ($this->connection->query($query) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function distinctCategoryFromProduct()
    {   
        $query = "
        SELECT c.category as category, min(pic) as pic, categoryid 
        FROM product AS p 
        INNER JOIN category AS c 
        ON p.categoryid = c.id 
        where pic is not null 
        group by categoryid
        ";
            
        $result = mysqli_query($this->connection, $query);
        //echo $query;
        if ($result) {
            return $result;
        } else {
            echo $this->connection->error;
            return NULL;
        }
    }

}
