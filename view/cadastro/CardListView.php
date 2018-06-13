<?php
class CardListView{
    public function getCardListView(){
        include 'cardlist_elements/ProductCard.php';
        
        $productcard = new ProductCard();
        
        echo $productcard->getProductCard(1);
        echo $productcard->getProductCard(2);
    }
}
?>

