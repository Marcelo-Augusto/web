<?php
include('./connection/connection.php');

if (isset($_POST[editar_dados])) {

    $scriptSQL = "SELECT * FROM `meal` where `id_meal`=" . $_POST[id_meal] . ";";
    $result = $conn->query($scriptSQL);
    $vetor = $result->fetch_object();

    if (isset($_FILES["file"]["type"])) {
        $validextensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);

        if (in_array($file_extension, $validextensions)) {
            if ($_FILES["file"]["error"] > 0) {
                
            } else {

                $novoNome = uniqid(time()) . '.' . $file_extension;
                $destino = 'upload/' . $novoNome;
                $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable

                move_uploaded_file($sourcePath, $destino); // Moving Uploaded file
            }
        }
    }


    if (isset($_POST[enable]) && $_POST[enable] == 'T') {
        $enable = 'T';
    } else {
        $enable = 'F';
    }

    if (isset($_POST[photo_change]) && $_POST[photo_change] != "") {
        if (isset($vetor->src_photo) && $vetor->src_photo != "") {
            //echo "<br>remove a foto antiga!<br>";
            $file = "upload/" . $vetor->src_photo;
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    if (!isset($novoNome) || $novoNome == "") {
        $novoNome = $vetor->src_photo;
    }

    $scriptSQL = "UPDATE `meal` SET `name` = '" . $_POST[nome] . "', `description` = '" . $_POST[descricao] . "', `src_photo` = '" . $novoNome . "', `enable` = '" . $enable . "' WHERE `id_meal` = " . $_POST[id_meal] . ";";
    mysqli_query($conn, $scriptSQL);

    $scriptSQL = "SELECT * FROM `meal` where `id_meal`=" . $_POST[id_meal] . ";";
    $result = $conn->query($scriptSQL);
    $vetor = $result->fetch_object();

    $atualizado = 'true';
} else if (isset($_POST[remover_produto])) {

    echo "remover produto!<br>";

    $scriptSQL = "DELETE FROM `meal` WHERE `id_meal` = " . $_POST[id_meal] . ";";
    $result = $conn->query($scriptSQL);
    $deleted = 'true';
} else if (isset($_GET['editar'])) {
    $scriptSQL = "SELECT * FROM `meal` where `id_meal`= " . $_GET[id] . " ;";
    $result = $conn->query($scriptSQL);
    $vetor = $result->fetch_object();
} else {
    $scriptSQL = "SELECT * FROM `meal` where `id_meal`=27;";
    $result = $conn->query($scriptSQL);
    $vetor = $result->fetch_object();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Teste editar Cadastro Com Boostrap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>

        <div class="container">

            <?php
            if (isset($deleted)) {
                ?>
                <div class="container text-center">
                    <h2>O produto <?php echo $_POST[nome]; ?> foi deletado com sucesso! </h2>
                    <p>Um novo produto foi removido. Clique no botão abaixo para ir para a lista de produtos.</p>
                    <br>
                    <div class="text-center">
                        <a href="./testeListaCadastro.php" class="btn btn-default">Lista de produtos</a>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <form name="form" class="form-horizontal" action="./testeEditarProdutoComBootstrap.php" method="post" enctype="multipart/form-data">
                    <div class="text-center">
                        <h2>Editar produto</h2>
                        <p>Altere os campos abaixo para atualizar o cadastro produto.</p>
                    </div>
                    <div class="form-group">
                        <label for="usr">Nome do produto:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $vetor->name; ?>" required="" placeholder="Insira o nome do produto aqui">
                    </div>
                    <div class="form-group">
                        <label for="comment">Descrição do produto:</label>
                        <textarea type="text" name="descricao" class="form-control" rows="5" id="description" placeholder="Insira a descrição do produto aqui"><?php echo $vetor->description; ?></textarea>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label><input id="enable" name="enable" type="checkbox" value="T"
                                <?php
                                if ($vetor->enable == 'T') {
                                    echo "checked";
                                }
                                ?>
                                          >Tornar produto visível</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <img id="meal_photo" src="./upload/<?php echo $vetor->src_photo; ?>" class="img-rounded" width="304" height="236">
                        <br>
                        <label for="comment">Selecionar Imagem:</label>
                        <input type="file" name="file" id="file" />
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="photo_change" name="photo_change">
                        <input type="hidden" value="<?php echo $vetor->id_meal; ?>" id="id_meal" name="id_meal">
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Preços</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="usr">Valor:</label>
                                    <input type="text" class="form-control" id="value" name="value" placeholder="valor">
                                </div>
                                <div class="col-sm-10">
                                    <label for="usr">Descrição do preço:</label>
                                    <input type="text" class="form-control" id="price_description" name="price_description" placeholder="Descrição">
                                </div>
                            </div> 
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-center">
                                        <span class="pull-right"><div class="btn btn-primary" onclick="adicionarPreco()">Adicionar</div></span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <ul id="price_list" class="list-group">
                                <?php
                                $price_query = "SELECT * FROM `price` WHERE `id_meal` = " . $vetor->id_meal . " ";
                                $result_price = $conn->query($price_query);
                                while ($price = $result_price->fetch_object()) {
                                    ?>
                                    <li id="price_item<?php echo $price->id_price; ?>" class="list-group-item">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <p><b id="b<?php echo $price->id_price; ?>"><?php echo 'R$' . number_format($price->price, 2, ',', '.'); ?></b></p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p><b><?php echo $price->description; ?></b></p>
                                            </div>

                                            <div class="col-sm-2">
                                                <span class="pull-right">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label><input id="enable" name="enable" type="checkbox" value="<?php echo $price->enable; ?>"
                                                                          <?php 
                                                                            if($price->enable=='1'){
                                                                                echo "checked";
                                                                            }
                                                                          ?>
                                                                          onchange="setPriceVisibility(<?php echo $price->id_price; ?>, this)" >Tornar preço visível</label>
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="pull-right"><div class="btn btn-default" onclick="removerPreco(<?php echo $price->id_price; ?>)">Remover</div></span>
                                            </div>
                                        </div> 
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul> 
                        </div>
                    </div>

                    <br>

                    <div class="text-center">
                        <a href="./testeListaCadastro.php" class="btn btn-default">Lista de produtos</a>
                        <button type="submit" class="btn btn-primary" name="remover_produto" value="remover">Remover</button>
                        <button type="submit" class="btn btn-primary" name="editar_dados" value="editar">Salvar</button>
                    </div>

                </form>
                <br>
                <br>
            </div>
            <?php
        }
        ?>

        <?php
        if (isset($atualizado)) {
            ?>
            <script>
                alert("Produto atualizado com sucesso!");
            </script>
            <?php
        }
        ?>

    </body>

    <script>

        $(document).ready(function (e) {
            // Function to preview image after validation
            $(function () {
                $("#file").change(function () {
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
                $('#meal_photo').attr('src', e.target.result);
                $('#meal_photo').attr('width', '250px');
                $('#meal_photo').attr('height', '230px');
                $('#photo_change').attr('value', 'true');
            }

        });

        function adicionarPreco() {

            var id = $('#id_meal').val();
            var p = $('#value').val();
            var price_description = $('#price_description').val();
            //alert("adicionar preco "+id+" "+price+" "+price_description);
            //testeCadastroNovoPreco
            var price = p.replace(",", ".");
            if (isNaN(price)) {
                alert("Insira um preço correto!");
            } else {
                $.ajax({
                    type: "POST",
                    url: "./testeCadastroNovoPreco.php",
                    data: {"id": id, "price": price, "price_description": price_description},
                    success: function (data)
                    {
                        //alert(data);
                        $("#price_list").append(data);
                        $('#value').val("");
                        $('#price_description').val("");
                        //document.getElementById("teste").innerHTML = data;
                        //utilizar o dado retornado para alterar algum dado da tela.
                    }
                });
            }
        }

        function removerPreco(index) {
            //alert("remover preco");
            $("#price_item" + index).remove();
            //testeRemoverPreco
            $.ajax({
                type: "POST",
                url: "./testeRemoverPreco.php",
                data: {"id": index},
                success: function (data)
                {
                    //alert(data);
                    //document.getElementById("teste").innerHTML = data;
                    //utilizar o dado retornado para alterar algum dado da tela.
                }
            });
        }

        function setPriceVisibility(index, element) {
            var value = element.value;
            if (value == '1') {
                $(element).attr('value', '0');
                value = '0';
            } else {
                $(element).attr('value', '1');
                value = '1';
            }
            //testeAlterarVisibilidadeDoPreco
            //alert("alterou visibilidade! " + value)
            $.ajax({
                type: "POST",
                url: "./testeAlterarVisibilidadeDoPreco.php",
                data: {"id": index, "value": value},
                success: function (data)
                {
                    //alert(data);
                    //document.getElementById("teste").innerHTML = data;
                    //utilizar o dado retornado para alterar algum dado da tela.
                }
            });
        }

        function numberToReal(index, numero) {
            var numero = numero.toFixed(2).split('.');
            numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
            var price = numero.join(',');
            //alert("numero: "+price);
            document.getElementById("b" + index).innerHTML = price;
            return price;
        }
    </script>
</html>










