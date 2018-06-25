<?php
include('./connection/connection.php');

if (isset($_GET[excluir])) {
    $scriptSQL = "DELETE FROM `autores` WHERE `autores`.`id_Autor` = " . $_GET['id'] . ";";
    $result = $conn->query($scriptSQL);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lista de Produtos</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/cadastro.js"></script>
        <link rel="stylesheet" href="css/cadastro.css" />

        <script>
            var category_id;
        </script>

    </head>
    <body>

        <div class="container">
            <div class="text-center">
                <select class="form-control" id="sel1">
                    <?php
                    $resultCategory = $conn->query("SELECT * FROM `category`");
                    $numero = 0;
                    while ($category = $resultCategory->fetch_object()) {
                        ?>
                        <option><?php
                            echo $category->name;
                            if ($numero == 0) {
                                ?>
                            <script>
                                category_id = "<?php echo $category->name; ?>";
                            </script>
                            <?php
                            $category_id = $category->id_category;
                            $scriptSQL = "SELECT * FROM `meal` WHERE id_category = " . $category->id_category;
                            $result = $conn->query($scriptSQL);
                            $numero_registros = $result->num_rows;
                            $numero = 1;
                        }
                        ?></option>
                        <?php
                    }
                    ?>
                </select>
                <a id="create" href="javascript:getUrl();" class="btn btn-default">Criar novo produto</a>
            </div>

            <div id="teste" class="list-group">
                <?php
                while ($vetor = $result->fetch_object()) {
                    $photo = "./upload/" . $vetor->src_photo;
                    ?>
                    <a href="./testeEditarProdutoComBootstrap.php?editar=1&id=<?php echo $vetor->id_meal; ?>" class="list-group-item"><?php echo $vetor->name; ?></a>
                    <?php
                }
                ?>
            </div> 
        </div> 

        <div id="demo">

        </div>

    </body>

    <script>
        function getUrl() {
            var url = "./testeCadastroProdutoComBootstrap.php?name_category=" + category_id;
            return url;
        }
        
        $(document).ready(function (e) {
            var url = getUrl();
            $('#create').attr('href', url);
        });



        $('#sel1').on('change', function () {
            var selected = $('#sel1').val();
            category_id = selected;
            //alert(selected);
            var url = getUrl();
            $('#create').attr('href', url);
            $.ajax({
                type: "POST",
                url: "./testeObterListaProduto.php",
                data: {"data": selected},
                success: function (data)
                {
                    //alert(data);
                    document.getElementById("teste").innerHTML = data;
                    //utilizar o dado retornado para alterar algum dado da tela.
                }
            });
        });


    </script>

</html>