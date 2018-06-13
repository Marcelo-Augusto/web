<?php

class Dropdown {

    public function getDropdown() {
        
        include 'dropdown_elements/DropdownItem.php';
        
        $dropdownItem = new DropdownItem();
        
        return '<div id="category_dropdown" class="dropdown" >
                    <button id="button_dropdown_category" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Populares</button>
                    <ul id="ul_dropdown_category" class="dropdown-menu">
                        ' . $dropdownItem->getDropdonwItem("Populares") .
                            $dropdownItem->getDropdonwItem("Acompanhamentos") .
                            $dropdownItem->getDropdonwItem("Tardicionais") .
                            $dropdownItem->getDropdonwItem("Especiais") .
                            $dropdownItem->getDropdonwItem("Bebidas") . '
                    </ul>
                </div>';
    }

}
?>

