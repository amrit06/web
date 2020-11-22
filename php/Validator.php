<?php


    function validate_email($text, &$span)
    {
        if(!empty($text)){
            $data = test_input($text);
            if(filter_var($data, FILTER_VALIDATE_EMAIL) ){
                $span = "";
                return $data;
            }
            $span = "* Invalid Email";
        }else{
            $span = "* Must Have a Input!";
        }
        return NULL;
    }

    function compare_password($text, $text2, &$span, $errormsg)
    {
        if (strcmp($text, $text2) == 0){
            $span = "";
            return $text;
        }else{
            $span = $errormsg;
            return NULL;
        }
    }


    function validate($text, &$span, $errormsg, $matcher)
    {
        if(!empty($text)){
            $data = test_input($text);
            if(preg_match($matcher, $data)){
                $span = "";
                return $data;
            }
            $span = $errormsg;
        }else{
            $span = "* Must Have a Input!";
        }
        return NULL;
    }

    function validate_empty($text, &$span , $errormsg){
        if( !empty($text) ){
            $data = test_input($text);
            $span = "";
            return $data;
        }else{
            $span = $errormsg;
            return NULL;
        }
    }


    function test_input($data) { // for security and prevent injection
        $data = trim($data);
        $data = stripslashes($data); // only remove \ not /
        $data = htmlspecialchars($data);
        return $data;
    }


?>
