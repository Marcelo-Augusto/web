<?php

class ProductCard {

    public function getProductCard($i) {
        ?>

        <script>
            function criarProduto<?php echo $i; ?>() {
                $("#message").html("vai criar o produto <?php echo $i; ?>");
            }
            ;
            function alterarVisibilidadeDoProduto<?php echo $i; ?>() {
                $("#message").html("alterar visibilidade do produto <?php echo $i; ?>");
            }
            ;
            function removerProduto<?php echo $i; ?>() {
                $("#message").html("remover produto <?php echo $i; ?>");
            }
            ;
            function confirmarAlteracaoDoProduto<?php echo $i; ?>() {
                $("#message").html("confirmar alteração do produto <?php echo $i; ?>");
            }
            ;

            function adicionarPreco<?php echo $i; ?>() {



                var button1 = document.createElement("button");
                button1.id = 'confirm_price_change';
                button1.className = 'btn btn-success';
                button1.type = 'button';
                var textoButton1 = document.createTextNode("Confirmar Alteração");
                button1.appendChild(textoButton1);

                var button2 = document.createElement("button");
                button2.id = 'remove_price';
                button2.className = 'btn btn-danger';
                button2.type = 'button';
                var textoButton2 = document.createTextNode("Remover Preço");
                button2.appendChild(textoButton2);

                var button3 = document.createElement("button");
                button3.id = 'set_price_visible';
                button3.className = 'btn btn-default';
                button3.type = 'button';
                var textoButton3 = document.createTextNode("Tornar preço invisível");
                button3.appendChild(textoButton3);

                var divContainer = document.createElement("div");
                divContainer.className = 'container';
                divContainer.appendChild(button3);
                divContainer.appendChild(button2);
                divContainer.appendChild(button1);

                var divButton = document.createElement("div");
                divButton.className = 'col-sm-5';
                divButton.appendChild(divContainer);

                var input1 = document.createElement("input");
                input1.id = 'price_description';
                input1.className = 'form-control';
                input1.type = 'text';

                var divInput1 = document.createElement("div");
                divInput1.className = 'col-sm-4';
                divInput1.appendChild(input1);

                var input2 = document.createElement("input");
                input2.id = 'price_value';
                input2.className = 'form-control';
                input2.type = 'text';

                var divInput2 = document.createElement("div");
                divInput2.className = 'col-sm-2';
                divInput2.appendChild(input2);

                var h4 = document.createElement("h4");
                var textoH4 = document.createTextNode("R$");
                h4.appendChild(textoH4);

                var divH4 = document.createElement("div");
                divH4.className = 'col-sm-1';
                divH4.appendChild(h4);

                var form = document.createElement("form");
                form.appendChild(divH4);
                form.appendChild(divInput2);
                form.appendChild(divInput1);
                form.appendChild(divButton);

                var divPrincipal = document.createElement("div");
                divPrincipal.className = 'row';
                divPrincipal.appendChild(form);


                var node = document.createElement("div");
                var textnode = document.createTextNode("marcelo");
                node.appendChild(textnode);
                document.getElementById("price_div<?php echo $i; ?>").appendChild(divPrincipal);
                $("#message").html("adicionar preço - teste <?php echo $i; ?>");
            }
            ;

            function alterarVisibilidadeDoPreco<?php echo $i; ?>() {
                $("#message").html("alterar visibilidade do preço <?php echo $i; ?>");
            }
            ;

            function removerPreco<?php echo $i; ?>() {
                $("#message").html("remover preço <?php echo $i; ?>");
            }
            ;

            function confirmarAlteracaoDoPreco<?php echo $i; ?>() {
                $("#message").html("confirmar alteração do preço <?php echo $i; ?>");
            }
            ;
        </script>

        <div class="container" draggable="true">
            <div class = "panel panel-default" >
                <div class = "panel-body" >
                    <div class = "row" >
                        <div class = "col-sm-4" style = "background-color:lavender;" >
                            <form id = "uploadimage" action = "" method = "post" enctype = "multipart/form-data" >
                                <div id = "div_meal_photo" > <img id = "meal_photo" src = "noimage.png" /> </div>
                                <div id = "selectImage" >
                                    <div id = "message" > </div>
                                    <label class = "btn btn-primary" for ='alter_meal_photo'>Alterar imagem</label>
                                    <input id = 'alter_meal_photo' type='file'>
                                </div>
                            </form>
                        </div>
                        <div class = "col-sm-8" style = "background-color:lavenderblush;" >
                            <form>
                                <input type = "text" class = "form-control" id = "meal_name" placeholder = "Nome do produto" >
                                <textarea class = "form-control" rows = "5" id = "meal_description" placeholder = "descrição do produto" > </textarea>
                                <div class = "container" >
                                    <button id = "set_meal_visible" type = "button" class = "btn btn-default" onclick = "alterarVisibilidadeDoProduto<?php echo $i; ?>()" > Tornar produto invisível </button>
                                    <button id = "remove_meal" type = "button" class = "btn btn-danger" onclick = "removerProduto<?php echo $i; ?>()" > Remover produto </button>
                                    <button id = "confirm_meal_change " type = "button" class = "btn btn-success" onclick = "confirmarAlteracaoDoProduto<?php echo $i; ?>()" > Confirmar alteração </button>     
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id = "price_div<?php echo $i; ?>" >
                        <div class = "row" >
                            <div class = "col-sm-1" style = "background-color:lavender;" >
                                <h4 > Preços </h4>
                            </div>
                            <div class = "col-sm-11" style = "background-color:lavenderblush;" >
                                <button id = "add_price" type = "button" class = "btn btn-primary" onclick = "adicionarPreco<?php echo $i; ?>()" > Adicionar Preço </button>
                            </div>
                        </div>
                        <?php
                        $preco = new Preco();
                        echo $preco->getPreco();
                        echo $preco->getPreco();
                        ?>
                    </div>

                </div>
            </div>
        </div>

        <?php
    }

}
?>

