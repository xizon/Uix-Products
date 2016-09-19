<?php
/** Sets up the WordPress Environment. */
header( 'Content-Type:text/html;charset=utf-8' );
require '../../../../wp-load.php';


echo UixProducts::theme_list();