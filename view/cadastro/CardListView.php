<?php

class CardListView {

    public function getCardListView() {
        include 'cardlist_elements/ProductCard.php';
        ?>
        <div id="product_card_list">
            <?php
            $productcard = new ProductCard();

            echo $productcard->getProductCard(1);
            echo $productcard->getProductCard(2);
            ?>
        </div>
            <?php
        }

    }
    ?>

