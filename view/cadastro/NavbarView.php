<?php
class NavbarView{
    public function getNavbarView(){
        
        include 'navbar_elements/Menu.php';
        include 'navbar_elements/Icon.php';

        $menu = new Menu();
        $icon = new Icon();
        
        echo '<nav class="navbar navbar-expand-sm my-nav" style="left: -3px; width: 101%">
                <div class="collapse navbar-collapse" id="navbarNav">'.
                    $menu->getMenu().
                    $icon->getIcon("../Imagens/logo.png")
                .'</div>
            </nav>';
    }
}
?>

