<?php

class ProductCard {

    
    public function getProductCard($i) {
        ?>

        <div class="container" draggable="true">
            <div class = "panel panel-default" >
                <div class = "panel-body" >
                    <div class = "row" >
                        <div class = "col-sm-4" style = "background-color:lavender;" >
                            <form id = "uploadimage" action = "" method = "post" enctype = "multipart/form-data" >
                                <div id = "div_product_photo<?php echo $i; ?>" > <img id = "img_product_photo<?php echo $i; ?>" src = "noimage.png" /> </div>
                                <div id = "selectImage" >
                                    <label class = "btn btn-primary" for ='input_alter_product_photo<?php echo $i; ?>'>Alterar imagem</label>
                                    <input id = 'input_alter_product_photo<?php echo $i; ?>' type='file' onchange="app.product.verifyUploadedPhoto(this, <?php echo $i; ?>)">
                                </div>
                            </form>
                        </div>
                        <div class = "col-sm-8" style = "background-color:lavenderblush;" >
                            <form>
                                <input id = "input_product_name<?php echo $i; ?>"type = "text" class = "form-control" placeholder = "Nome do produto" >
                                <textarea id = "textarea_product_description<?php echo $i; ?>" class = "form-control" rows = "5"  placeholder = "descrição do produto" > </textarea>
                                <div class = "container" >
                                    <button id = "button_set_product_visibility<?php echo $i; ?>" type = "button" class = "btn btn-default" onclick = "app.product.setProductVisibility(<?php echo $i; ?>)" > Tornar produto invisível </button>
                                    <button id = "button_remove_product<?php echo $i; ?>" type = "button" class = "btn btn-danger" onclick = "app.product.removeProduct(<?php echo $i; ?>)" > Remover produto </button>
                                    <button id = "button_update_product<?php echo $i; ?>" type = "button" class = "btn btn-success" onclick = "app.product.updateProduct(<?php echo $i; ?>)" > Confirmar alteração </button>     
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id = "div_price<?php echo $i; ?>" data-div-id="<?php echo $i; ?>" class="minhaDiv" >
                        <div class = "row" >
                            <div class = "col-sm-1" style = "background-color:lavender;" >
                                <h4 > Preços </h4>
                            </div>
                            <div class = "col-sm-11" style = "background-color:lavenderblush;" >
                                <button id="button_add_price<?php echo $i; ?>" type = "button" class = "btn btn-primary" onclick="app.product.price.createItemPriceList(<?php echo $i; ?>)"> Adicionar Preço </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php
    }

}
?>

