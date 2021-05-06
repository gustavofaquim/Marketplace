<?php 

//Filtrando pedindo que sejam somente da loja
function filterItemsByStoreId($items, $storeId){
  
    return array_filter($items, function($line) use($storeId){
        return $line['store_id'] == $storeId;
    });  
}

//Formatando preço para salvar no banco
function formtPriceToDataBase($price){
    // 19,90  -> 19.90
    // 1.200,00 -> 1200.00
    
    return str_replace([' ','R$','.',','], ['','','','.'], $price);
}