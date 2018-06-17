<?php

class Preco {

    public function getPreco() {
        ?>

        <div class="row">
            <form>
                <div class="col-sm-1" style="background-color:lavender;">
                    <h4>R$</h4>
                </div>
                <div class="col-sm-2" style="background-color:lavenderblush;">
                    <input id="price_value" type="text" class="form-control">
                </div>
                <div class="col-sm-4" style="background-color:lavenderblush;">
                    <input id="price_description" type="text" class="form-control" >
                </div>
                <div class="col-sm-5" style="background-color:lavenderblush;">
                    <div class="container">
                        <button id="set_price_visible" type="button" class="btn btn-default" onclick="asdf(id)">Tornar preço invisível</button>
                        <button id="remove_price" type="button" class="btn btn-danger">Remover preço</button>
                        <button id="confirm_price_change" type="button" class="btn btn-success">Confirmar alteração</button>     
                    </div>
                </div>
            </form>
        </div>

        <?php
    }

}
?>