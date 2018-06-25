<?php
include('./connection/connection.php');

if (isset($_POST[salvar_dados])) {

    if (isset($_FILES["file"]["type"])) {
        $validextensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);

        if (in_array($file_extension, $validextensions)) {
            if ($_FILES["file"]["error"] > 0) {
                
            } else {

                $novoNome = uniqid(time()) . '.' . $file_extension;
                $destino = 'upload /' . $novoNome;
                $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable

                move_uploaded_file($sourcePath, $destino); // Moving Uploaded file
            }
        }
    }

    $scriptSQL = "INSERT INTO `cardapio`.`meal` (`name`, `description`, `src_photo`, `enable`, `id_category`) VALUES ( '" . $_POST[nome] . "', '" . $_POST[descricao] . "', '" . $novoNome . "', 'T', '" . $_POST[id_category] . "');";
    mysqli_query($conn, $scriptSQL);
    $index = mysqli_insert_id($conn);
    $name_category = $_POST[name_category];
} else {
    $name_category = $_GET[name_category];
    $scriptCategory = "SELECT * FROM `category` WHERE name = '" . $name_category . "' ";
    $resultCategory = $conn->query($scriptCategory);
    $category = $resultCategory->fetch_object();
    $id_category = $category->id_category;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Teste Cadastro Com Boostrap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>

        <?php
        if (!isset($index)) {
            ?>
            <div class="container">

                <form name="form" class="form-horizontal" action="./testeCadastroProdutoComBootstrap.php" method="post" enctype="multipart/form-data">
                    <div class="text-center">
                        <h2>Cadastrar novo produto</h2>
                        <p>Preencha os campos abaixo para cadastrar um novo produto.</p>
                    </div>
                    <div class="form-group">
                        <label for="usr">Nome do produto:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira o nome do produto aqui" required="">
                    </div>
                    <div class="form-group">
                        <label for="comment">Descrição do produto:</label>
                        <textarea type="text" name="descricao" class="form-control" rows="5" id="description" value="" placeholder="Insira a descrição do produto aqui"></textarea>
                    </div>
                    <div class="form-group">
                        <img id="meal_photo" class="img-rounded" width="304" height="236">
                        <br>
                        <label for="comment">Selecionar Imagem:</label>
                        <input type="file" name="file" id="file" />
                    </div>
                    <div class="form-group">
                        <input type="hidden" value="<?php echo $id_category; ?>" id="id_category" name="id_category">
                        <input type="hidden" value="<?php echo $name_category; ?>" id="name_category" name="name_category">
                    </div>
                    <div class="text-center">
                        <a href="./testeListaCadastro.php" class="btn btn-default">Cancelar</a>
                        <button type="submit" class="btn btn-primary" name="salvar_dados" value="Salvar">Salvar</button>
                    </div>

                </form>
            </div>
            <?php
        } else {
            ?>

            <div class="container text-center">
                <h2>O produto <?php echo $_POST[nome]; ?> foi cadastrado com sucesso! </h2>
                <p>Um novo produto foi cadastrado. Selecione uma das opções abaixo.</p>
                <br>
                <div class="text-center">
                    <a href="./testeListaCadastro.php" class="btn btn-default">Lista de produtos</a>
                    <a href="./testeCadastroProdutoComBootstrap.php?name_category=<?php echo $name_category; ?>" class="btn btn-default">Cadastrar novo produto</a>
                </div>
            </div>

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
            }

        });
    </script>
</html>










