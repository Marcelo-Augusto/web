
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/cadastro.js"></script>
        <link rel="stylesheet" href="css/cadastro.css" />

    </head>
    <body>

        <div id="message"></div>

        <?php
//        include './view/cadastro/NavbarView.php';
//        include './view/cadastro/HeaderView.php';
//        include './view/cadastro/CardListView.php';
//        include './view/cadastro/FooterView.php';
//
//        include './view/cadastro/cardlist_elements/productcard_elements/Preco.php';
//
//        
//        $navbarview = new NavbarView();
//        $headerview = new HeaderView();
//        $cardlistview = new CardListView();
//        $footerview = new FooterView();
//
//        $navbarview->getNavbarView();
//        $headerview->getHeaderView();
//        $cardlistview->getCardListView();
//        $footerview->getFooterView();
        ?>

        <!--header-->
        <nav class="navbar navbar-expand-sm my-nav" style="left: -3px; width: 101%">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="./home.html">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.html">Sair</a>
                    </li>
                </ul>
            </div>
            <a class="navbar-brand">
                <img src="../Imagens/logo.png" class="float-right" width="7%" alt="Cardig">
            </a>
        </nav>

        <br>

        <!--dropdown e botao de criar novo produto-->
        <div class="container">
            <div class="row">

                <!--dropdown-->
                <div class="col-sm-9 col-md-9 col-lg-9" style="text-align: center;">
                    <div id="category_dropdown" class="dropdown" >
                        <button id="button_dropdown_category" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Populares
                        </button>
                        <ul id="ul_dropdown_category" class="dropdown-menu">
                            <li><a href="#" class="a_dropdown_category">Populares</a></li>
                            <li><a href="#" class="a_dropdown_category">Acompanhamentos</a></li>
                            <li><a href="#" class="a_dropdown_category">Tardicionais</a></li>
                            <li><a href="#" class="a_dropdown_category">Especiais</a></li>
                            <li><a href="#" class="a_dropdown_category">Bebidas</a></li>
                        </ul>
                    </div>  
                </div>

                <!--botao de criar novo produto-->
                <div id="div_button_new_product" class="col-sm-3 col-md-3 col-lg-3">
                    <button id="button_new_product" type="button" class="btn btn-warning" onclick="app.createProductCard()">Criar novo produto</button>
                </div>
            </div>
        </div>

        <br>

        <div id="product_card_list">
            <!--card do produto-->
            <div class="container">
                <div class="panel panel-default">
                    <div id="div_panel_product" class="panel-body">
                        <div class= "row">

                            <!--nome e descricao-->
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">

                                <!--nome do produto-->
                                <input id="editor_name" class="editor" data-toggle="tooltip" data-placement="right" title="Clique para editar!" type="text" placeholder="Insira o nome do produto aqui" value="Do Avesso"/>

                                <!--preço do produto-->
                                <input id="editor_preco" class="editor" data-toggle="tooltip" data-placement="right" title="Clique para editar!" type="text" placeholder="Insira o preço aqui" value=""/>

                                <!--descricao do produto-->
                                <textarea id="editor_description" class="editor" data-toggle="tooltip" data-placement="right" title="Clique para editar!" name="Text1" cols="40" onkeyup="auto_grow(this)" placeholder="Insira a descrição do produto aqui">Habúrguer de 150g regado em nosso molho espacial secreto, no pão com bacon, catupiry e mussarela por fora. Servido com batatas fritas e ovo frito. </textarea>

                            </div>

                            <!--foto do produto-->
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                <img id="image_product" src="../Imagens/DoAvesso.png" alt="Snow">
                                <input type="file" id="button_change_product_photo" class="btn" name="file" required />
                            </div>

                            <!--remover produto-->
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                <img id="image_remove_product" src="../Imagens/close_icon.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--footer-->
        <br><br>
        <footer class="mojFooter">
            <div class="footertexto py-3">
                © 2018 Cardig. All rights reserved.
            </div>
        </footer>


    </body>
</html>