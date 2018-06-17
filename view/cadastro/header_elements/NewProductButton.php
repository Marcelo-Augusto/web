<?php

class NewProductButton {

    public function getNewProductButton() {
        return '<div id="div_button_new_product" class="col-sm-3 col-md-3 col-lg-3">
    <button id="button_new_product" type="button" class="btn btn-warning" onclick="app.createProductCard()">Criar novo produto</button>
</div>';
    }

}
?>

