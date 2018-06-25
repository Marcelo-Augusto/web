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
                    <div class="text-center">
                        <a href="./testeListaCadastro.php" class="btn btn-default">Lista de produtos</a>
                        <button type="submit" class="btn btn-primary" name="remover_produto" value="remover">Remover</button>
                        <button type="submit" class="btn btn-primary" name="editar_dados" value="editar">Salvar</button>
                    </div>

                </form>
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
    </script>
</html>










