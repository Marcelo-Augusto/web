<?php

class ItemMenu{
    public function getItemMenu($link, $texto){
        return '<li class="nav-item active">
            <a class="nav-link" href="'.$link.'">'.$texto.'<span class="sr-only">(current)</span></a>
        </li>';
    }
}

?>

