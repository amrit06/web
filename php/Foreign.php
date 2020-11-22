<?php
class ForeignTables
{
    private $connection;
    // may be validation


    function __construct($dbconnection)
    {
        $this->connection = $dbconnection;
    }

    function showAll($table, $args)
    {
        $args = implode(',', $args);
        $query = "select $args from $table";
        $result = mysqli_query($this->connection, $query);
        if ($result) {
            return $result;
        } else {
            return NULL;
        }
    }

    function showByCondition($table, $args, $condition){
        $args = implode(',', $args);
        $condition = implode(' and ', $condition);
        
        $query = "select $args from $table where $condition";
        $result = mysqli_query($this->connection, $query);
        if ($result) {
            return $result;
        } else {
            return NULL;
        }
    }


    function insertIntoTable($table, $args)
    {
        $keys = [];
        $values = [];
        foreach ($args as $k => $v) {
            $keys[] = "$k";
            $values[] = "$v";
        }
        $keys = implode(',', $keys);
        $values = implode(',', $values);

        $query = "INSERT INTO $table ($keys) VALUES ($values)";
        
        if ($this->connection->query($query) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function deleteFromTable($table, $condition)
    {
        $condition = implode(' and ', $condition);
        $query = "DELETE FROM $table where $condition";
        if ($this->connection->query($query) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    function updateTable($table, $args, $condition){
        $args = implode(',', $args);
        $condition = implode(' and ', $condition);
         
        $query = "UPDATE $table SET $args where $condition";
        
        if ($this->connection->query($query) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


}
