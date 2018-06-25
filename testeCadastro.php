<?php
include('./connection/connection.php');
//
//    function transformaData($data_convencional)
//    {
//        $data_convertida = date('Y-m-d', strtotime($data_convencional));
//        return $data_convertida;
//    }
//
//    function retornaData($data_nao_convencional)
//    {
//        $data_convertida = date('d/m/Y', strtotime($data_nao_convencional));
//        return $data_convertida;
//    }
//
//    if(isset($_GET['editar']))
//    {
//        $scriptSQL = "SELECT * FROM `autores` where `id_Autor`='".$_GET[id]."';";
//        $result = $conn->query($scriptSQL);
//        $vetor=$result->fetch_object();
//    }
//
//    if(isset($_POST[salvar_dados]))
//    {
//        if($_POST[id_dados]!='')
//        {
//            // update
//            $scriptSQL="UPDATE `autores` 
//                        SET `nome` = '".$_POST[nome]."', 
//                            `Nome_Popular` = '".$_POST[nome_popular]."', 
//                            `Data_nascimento` = '".retornaData($_POST[data_nascimento])."' 
//                        WHERE `autores`.`id_Autor` = ".$_POST[id_dados].";";
//            $result = $conn->query($scriptSQL);
//            // redireciona à página da lista de autores
//            header("location: ./lista_autores.php");
//        }
//        else
//        {
//            // insert
//            $scriptSQL="INSERT INTO `disciplina`.`autores` 
//                           (`id_Autor`, 
//                            `nome`, 
//                            `Nome_Popular`, 
//                            `Data_nascimento`) 
//                        VALUES 
//                           (NULL, 
//                            '".$_POST[nome]."', 
//                            '".$_POST[nome_popular]."', 
//                            '".retornaData($_POST[data_nascimento])."');";
//            $result = $conn->query($scriptSQL);
//            // redireciona à página da lista de autores            
//            header("location: ./lista_autores.php");
//        }
//    }

if (isset($_POST[salvar_dados])) {
    echo "salvar dados";
    echo "<br>";
    echo "nome: " . $_POST[nome];
    echo "<br>";
    echo "descricao: " . $_POST[descricao];
    echo "<br>";
    if (isset($_FILES["file"]["type"])) {
        $validextensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);

        if (in_array($file_extension, $validextensions)) {
            if ($_FILES["file"]["error"] > 0) {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
            } else {
                /**/
                $novoNome = uniqid(time()) . '.' . $file_extension;
                $destino = 'upload /' . $novoNome;
                $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                //$targetPath = "upload/" . $_FILES['file']['name']; // Target path where file is to be stored
                move_uploaded_file($sourcePath, $destino); // Moving Uploaded file
                echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
                echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
                echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
                echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";

                if ($_POST[id_dados] != '') {
                    // update
                    $scriptSQL = "UPDATE `autores` 
                        SET `nome` = '" . $_POST[nome] . "', 
                            `Nome_Popular` = '" . $_POST[nome_popular] . "', 
                            `Data_nascimento` = '" . retornaData($_POST[data_nascimento]) . "' 
                        WHERE `autores`.`id_Autor` = " . $_POST[id_dados] . ";";
                    $result = $conn->query($scriptSQL);
                    // redireciona à página da lista de autores
                    header("location: ./lista_autores.php");
                } else {
                    // insert
                    $scriptSQL = "INSERT INTO `cardapio`.`meal` 
                           (`name`, 
                            `description`, 
                            `src_photo`) 
                        VALUES 
                           ( '" . $_POST[nome] . "', 
                            '" . $_POST[descricao] . "', 
                            '" . $novoNome . "');";
                    //$result = $conn->query($scriptSQL);
                    mysqli_query($conn, $scriptSQL);
                    $index = mysqli_insert_id($conn);
                    echo "new id: " . $index;
                    // redireciona à página da lista de autores            
                    //header("location: ./lista_autores.php");
                }
            }
        } else {
            echo "<span id='invalid'>***Invalid file Size or Type***<span>";
        }
    } else {
        echo "nao sei";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Teste Cadastro</title>

        <style>
            html{
                height:100%;
            }
            body {
                font-family: Arial, Helvetica, sans-serif;
                height:100%;
                background-color: #fcfcfc;
            }
            .center {
                
                margin: auto;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                width: 300px;
                
                background-color: #ccc;
                padding: 10px;
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                transition: 0.3s;
                border-radius: 5px;
            }

            input {
                width: 294px;
            }

            textarea {
                width: 294px;
                height: 40px;
                resize: none;
            }

            button {
                width: 147px;
            }
        </style>

    </head>
    <body>
        <div class="center">
            <form name="form" action="./testeCadastro.php" method="post" enctype="multipart/form-data">
                <div>
                    Nome: 
                    <br> 
                    <input type="text" name="nome" id="nome" value="<?php echo $vetor->nome; ?>" required="">
                </div>
                <br>
                <div>Descrição: 
                    <br> 
                    <textarea type="text" name="descricao" id="nome_popular" value="<?php echo $vetor->Nome_Popular; ?>"></textarea>
                </div>
                <br>
                <div>
                    Selecionar imagem: 
                    <br> 
                    <input type="file" name="file" id="file" />
                </div>
                <br>
                <?php
                if (isset($index)) {
                    ?>
                    <div class="container"> 
                        <button >tornar produto visível</button>
                        <button >remover produto</button>
                    </div>
                    <br>
                    <div>
                        <button>gerenciar preços</button>
                    </div>
                    <?php
                }
                ?>
                <br>
                <input type="hidden" value="<?php echo $vetor->id_Autor; ?>" name="id_dados">
                <div><input type="submit" name="salvar_dados" value="Salvar">
                </div>
            </form>
        </div>

    </body>
</html>










