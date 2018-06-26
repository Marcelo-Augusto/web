<?php
include('./connection/connection.php');

$id = $_POST['id'];
$price = $_POST['price'];
$price_description = $_POST['price_description'];

//echo "deu certo! " . $id . " " . $price . " " . $price_description;
$scriptSQL = "INSERT INTO `cardapio`.`price` (`description`, `price`, `id_meal`, `enable`) VALUES ( '" . $price_description . "', '" . $price . "', '" . $id . "', '1');";
    mysqli_query($conn, $scriptSQL);
    $index = mysqli_insert_id($conn);
?>

<li id="price_item<?php echo $index; ?>" class="list-group-item">
    <div class="row">
        <div class="col-sm-2">
            <p><b id="b<?php echo $index; ?>"><script>numberToReal(<?php echo $index; ?>, <?php echo $price; ?>);</script></b></p>
        </div>
        <div class="col-sm-6">
            <p><b><?php echo $price_description; ?></b></p>
        </div>

        <div class="col-sm-2">
            <span class="pull-right">
                <div class="form-group">
                    <div class="checkbox">
                        <label><input id="enable" name="enable" type="checkbox" value="1" checked onchange="setPriceVisibility(<?php echo $index; ?>, this)" >Tornar preço visível</label>
                    </div>
                </div>
            </span>
        </div>
        <div class="col-sm-2">
            <span class="pull-right"><div class="btn btn-default" onclick="removerPreco(<?php echo $index; ?>)">Remover</div></span>
        </div>
    </div> 
</li>

