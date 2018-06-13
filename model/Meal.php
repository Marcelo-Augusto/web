<?php
class Meal {

    var $id;
    var $name;
    var $description;
    var $src_photo;
    var $id_category;
    var $enabled;

    function Meal($id, $name, $description, $src_photo, $id_category, $enabled) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->src_photo = $src_photo;
        $this->id_category = $id_category;
        $this->enabled = $enabled;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getSrcPhoto() {
        return $this->src_photo;
    }

    function getIdCategory() {
        return $this->id_category;
    }

    function is_enabled() {
        return $this->enabled;
    }

}
?>
