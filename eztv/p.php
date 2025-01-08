<?
	
	$store = "g:\\";
	
	$showlistURL = "http://eztv.it/showlist/";
	
	$showlistHTML = file_get_contents( $showlistURL );
	
	$showlistHTML = str_replace( array( "<b>", "</b>" ) , "", $showlistHTML );
	
	$dom = new DOMDocument();
	
	@$dom->loadHTML( $showlistHTML );
	
	$xpath = new DOMXPath( $dom );
	
	$elements = $xpath->query("*/a[@class=\"thread_link\"]");
	
	foreach ( $elements as $element ) {
		echo "\n[". $element->nodeValue. "]";
	}
	

?>