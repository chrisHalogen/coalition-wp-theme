<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ct-custom' ); ?></a>

	<header id="masthead" class="site-header">
        <div class="section-1">
            <div class="inner-section">
            <div class="top-left">
                <span>Call Now</span>
                <a href="tel:<?php echo ct_get_phone(); ?>"><?php echo ct_get_phone(); ?></a>
            </div>
            <div class="top-right">
                <a class="login-btn" href="#">LOGIN</a>
                <a href="#">SIGNUP</a>

            </div>
            </div>
        </div>
        <div class="section-2">
            <div class="inner-section" id="nav-container">
                <div class="logo-div">
                    
                    <?php
                    
                        if ( ct_get_theme_logo() ){
                            $logo_url = ct_get_theme_logo();
                            echo "<img src='$logo_url' alt='Logo' style='max-width: 60px;max-height:60px; margin-top: 50px; margin-bottom: 50px'>";
                        } else {
                            echo '<span class="left">YOUR</span><span>LOGO</span>';
                        }
                    
                    ?>
                    
                </div>

                <div class="menuToggle" id="menuToggle"></div>
                
                <?php
        
                $menu_id = 2;

                $args = array(
                    'menu_id' => $menu_id,
                    'container' => 'nav', 
                    'container_class' => 'menu',
                    'container_id' => 'nav-menu',
                    'menu_class' => 'menu-ul',
                );

                wp_nav_menu( $args );
                
                ?>

            </div>
        </div>

	<div id="content" class="site-content">
