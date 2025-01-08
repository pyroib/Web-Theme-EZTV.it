<?
	$SETTING										=	parse_ini_file( "eztv_globals.ini" );
	
	print_r($SETTING);

	die();
	
	
	
	
	
	
	$TRIGGER										=	$SETTING['TRIGGERFILE'] . date( $SETTING['TRIGGERFORMAT'] ) . $SETTING['TRIGGEREXT'];
	$MOVEFILES										=	false;
	if ( is_dir( $SETTING['BARREL'] ) ) {													//	if the dir exists that was set in the INI file proceed
		$handle										=	opendir( $SETTING['BARREL'] );		//	open the DIR that was set in the INI file
		while ( false !== ( $file = readdir( $handle ) ) ) {								//	if you can read files in the DIR, do it in a loop and process it
			if ( $file == $TRIGGER ) {														//	if we find the trigger file
				$MOVEFILES							=	true;								//	set the handle to true
			}
		}
	} else {
		echo "Can't find directory set in go_globals.ini \n";
	}
	if( $MOVEFILES ) {
		$handle										=	opendir( $SETTING['BARREL'] );		//	open the DIR that was set in the INI file
		while ( false !== ( $file = readdir( $handle ) ) ) {								//	if you can read files in the DIR, do it in a loop and process it
			if ( $file != $TRIGGER && $file != "." && $file != ".." ) {						//	if the files is not a directory change or the trigger then move it
				copy( $SETTING["BARREL"] . $file, $SETTING["TARGET"] . $file );				//	copy the file to a keep folder
				unlink( $SETTING["BARREL"] . $file );										//	delete file from original location
			}
		}
		unlink( $SETTING["BARREL"] . $TRIGGER );											//	delete the trigger file
	} else {
		echo "No Trigger File \n";
	}
?>