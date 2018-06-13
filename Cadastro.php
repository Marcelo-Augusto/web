
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
        include './view/cadastro/NavbarView.php';
        include './view/cadastro/HeaderView.php';
        include './view/cadastro/CardListView.php';
        include './view/cadastro/FooterView.php';

        include './view/cadastro/cardlist_elements/productcard_elements/Preco.php';

        
        $navbarview = new NavbarView();
        $headerview = new HeaderView();
        $cardlistview = new CardListView();
        $footerview = new FooterView();

        $navbarview->getNavbarView();
        $headerview->getHeaderView();
        $cardlistview->getCardListView();
        $footerview->getFooterView();
        
        ?>

 
    </body>
</html>