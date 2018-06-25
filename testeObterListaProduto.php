<?php
include('./connection/connection.php');
//echo "deu certo! ".$_POST['data'];

$scriptCategory = "SELECT * FROM `category` WHERE name = '".$_POST['data']."' ";
$resultCategory = $conn->query($scriptCategory);
$category = $resultCategory->fetch_object();

$scriptSQL = "SELECT * FROM `meal` WHERE id_category = ".$category->id_category;
$result = $conn->query($scriptSQL);
while ($vetor = $result->fetch_object()) {
    $photo = "./upload/" . $vetor->src_photo;
    ?>
    <a href="./testeEditarProdutoComBootstrap.php?editar=1&id=<?php echo $vetor->id_meal; ?>" class="list-group-item"><?php echo $vetor->name; ?></a>
    <?php
}
?>

