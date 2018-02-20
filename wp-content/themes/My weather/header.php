<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title>
        <?php echo wp_get_document_title(); ?>
    </title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
    <?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
<header class="header">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Weather</a>
            </div>
            <?php
            //show menu
             wp_nav_menu( array(
                    'theme_location'=>'top',
                    'menu_class'=>'nav navbar-nav',
                    'items_wrap' => ' <ul id="%1$s" class="%2$s">%3$s</ul>',
                    'menu_id' => ''
                ));
            ?>
        </div>
    </nav>
</header>
