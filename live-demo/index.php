<?php
/** Sets up the WordPress Environment. */
header( 'Content-Type:text/html;charset=utf-8' );
require '../../../../wp-load.php';

$demopath = UixProducts::plug_directory().'live-demo/';

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
    <title><?php echo get_bloginfo( 'name', 'display' ); ?> | <?php _e( 'Demos', 'uix-products' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<script src="<?php echo $demopath; ?>js/modernizr.min.js?ver=3.3.1"></script>
	<script>if ( top !== self ) top.location.replace( self.location.href );</script>
    <link rel="stylesheet" href='<?php echo $demopath; ?>css/bootstrap.min.css?ver=3.3.7' type='text/css' media='all' />
    <link rel="stylesheet" href='<?php echo $demopath; ?>css/template.css' type='text/css' media='all' />
	<link href="<?php echo $demopath; ?>css/font-awesome.css?ver=4.5.0" rel="stylesheet">
    <!--[if lt IE 9]>
    <script type='text/javascript' src='<?php echo $demopath; ?>js/respond.min.js?ver=1.4.2'></script>
    <![endif]-->
    
</head>
	
<body>

    <!-- Header -->
    <header class="switcher-bar clearfix">
    
        <!-- Logo -->
        <div class="logo textual fa-pull-left">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                <?php
				$logo_url = false;
				if ( function_exists( 'the_custom_logo' ) ) {
					ob_start();
						the_custom_logo();
						$logo_wp = ob_get_contents();
					ob_end_clean();
					
					$pattern = '/<img.+src=\"(.*?)\".+>/i';
					$matchCount = preg_match( $pattern, $logo_wp, $match ); 
					if ( $matchCount > 0 ) {
						echo '<img src="'.esc_url( $match[ 1 ] ).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" />';
						$logo_url = true;
					}
				
				} else {
					if ( !empty( get_theme_mod( 'theme_extra_custom_logo' ) ) ) {
						echo '<img src="'.esc_url( get_theme_mod( 'theme_extra_custom_logo' ) ).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" />';
						$logo_url = true;
	
					}
				}
				
				if ( !$logo_url ) {
					bloginfo( 'name' );
				}
				
				?>
            </a>
        </div>
    
        <!-- Product Switcher -->
        <div class="product-switcher fa-pull-left">
            <a href="#" title="Select a Theme">
                Select a Theme <span>+</span>
            </a>
        </div>
    
        <!-- Bar Remove Button -->
        <div class="remove-btn header-btn fa-pull-right">
            <a href="#" title="Close this bar" class="fa fa-remove"></a>
        </div>
    
        <!-- Purchase Button -->
        <div class="purchase-btn header-btn fa-pull-right">
            <a href="#" title="Download" class="fa fa-download"></a>
        </div>
    
        <!-- Mobile Button -->
        <div class="mobile-btn header-btn fa-pull-right hidden-xs">
            <a href="#" title="Smartphone View" class="fa fa-mobile-phone"></a>
        </div>
    
        <!-- Tablet Button -->
        <div class="tablet-btn header-btn fa-pull-right hidden-xs">
            <a href="#" title="Tablet View" class="fa fa-tablet"></a>
        </div>
    
        <!-- Desktop Button -->
        <div class="desktop-btn header-btn fa-pull-right hidden-xs">
            <a href="#" title="Desktop View" class="fa fa-desktop"></a>
        </div>
    
    </header>
    
    <!-- Products List -->
    <section class="switcher-body">
    
        <a href="#" title="Prev" class="fa fa-angle-left products-prev"></a>
    
        <div class="products-wrapper">
            <div class="products-list clearfix">
    
            </div>
        </div>
    
        <a href="#" title="Next" class="fa fa-angle-right products-next"></a>
    
    </section>
    
    
    <!-- Product iframe -->
    <iframe class="product-iframe" frameborder="0" border="0"></iframe>

    <!-- Javascript -->
	<script type="text/javascript" src="<?php echo $demopath; ?>js/jquery.min.js?ver=1.11.3"></script>
    <script type="text/javascript" src="<?php echo $demopath; ?>js/jquery.migrate.min.js?ver=1.2.1"></script>
	<script type="text/javascript">
        document.write('<scr'+'ipt src="themes-list.php?'+Math.random()+'" type="text/javascript"></scr'+'ipt>');
    </script>
	<script src="<?php echo $demopath; ?>js/script.js"></script>
   
   <?php if ( !empty( get_theme_mod( 'custom_google_analytics' ) ) ) { ?>
       <!-- Google analytics begin  --> 
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        
          ga('create', '<?php echo esc_attr( get_theme_mod( 'custom_google_analytics' ) );?>', 'auto');
          ga('send', 'pageview');
        
        </script>
        <!-- Google analytics end  -->
    <?php } ?>


</body>
</html>
