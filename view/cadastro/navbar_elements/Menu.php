<?php

class Menu{
    public function getMenu(){
        
        include 'menu_elements/ItemMenu.php';
        
        $itemMenu = new ItemMenu();
        
        return '<ul class="navbar-nav">'.
                $itemMenu->getItemMenu("./home.html", "Home").
                $itemMenu->getItemMenu("./login.html", "Sair")   
                .'</ul>';
    }
}

?>

