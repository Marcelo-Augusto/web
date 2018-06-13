<?php

class Price {
    
    var $id;
    var $description;
    var $price;
    var $id_meal;
    var $enabled;
    
    function Price($id, $description, $price, $id_meal, $enabled) {
        $this->id = $id;
        $this->description = $description;
        $this->price = $price;
        $this->id_meal = $id_meal;
        $this->enabled = $enabled;
    }
    
    function getId() {
        return $this->id;
    }

    function getDescription() {
        return $this->description;
    }
    
    function getPrice() {
        return $this->price;
    }
    
    function getIdMeal() {
        return $this->id_meal;
    }
    
    function idEnabled() {
        return $this->enabled;
    }
}

?>

