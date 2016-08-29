<?php

///             +++++++++++++++============== include seperate search engines
include('amazon.php');
include('ebay.php');
include('prosper.php');

/////////
//echo "Ebay Total = ".$ebay_total;
//echo "<br>";
//echo $search_phrase;//"prosperent Total = ".$prosperent_total;
//echo "<br>";
  /////////////////////////////////end amazon
//////////////////////////////////////////////////////////////////////////////////////////
$total_products =$prosperent_total+$amazon_total+$ebay_total;
//////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($total_products > 0){

$product_array = array();

if(count($amazon_array) > 0){
$product_array = $amazon_array;	
}

if(count($prosperent_array) > 0){
	if(count($product_array) < 1){
$product_array = $prosperent_array;	
	}
	if(count($product_array) > 0 ){
$product_array = array_merge($product_array,$prosperent_array);	
	}
}
if(count($ebay_array) > 0){
	if(count($product_array) > 0){
$product_array = array_merge($product_array,$ebay_array);	
	}
	if(count($product_array) < 1){
$product_array = $ebay_array;	
	}
}

}
////
//print_r($prosperent_array);
////


//print_r($amazon_data);
usort($product_array,order_by_price);
$newArray = array();
$usedFruits = array();
foreach ( $product_array AS $line ) {
if ( !in_array($line['price'], $usedFruits) ) {
        $usedFruits[] = $line['price'];
        $newArray[] = $line;
    }
}
$product_array = $newArray;

//echo "<br>";
//echo "===============--";
//echo "<br>";
//echo "Total Products = ".$total_products;
//echo "<br>";
//echo "Product Array Number = ".count($product_array);

//include('test.php');
//print_r($prosperent_array);
//print_r($amazon_array);
//print_r($product_array);
///////////////////////////////////////////////////////

?>