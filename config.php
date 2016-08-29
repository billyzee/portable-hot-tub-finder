<?php
$site_location="http://www.portablehottubfinder.com";
$hostname = "localhost";
$username = "username";
$password = "password";
MySQL_connect("$hostname","$username","$password")or die(mysql_error());
MySQL_select_db("db_table") or die("Unable to select database");
//
if(!empty($_GET['value'])){
$_POST['search']="M-Spa Portable Hot Tub";	
}
$search_phrase= ucwords($_POST['search']);
date_default_timezone_set("Australia/Sydney");

if(!isset($_POST['search'])){
$kword = "Portable Hot Tub Search";
}
if(isset($_POST['search'])){
	///////
   function order_by_price($a, $b) {
  if ($a['price'] == $b['price']) {
        return 0;
    }
    return ($a['price'] < $b['price']) ? -1 : 1;
}
   ///////
   function order_by_discount($c, $d) {
  if ($c['discount'] == $d['discount']) {
        return 0;
    }
    return ($c['discount'] < $d['discount']) ? -1 : 1;
   }
	//$minprice=300;
$err="false";
////

if(empty( $_POST['minprice'])){
$minprice = 260;	
}

///	
if(str_word_count($search_phrase) > 1){
$brand = strtok($search_phrase, " ");//get first word in query..nominally the brand
$brandval = 2;

}
$brand =ucwords(strtolower($brand));
///
if(str_word_count($search_phrase) ==1){
$brand = $search_phrase;
$brandval = 1;	

}
///

if($brand=="Resin"){
	$minprice=1000;

}
////

////
if($brand=="M"){
	$brand="M-Spa";
	$amazon_brand = "M-Spa";
}
	if(substr($brand, 0, 5) == "M Spa"){
	$brand = "M-Spa";
	$amazon_brand =="M-Spa";
	$brandsearch= "M-Spa";
	}
	if(substr($brand, 0, 5) == "M-Spa"){
	$brand = "M-Spa";
		$amazon_brand = "M-Spa";
		$brandsearch= "M-Spa";
	}
	if(substr($brand, 0, 4) == "MSpa"){
	$brand = "M-Spa";
		$brandsearch = "M-Spa";
		$brandsearch= "M-Spa";
	}
		if(substr($brand, 0, 4) == "Mspa"){
	$brand = "M-Spa";
		$amazon_brand = "M-Spa";
		$brandsearch= "M-Spa";
	}

if($brand !="M-Spa"){
	$brand = strtok($search_phrase, " ");
$brandsearch= $brand;
$amazon_brand = $brand;
}
if($brand =="Canadian"){
	$brand = "Canadian Spa Company";
$brandsearch= $brand;
$amazon_brand = $brand;
}
//// set up checking for invalid query
$file = fopen("brands.csv","r");
$brands_array =(fgetcsv($file));
fclose($file);
$bad_search=$brandsearch;
$matches = array();
$matchFound = preg_match_all(
                "/\b(" . implode($brands_array,"|") . ")\b/i", 
                $bad_search, 
                $matches
              );

if ($matchFound) {
$brand_check="true";
}
if (!$matchFound) {
$brand_check="false";
	}

if($brand_check == "false"){
if($brandval ==1){
if (strpos($search_phrase,'Inflatable') !== false) {
$search_phrase = $brand." Hot Tub";	
}
if (strpos($search_phrase,'Portable') !== false) {
$search_phrase = $brand." Hot Tub";
}
if (strpos($search_phrase,'Spa') !== false) {
$search_phrase = "portable ".$brand." Hot Tub";
}
}
if($brandval >1){
if (strpos($search_phrase,'Portable') !== false) {
if (strpos($search_phrase,'Spa') !== false) {
$search_phrase = " Portable Spa";
}	
}
if (strpos($search_phrase,'Inflatable') !== false) {
if (strpos($search_phrase,'Spa') !== false) {
$search_phrase = " Inflatable Spa";
}
}
if (strpos($search_phrase,'Inflatable') !== false) {
if (strpos($search_phrase,'Tub') !== false) {
$search_phrase = " Inflatable Hot Tub";
}
}
}


if($brand_check == "true"){
if($brand == "Comfort"){
$brand = "Comfort Line";	
}

if($brand == "Strong"){
$brand = "Strong Spas";	
}
if($brand == "Swim"){
$brand = "Swim Spas";	
}

if($brandval ==1){
$search_phrase = $brand;
}
}
$kword = $search_phrase;
}
}
   ///

/////////////                                  sets up search phrase when option is page

$search_val = $search_phrase;
$title_search = $search_val;
///////
$meta_var = $_GET['page'];

///
if(!isset($_POST['search']) && !isset($_GET['page']) ){
$title_tag = "Portable Hot Tub Search";
//$search_val = "Portable Hot Tub";
$meta_tag = "Search from multiple stores for the cheapest price on any portable hot tub, spa or jacuzzi. Get up to 50% discount on selected portable hot tubs";
$canonical ="<link rel=\"canonical\" href=\"http://www.portablehottubfinder.com\" />\n";
}
if(!isset($_POST['search']) && isset($_GET['page']) ){
$meta_data = mysql_query( "SELECT * FROM meta WHERE meta_tag = '$meta_var' " )or die(mysql_error());
$row = mysql_fetch_array( $meta_data );
$meta_tag = $row['meta_desc'];	
$title_tag = $row['title_tag'];
}
if(isset($_POST['search']) ){
$title_tag = $search_phrase." Search";
$meta_tag = "Search from multiple stores for the cheapest price on ".$search_phrase."s. Daily Discounts up to 50% on ".$search_phrase."s";

}
//////

$tblName="search";
	//if(isset( $_POST['minprice'])){
	//$minprice = $_POST['minprice'];	
	//if($minprice > 5009){
	//$err = "true";	
	//}
	//}


$minprice =(int)$minprice;
// check search query
$brands = file_get_contents("brands.txt");
//$search_phrase = ucwords($search_phrase);//capitilize first letter of each word
$master_search =$search_phrase;



$numwords= str_word_count($search_phrase);

if($numwords>1){ 
$word = strstr($search_phrase, ' ', true);//get first word in query..nominally the brand
}
if($numwords==1){
$word = $search_phrase;//get first word in query..nominally the brand
}
//check for unwanted words


//
$badwords_array = array("anal","anus","arse","ass","ballsack","balls","bastard","bitch","biatch","bloody","blowjob","blow job","bollock","bollok","boner","boob","bugger","bum","butt","buttplug","clitoris","cock","coon","crap","cunt","damn","dick","dildo","dyke","fag","feck","fellate","fellatio","felching","fuck","f u c k","fudgepacker","fudge packer","flange","Goddamn","God damn","hell","homo","jerk","jizz","knobend","knob end","labia","lmao","lmfao","muff","nigger","nigga","omg","penis","piss","poop","prick","pube","pussy","queer","scrotum","sex","shit","s hit","sh1t","slut","smegma","spunk","tit","tosser","turd","twat","vagina","wank","whore","wtf","tits","wanker","boobs");
//print_r($badwords_array);
$bad_search=strtolower($search_phrase);
$matches = array();
$matchFound = preg_match_all(
                "/\b(" . implode($badwords_array,"|") . ")\b/i", 
                $bad_search, 
                $matches
              );

if ($matchFound) {
  //$err="true";
  $badlang="true";
  $kword = "Portable Hot Tub";	
}
if (!$matchFound) {
  //$err="true";
  $badlang="false";
}
//// set up checking for invalid query



/////////// set up console widgets
$latest = mysql_query( "SELECT DISTINCT query FROM search ORDER BY query_time DESC LIMIT 5" )or die(mysql_error());
$x = 0;
while($row = mysql_fetch_array( $latest )) {
$latest_query[$x] = $row['query'];	
$latest_condition[$x] = $row['list_type'];
$x++;
}

$pop = mysql_query( "SELECT query FROM search ORDER BY query_num DESC LIMIT 5" )or die(mysql_error());
$num = mysql_num_rows($result_event);
$x = 0;
while($row = mysql_fetch_array( $pop )) {
$popular_query[$x] = $row['query'];
$popular_condition[$x] = $row['list_type'];	
$x++;
}


?>