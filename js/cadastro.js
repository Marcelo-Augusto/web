"use strict";

$(document).ready(function (e) {
    $("#uploadimage").on('submit', (function (e) {
        e.preventDefault();
        $("#message").empty();
        $('#loading').show();
        $.ajax({
            url: "ajax_php_file.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                $('#loading').hide();
                $("#message").html(data);
            }
        });
    }));
// Function to preview image after validation
    $(function () {
        $("#alter_meal_photo").change(function () {
            $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
            {
                $('#meal_photo').attr('src', 'noimage.png');
                $("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                return false;
            }
            else
            {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    function imageIsLoaded(e) {
        $("#file").css("color", "green");
        $('#div_meal_photo').css("display", "block");
        $('#meal_photo').attr('src', e.target.result);
        $('#meal_photo').attr('width', '250px');
        $('#meal_photo').attr('height', '230px');
    }

});

var indice = 3;
var priceIndex = 1;

var app = (function (module) {

    module.hasNewProductCard = false;

    module.createProductCard = function () {

        if (!app.hasNewProductCard) {
            var productId = -1;

            var template = "<div id='div_product_card" + productId + "' class='container'>" +
                    "<div class = 'panel panel-default' >" +
                    "<div class = 'panel-body' >" +
                    "<div class = 'row' >" +
                    "<div class = 'col-sm-4' style = 'background-color:lavender;' >" +
                    "<form id = 'uploadimage' method = 'post' enctype = 'multipart/form-data' >" +
                    "<div id = 'div_product_photo" + productId + "' > <img id = 'img_product_photo" + productId + "' src = 'noimage.png' /> </div>" +
                    "<div id ='selectImage' >" +
                    "<label id='label_alter_product_photo" + productId + "' class = 'btn btn-primary' for ='input_alter_product_photo" + productId + "'>Alterar imagem</label>" +
                    "<input id = 'input_alter_product_photo" + productId + "' type='file' onchange='app.product.verifyUploadedPhoto(this, " + productId + ")'>" +
                    "</div>" +
                    "</form>" +
                    "</div>" +
                    "<div class = 'col-sm-8' style = 'background-color:lavenderblush;' >" +
                    "<form>" +
                    "<input id = 'input_product_name" + productId + "' type = 'text' class = 'form-control' placeholder = 'Nome do produto' >" +
                    "<textarea id = 'textarea_product_description" + productId + "' class = 'form-control' rows = '5'  placeholder = 'descrição do produto' > </textarea>" +
                    "<div class = 'container' >" +
                    "<button id = 'button_set_product_visibility" + productId + "' type = 'button' class = 'btn btn-default' onclick = 'app.product.setProductVisibility(" + productId + ")' > Tornar produto invisível </button>" +
                    "<button id = 'button_remove_product" + productId + "' type = 'button' class = 'btn btn-danger' onclick = 'app.product.removeProduct(" + productId + ")' > Remover produto </button>" +
                    "<button id = 'button_update_product" + productId + "' type = 'button' class = 'btn btn-success' onclick = 'app.product.updateProduct(" + productId + ")' > Confirmar alteração </button>     " +
                    "</div>" +
                    "</form>" +
                    "</div>" +
                    "</div>" +
                    "<div id = 'div_price" + productId + "' data-div-id='" + productId + "' class='minhaDiv' >" +
                    "<div class = 'row' >" +
                    "<div class = 'col-sm-1' style = 'background-color:lavender;' >" +
                    "<h4 > Preços </h4>" +
                    "</div>" +
                    "<div class = 'col-sm-11' style = 'background-color:lavenderblush;' >" +
                    "<button id='button_add_price" + productId + "' type = 'button' class = 'btn btn-primary' onclick='app.product.price.createItemPriceList(" + productId + ")'> Adicionar Preço </button>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"

            $("#product_card_list").prepend(template);
            app.hasNewProductCard = true;
            $("#message").html("createProductCard - criou novo produto " + productId);
        } else {
            $("#message").html("createProductCard - ja existe um produto novo na lista " + productId);
        }
    }

    module.createProductCardWithId = function (productId) {

        if (!app.hasNewProductCard) {

            var template = "<div id='div_product_card" + productId + "' class='container'>" +
                    "<div class = 'panel panel-default' >" +
                    "<div class = 'panel-body' >" +
                    "<div class = 'row' >" +
                    "<div class = 'col-sm-4' style = 'background-color:lavender;' >" +
                    "<form id = 'uploadimage' method = 'post' enctype = 'multipart/form-data' >" +
                    "<div id = 'div_product_photo" + productId + "' > <img id = 'img_product_photo" + productId + "' src = 'noimage.png' /> </div>" +
                    "<div id ='selectImage' >" +
                    "<label id='label_alter_product_photo" + productId + "' class = 'btn btn-primary' for ='input_alter_product_photo" + productId + "'>Alterar imagem</label>" +
                    "<input id = 'input_alter_product_photo" + productId + "' type='file' onchange='app.product.verifyUploadedPhoto(this, " + productId + ")'>" +
                    "</div>" +
                    "</form>" +
                    "</div>" +
                    "<div class = 'col-sm-8' style = 'background-color:lavenderblush;' >" +
                    "<form>" +
                    "<input id = 'input_product_name" + productId + "' type = 'text' class = 'form-control' placeholder = 'Nome do produto' >" +
                    "<textarea id = 'textarea_product_description" + productId + "' class = 'form-control' rows = '5'  placeholder = 'descrição do produto' > </textarea>" +
                    "<div class = 'container' >" +
                    "<button id = 'button_set_product_visibility" + productId + "' type = 'button' class = 'btn btn-default' onclick = 'app.product.setProductVisibility(" + productId + ")' > Tornar produto invisível </button>" +
                    "<button id = 'button_remove_product" + productId + "' type = 'button' class = 'btn btn-danger' onclick = 'app.product.removeProduct(" + productId + ")' > Remover produto </button>" +
                    "<button id = 'button_update_product" + productId + "' type = 'button' class = 'btn btn-success' onclick = 'app.product.updateProduct(" + productId + ")' > Confirmar alteração </button>     " +
                    "</div>" +
                    "</form>" +
                    "</div>" +
                    "</div>" +
                    "<div id = 'div_price" + productId + "' data-div-id='" + productId + "' class='minhaDiv' >" +
                    "<div class = 'row' >" +
                    "<div class = 'col-sm-1' style = 'background-color:lavender;' >" +
                    "<h4 > Preços </h4>" +
                    "</div>" +
                    "<div class = 'col-sm-11' style = 'background-color:lavenderblush;' >" +
                    "<button id='button_add_price" + productId + "' type = 'button' class = 'btn btn-primary' onclick='app.product.price.createItemPriceList(" + productId + ")'> Adicionar Preço </button>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"

            $("#product_card_list").prepend(template);
            app.hasNewProductCard = true;
            $("#message").html("createProductCard - criou novo produto " + productId);
        } else {
            $("#message").html("createProductCard - ja existe um produto novo na lista " + productId);
        }
    }

    module.updateProductList = function (categoryId) {
        $("#message").html("updateProductList " + categoryId);
    }

    return module;
})(app || {});

app.product = (function (module) {

    module.verifyUploadedPhoto = function (input, productId) {
        //$("#message").empty(); // To remove the previous error message
        console.log("entrou verifyUploadedPhoto");
        var file = input.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            $('#img_product_photo' + productId).attr('src', 'noimage.png');
            //$("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
            $("#message").html("entrou verifyUploadedPhoto - deu erro " + productId);
            console.log("entrou verifyUploadedPhoto - deu erro " + productId);
            return false;
        } else {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#div_product_photo' + productId).css("display", "block");
                $('#img_product_photo' + productId).attr('src', e.target.result);
                $('#img_product_photo' + productId).attr('width', '250px');
                $('#img_product_photo' + productId).attr('height', '230px');
                $("#message").html("entrou verifyUploadedPhoto - deu tudo certo " + productId + " " + imagefile + " #img_product_photo" + productId);
                console.log("entrou verifyUploadedPhoto - deu tudo certo " + productId + " " + imagefile + " #img_product_photo" + productId);
            };
            reader.readAsDataURL(input.files[0]);
            //$("#message").html("entrou verifyUploadedPhoto - deu tudo certo " + productId + " " + imagefile);
            console.log("entrou verifyUploadedPhoto - deu tudo certo " + productId + " " + imagefile);
        }
    }

    module.setProductVisibility = function (productId) {
        $("#message").html("setProductVisibility " + productId);
    }

    module.removeProduct = function (productId) {
        $("#div_product_card" + productId).remove();
        if (productId == -1) {
            app.hasNewProductCard = false;
        }
        $("#message").html("removeProduct " + productId);
    }

    module.updateProduct = function (productId) {

//        if (productId == -1) {
//            $("#div_product_card" + productId).attr("id", "#div_product_card" + indice);
//            $("#div_product_photo" + productId).attr("id", "#div_product_photo" + indice);
//            $("#img_product_photo" + productId).attr("id", "#img_product_photo" + indice);
//            $("#label_alter_product_photo" + productId).attr("for", "#input_alter_product_photo" + indice);
//            $("#label_alter_product_photo" + productId).attr("id", "#label_alter_product_photo" + indice);
//            $("#input_alter_product_photo" + productId).attr("onchange", "app.product.verifyUploadedPhoto(this," + indice + ")");
//            $("#input_alter_product_photo" + productId).attr("id", "#input_alter_product_photo" + indice);
//            $("#input_product_name" + productId).attr("id", "#input_product_name" + indice);
//            $("#textarea_product_description" + productId).attr("id", "#textarea_product_description" + indice);
//            $("#button_set_product_visibility" + productId).attr("onclick", "app.product.setProductVisibility(" + indice + ")");
//            $("#button_set_product_visibility" + productId).attr("id", "#button_set_product_visibility" + indice);
//            $("#button_remove_product" + productId).attr("onclick", "app.product.removeProduct(" + indice + ")");
//            $("#button_remove_product" + productId).attr("id", "#button_remove_product" + indice);
//            $("#button_update_product" + productId).attr("onclick", "app.product.updateProduct(" + indice + ")");
//            $("#button_update_product" + productId).attr("id", "#button_update_product" + indice);
//            $("#div_price" + productId).attr("id", "#div_price" + indice);
//            $("#button_add_price" + productId).attr("onclick", "app.product.price.createItemPriceList(" + indice + ")");
//            $("#button_add_price" + productId).attr("id", "#button_add_price" + indice);
//
//            $("#message").html("updateProduct - alterou id de " + productId + " para " + indice);
//            console.log("updateProduct - alterou id de " + productId + " para " + indice);
//            indice = indice + 1;
//            app.hasNewProductCard = false;
//        } else {
//            $("#message").html("updateProduct " + productId);
//            console.log("updateProduct " + productId);
//        }

        if(productId==-1){
            app.product.removeProduct(productId);
            app.createProductCardWithId(indice);
            $("#message").html("updateProduct - alterou id de " + productId + " para " + indice);
            console.log("updateProduct - alterou id de " + productId + " para " + indice);
            indice = indice + 1;
            app.hasNewProductCard = false;
        } else {
            $("#message").html("updateProduct " + productId);
            console.log("updateProduct " + productId);
        }


    }

    return module;
})(app.product || {});

app.product.price = (function (module) {

    module.hasNewItemPrice = false;

    module.createItemPriceList = function (productId) {
        if (!app.product.price.hasNewItemPrice) {
            var template = "<div class='row'>" +
                    "<form>" +
                    "<div class='col-sm-1' style='background-color:lavender;'>" +
                    "<h4>R$</h4>" +
                    "</div>" +
                    "<div class='col-sm-2' style='background-color:lavenderblush;'>" +
                    "<input id='price_value" + productId + "' type='text' class='form-control'>" +
                    "</div>" +
                    "<div class='col-sm-4' style='background-color:lavenderblush;'>" +
                    "<input id='price_description" + productId + "' type='text' class='form-control' >" +
                    "</div>" +
                    "<div class='col-sm-5' style='background-color:lavenderblush;'>" +
                    "<div class='container'>" +
                    "<button id='set_price_visible' type='button' class='btn btn-default' onclick='app.product.price.setPriceVisibility(" + productId + ")'>Tornar preço invisível</button>" +
                    "<button id='remove_price' type='button' class='btn btn-danger' onclick='app.product.price.removePrice(" + productId + ")'>Remover preço</button>" +
                    "<button id='confirm_price_change' type='button' class='btn btn-success' onclick='app.product.price.updatePrice(" + productId + ")' >Confirmar alteração</button>" +
                    "</div>" +
                    "</div>" +
                    "</form>" +
                    "</div>";

            $("#div_price" + productId).append(template);
            app.product.price.hasNewItemPrice = true;
            $("#message").html("createItemPriceList - criou novo item " + productId);
        } else {
            $("#message").html("createItemPriceList - ja existe um item novo na lista " + productId);
        }

    };

    module.setPriceVisibility = function (productId) {
        $("#message").html("setPriceVisibility " + productId);
    }

    module.removePrice = function (productId) {
        $("#message").html("removePrice " + productId);
    }

    module.updatePrice = function (productId) {
        $("#message").html("updatePrice " + productId);
    }


    return module;
})(app.product.price || {});