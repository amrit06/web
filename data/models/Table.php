<?php
    class Table{

        public $date;
        public $description;
        public $income;
        public $expense;
        public $balance;
        public $gst;
        public $category;
        public $who;
        public $invoice;
        
        private $connection;

        public function __construct($conn){
            $this->$connection = $conn;
        }

        public function readall($table)
        {
            $query = 'SELECT * FROM Bulli.Cash';
            $stmt = $this->$connection->prepare($query);
            $stmt->execute(array("%$query%"));

            return $stmt;
        }

        public function readQuery($id)
        {
            $query = 'SELECT * FROM Bulli.Cash WHERE Bulli.Cash.ID = ' . $id;
            $stmt = $this->$connection->prepare($query);
           // $stmt->bindParam(1, $id);
            $stmt->execute(array("%$query%"));

            return $stmt;
        }

        
        public function addData()
        {
            $query = 'INSERT INTO Bulli.Cash VALUES('.$this->$date.', '.$this->$description.', '.$this->$income.', '.$this->$expense.', '.$this->$balance.', '.$this->$gst.', '.$date.', '.$this->$category.', '.$this->$invoice.')';
            $stmt = $this->$connection->prepare($query);
        
            if($stmt->execute(array("%$query%"))){
                echo("data added");
                
            }else{
                echo("data wasn't added");
            }

            return;
        }

    }
?>