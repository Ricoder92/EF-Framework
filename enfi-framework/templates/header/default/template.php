<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <!-- title -->
    <title><?php if(is_front_page() || is_home()) echo get_bloginfo('name'); else echo wp_title('|', true, 'right').get_bloginfo('name'); ?></title>
    <?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>>

<!-- Header -->
<div class="header-default d-none d-lg-block">
        <div class="container h-100">
            <div class="row align-items-center h-100">

                <div class="col-lg-2">
                    <div class="logo">
                       <?php ef_render_logo(); ?>
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="nav">
                        <nav><?php wp_nav_menu( array( 'theme_location' => 'header', 'menu' => 'header', 'menu_class' => 'header-menu-default') ); ?></nav>
                    </div>
                </div>

            </div>
        </div>
    </div>


<!-- sticky header -->
<div class="d-none d-lg-block">

    <div class="header-default toggle-header-sticky">

        <div class="container h-100">
            <div class="row align-items-center h-100">

                <div class="col-lg-2">
                    <div class="logo">
                    <?php ef_render_logo(); ?>
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="nav">
                        <nav><?php wp_nav_menu( array( 'theme_location' => 'header', 'menu' => 'header', 'menu_class' => 'header-menu-default') ); ?></nav>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>


<!-- Header mobile --> 
<div class="header-default-mobile d-block d-lg-none">

    <div class="container h-100">
        <div class="row align-items-center h-100">

            <div class="col-8">
                <div class="logo">
                <?php ef_render_logo(); ?>
                </div>
            </div>

            <div class="col-4">
                <div class="nav">
                    <i id="mobile-menu-toggle" class="fas fa-bars fa-2x"></i>
                </div>
            </div>

        </div>
    </div>

</div>

<div class="d-block d-lg-none">

    <div class="header-default-mobile-content">

        <div class="container h-100">
            <div class="row align-items-center h-100">

                <div class="col-12">
                    
                    <nav><?php wp_nav_menu( array( 'theme_location' => 'header', 'menu' => 'header', 'menu_class' => 'header-menu-default-mobile') ); ?></nav>
                
                </div>

            </div>
        </div>

    </div>

</div>