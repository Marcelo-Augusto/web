<?php

class Category{

    var $id;
    var $name;
    
    function Category($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
    
    function getId(){
        return $this->id;
    }
    
    function getName(){
        return $this->name;
    }
}

?>

