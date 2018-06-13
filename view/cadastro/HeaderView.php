<?php
class HeaderView{
    public function getHeaderView(){
        
        include 'header_elements/Dropdown.php';
        include 'header_elements/NewProductButton.php';

        $dropdown = new Dropdown();
        $newProductButton = new NewProductButton();
        
        echo '<div class="container">
            <div class="row">

                '.$dropdown->getDropdown().'

               '.$newProductButton->getNewProductButton().'
            </div>
        </div>';
    }
}
?>

