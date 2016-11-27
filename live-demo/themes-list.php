<?php
/** Sets up the WordPress Environment. */
header( 'Content-Type:application/x-javascript;charset=utf-8' );
require '../../../../wp-load.php';


echo UixProducts::theme_list();