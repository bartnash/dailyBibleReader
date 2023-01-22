<?php
/*
Plugin Name: Daily Bible Reader
Plugin URI: http://wscoc.com/
Description: Daily Bible Reader
Author: Bart Nash
Version: 0.1
*/

add_action( 'init', 'dbresv_register_reader' );

function dbresv_register_reader() {
add_shortcode( 'dbresv', 'dbresv_reader' );
}

function dbresv_simple( $atts = [], $content = null, $tag = '' ){
	// normalize attribute keys, lowercase
	$atts = array_change_key_case( (array) $atts, CASE_LOWER );
    return "<div id=\"reader\"> Hello, reader. Token :".$atts['auth-token']."  </div>";
}

function dbresv_reader( $atts = [], $content = null, $tag = '' ){

	// normalize attribute keys, lowercase
	$atts = array_change_key_case( (array) $atts, CASE_LOWER );

	
	$scriptures = [
"Gen+1‐3","Gen+4‐7","Gen+8‐11","Job+1‐5","Job+6‐9","Job+10‐13","Job+14‐16",
"Job+17‐20","Job+21‐23","Job+24‐28","Job+29‐31","Job+32‐34","Job+35‐37","Job+38‐39",
"Job+40‐42","Gen+12‐15","Gen+16‐18","Gen+19‐21","Gen+22‐24","Gen+25‐26","Gen+27‐29",
"Gen+30‐31","Gen+32‐34","Gen+35‐37","Gen+38‐40","Gen+41‐42","Gen+43‐45","Gen+46‐47",
"Gen+48‐50","Ex+1‐3","Ex+4‐6","Ex+7‐9","Ex+10‐12","Ex+13‐15","Ex+16‐18",
"Ex+19‐21","Ex+22‐24","Ex+25‐27","Ex+28‐29","Ex+30‐32","Ex+33‐35","Ex+36‐38",
"Ex+39‐40","Lev+1‐4","Lev+5‐7","Lev+8‐10","Lev+11‐13","Lev+14‐15","Lev+16‐18",
"Lev+19‐21","Lev+22‐23","Lev+24‐25","Lev+26‐27","Num+1‐2","Num+3‐4","Num+5‐6",
"Num+7","Num+8‐10","Num+11‐13","Num+14‐15;Ps+90","Num+16‐17","Num+18‐20","Num+21‐22",
"Num+23‐25","Num+26‐27","Num+28‐30","Num+31‐32","Num+33‐34","Num+35‐36","Deut+1‐2",
"Deut+3‐4","Deut+5‐7","Deut+8‐10","Deut+11‐13","Deut+14‐16","Deut+17‐20","Deut+21‐23",
"Deut+24‐27","Deut+28‐29","Deut+30‐31","Deut+32‐34;Ps+91","Josh+1‐4","Josh+5‐8","Josh+9‐11",
"Josh+12‐15","Josh+16‐18","Josh+19‐21","Josh+22‐24","Judg+1‐2","Judg+3‐5","Judg+6‐7",
"Judg+8‐9","Judg+10‐12","Judg+13‐15","Judg+16‐18","Judg+19‐21","Ruth+1‐4","1Sam+1‐3",
"1Sam+4‐8","1Sam+9‐12","1Sam+13‐14","1Sam+15‐17","1Sam+18‐20;Ps+11;Ps+59","1Sam+21‐24","Ps+7;Ps+27;Ps+31;Ps+34;Ps+52",
"Ps+56;Ps+120;Ps+140‐142","1Sam+25‐27","Ps+17;Ps+35;Ps+54;Ps+63","1Sam+28‐31;Ps+18","Ps+121;Ps+123‐125;Ps+128‐130","2Sam+1‐4","Ps+6;Ps+8‐10;Ps+14;Ps+16;Ps+19;Ps+21",
"1Chr+1‐2","Ps+43‐45;Ps+49;Ps+84‐85;Ps+87","1Chr+3‐5","Ps+73;Ps+77‐78","1Chr+6","Ps+81;Ps+88;Ps+92‐93","1Chr+7‐10",
"Ps+102‐104","2Sam+5:1‐10;1Chr+11‐12","Ps+133","Ps+106‐107","2Sam+5:11‐6:23;1Chr+13‐16","Ps+1‐2;Ps+15;Ps+22‐24;Ps+47;Ps+68","Ps+89;Ps+96;Ps+100;Ps+101;Ps+105;Ps+132",
"2Sam+7;1Chr+17","Ps+25;Ps+29;Ps+33;Ps+36;Ps+39","2Sam+8‐9;1Chr+18","Ps+50;Ps+53;Ps+60;Ps+75","2Sam+10;1Chr+19;Ps+20","Ps+65‐67;Ps+69‐70","2Sam+11‐12;1Chr+20",
"Ps+32;Ps+51;Ps+86;Ps+122","2Sam+13‐15","Ps+3‐4;Ps+12‐13;Ps+28;Ps+55","2Sam+16‐18","Ps+26;Ps+40;Ps+58;Ps+61‐62;Ps+64","2Sam+19‐21","Ps+5;Ps+38;Ps+41‐42",
"2Sam+22‐23;Ps+57","Ps+95;Ps+97‐99","2Sam+24;1Chr+21‐22;Ps+30","Ps+108‐110","1Chr+23‐25","Ps+131;Ps+138‐139;Ps+143‐145","1Chr+26‐29;Ps+127",
"Ps+111‐118","1Kgs+1‐2;Ps+37;Ps+71;Ps+94","Ps+119:1‐88","1Kgs+3‐4;2Chr+1;Ps+72","Ps+119:89‐176","Sng+1‐8","Prov+1‐3",
"Prov+4‐6","Prov+7‐9","Prov+10‐12","Prov+13‐15","Prov+16‐18","Prov+19‐21","Prov+22‐24",
"1Kgs+5‐6;2Chr+2‐3","1Kgs+7;2Chr+4","1Kgs+8;2Chr+5","2Chr+6‐7;Ps+136","Ps+134;Ps+146‐150","1Kgs+9;2Chr+8","Prov+25‐26",
"Prov+27‐29","Eccl+1‐6","Eccl+7‐12","1Kgs+10‐11;2Chr+9","Prov+30‐31","1Kgs+12‐14","2Chr+10‐12",
"1Kgs+15:1‐24;2Chr+13‐16","1Kgs+15:25‐16:34;2Chr+17","1Kgs+17‐19","1Kgs+20‐21","1Kgs+22;2Chr+18","2Chr+19‐23","Obad;Ps+82‐83",
"2Kgs+1‐4","2Kgs+5‐8","2Kgs+9‐11","2Kgs+12‐13;2Chr+24","2Kgs+14;2Chr+25","Jonah+1‐4","2Kgs+15;2Chr+26",
"Isa+1‐4","Isa+5‐8","Amos+1‐5","Amos+6‐9","2Chr+27;Isa+9‐12","Mic+1‐7","2Chr+28;2Kgs+16‐17",
"Isa+13‐17","Isa+18‐22","Isa+23‐27","2Kgs+18:1‐8;2Chr+29‐31;Ps+48","Hos+1‐7","Hos+8‐14","Isa+28‐30",
"Isa+31‐34","Isa+35‐36","Isa+37‐39;Ps+76","Isa+40‐43","Isa+44‐48","2Kgs+18:9‐19:37;Ps+46;Ps+80;Ps+135","Isa+49‐53",
"Isa+54‐58","Isa+59‐63","Isa+64‐66","2Kgs+20‐21","2Chr+32‐33","Nahum+1‐3","2Kgs+22‐23;2Chr+34‐35",
"Zeph+1‐3","Jer+1‐3","Jer+4‐6","Jer+7‐9","Jer+10‐13","Jer+14‐17","Jer+18‐22",
"Jer+23‐25","Jer+26‐29","Jer+30‐31","Jer+32‐34","Jer+35‐37","Jer+38‐40;Ps+74;Ps+79","2Kgs+24‐25;2Chr+36",
"Hab+1‐3","Jer+41‐45","Jer+46‐48","Jer+49‐50","Jer+51‐52","Lam+1:1‐3:36","Lam+3:37‐5:22",
"Ezek+1‐4","Ezek+5‐8","Ezek+9‐12","Ezek+13‐15","Ezek+16‐17","Ezek+18‐19","Ezek+20‐21",
"Ezek+22‐23","Ezek+24‐27","Ezek+28‐31","Ezek+32‐34","Ezek+35‐37","Ezek+38‐39","Ezek+40‐41",
"Ezek+42‐43","Ezek+44‐45","Ezek+46‐48","Joel+1‐3","Dan+1‐3","Dan+4‐6","Dan+7‐9",
"Dan+10‐12","Ezra+1‐3","Ezra+4‐6;Ps+137","Hag+1‐2","Zech+1‐7","Zech+8‐14","Est+1‐5",
"Est+6‐10","Ezra+7‐10","Neh+1‐5","Neh+6‐7","Neh+8‐10","Neh+11‐13;Ps+126","Mal+1‐4",
"Luke+1;John+1:1‐14","Matt+1;Luke+2:1‐38","Matt+2;Luke+2:39‐52","Matt+3;Mark+1;Luke+3","Matt+4;Luke+4‐5;John+1:15‐51","John+2‐4","Mark+2",
"John+5","Matt+12:1‐21;Mark+3;Luke+6","Matt+5‐7","Matt+8:1‐13;Luke+7","Matt+11","Matt+12:22‐50;Luke+11","Matt+13;Luke+8",
"Matt+8:14‐34;Mark+4‐5","Matt+9‐10","Matt+14;Mark+6;Luke+9:1‐17","John+6","Matt+15;Mark+7","Matt+16;Mark+8;Luke+9:18‐27","Matt+17;Mark+9;Luke+9:28‐62",
"Matt+18","John+7‐8","John+9:1‐10:21","Luke+10‐11;John+10:22‐42","Luke+12‐13","Luke+14‐15","Luke+16‐17:10",
"John+11","Luke+17:11‐18:14","Matt+19;Mark+10","Matt+20‐21","Luke+18:15‐19:48","Mark+11;John+12","Matt+22;Mark+12",
"Matt+23;Luke+20‐21","Mark+13","Matt+24","Matt+25","Matt+26;Mark+14","Luke+22;John+13","John+14‐17",
"Matt+27;Mark+15","Luke+23;John+18‐19","Matt+28;Mark+16","Luke+24;John+20‐21","Acts+1‐3","Acts+4‐6","Acts+7‐8",
"Acts+9‐10","Acts+11‐12","Acts+13‐14","Jas+1‐5","Acts+15‐16","Gal+1‐3","Gal+4‐6",
"Acts+17‐18:18","1Thes+1‐5;2Thes+1‐3","Acts+18:19‐19:41","1Cor+1‐4","1Cor+5‐8","1Cor+9‐11","1Cor+12‐14",
"1Cor+15‐16","2Cor+1‐4","2Cor+5‐9","2Cor+10‐13","Acts+20:1‐3;Rom+1‐3","Rom+4‐7","Rom+8‐10",
"Rom+11‐13","Rom+14‐16","Acts+20:4‐23:35","Acts+24‐26","Acts+27‐28","Col+1‐4;Phm","Eph+1‐6",
"Phil+1‐4","1Tim+1‐6","Titus+1;Titus+2;Titus+3","1Pet+1-2;1Pet3-4;1Pet+5","Heb+1‐6","Heb+7‐10","Heb+11‐13",
"2Tim+1‐4","2Pet+1;2Pet+2;2Pet+3;Jude","1jn+1-2;1jn+3-4;1jn+5","2Jn;3Jn","Rev+1‐5","Rev+6‐11","Rev+12‐18",
"Rev+19‐22",
"Jude", "Deut+32-34", "Esther+6-10", "Ps+149-150", "Song+7-8", "Rev+18-22", "Acts+27-28"
	];

	$url = "https://api.esv.org/v3/passage/html/?";

	$index = 0;
	if (!empty($_GET["z"])){
		$index = $_GET["z"];
	} else {
		$index = date("z");
	}
	
	if(!empty($_GET["q"])){
		$arg = str_replace(" ", "+", $_GET["q"]);
		$url .= "q=".$arg;
	} else {
		$url .= "q=".$scriptures[$index];
	}

	//$url .= "&include-surrounding-chapters=true";
	$headers = [
	'Content-Type: text/html',
        'Authorization: Token '.$atts['auth-token']
];

  	$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($curl);

    curl_close($curl);

	$json = json_decode($result, true);
	$passages = $json['passages'];
	$passage = $passages[0];

	global $wp;
	$queried_id = get_queried_object_id();
	$current_url = get_permalink( $queried_id );

	$retval = "<div id=\"reader\">";

        $retval .= '<a href="'.$current_url.'&z='.($index - 1).'">Previous</a> - ';
        $retval .= '<a href="'.$current_url.'&z='.($index + 1).'">Next</a>';

	foreach ($passages as $passage) {
          $retval .= $passage;
        }
	$retval .= "</div>";

	return $retval;



}

?>
