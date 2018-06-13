<?php

class MealPriceCardView {

    public function getMealPriceCardView() {

        echo ' 
            <div class="row">
                <div class="col-sm-1" style="background-color:lavender;">
                    <h4>Preços</h4>
                </div>
                <div class="col-sm-11" style="background-color:lavenderblush;">
                    <button id="add_price" type="button" class="btn btn-primary">Adicionar Preço</button>
                </div>
            </div>';
    }

}

?>