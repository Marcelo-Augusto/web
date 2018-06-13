<?php

class MealCardView {

    public function getMealCardView($mealPriceCardView, $priceView) {

        echo ' 
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-4" style="background-color:lavender;">
                                <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                                    <div id="div_meal_photo"><img id="meal_photo" src="noimage.png" /></div>
                                    <div id="selectImage">
                                        <div id="message"></div>
                                        <label class="btn btn-primary" for=\'alter_meal_photo\'>Alterar imagem</label>
                                        <input id=\'alter_meal_photo\' type=\'file\'>
                                        <button id="confirm_photo_change" type="button" class="btn btn-success">Confirmar Alteração</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-8" style="background-color:lavenderblush;">
                                <form>
                                    <input type="text" class="form-control" id="meal_name" placeholder="Nome do produto">
                                    <textarea class="form-control" rows="5" id="meal_description" placeholder="descrição do produto"></textarea>
                                    <div class="container">
                                        <button id="set_meal_visible" type="button" class="btn btn-default">Tornar produto invisível</button>
                                        <button id="remove_meal" type="button" class="btn btn-danger">Remover produto</button>
                                        <button id="confirm_meal_change " type="button" class="btn btn-success">Confirmar alteração</button>     
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div id="price_div">'
                        .$mealPriceCardView.$priceView.
                        '</div>

                    </div>
                </div>
            </div>';
    }

}

?>