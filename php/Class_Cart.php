<?php
    class Cart {

        public $productid;
        public $quantity;
        public $price;

        public function getTotalPrice()
        {
            return ($this->quantity*$this->price);
        }
    
    }
?>