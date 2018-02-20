<!-- off-canvas title bar for 'small' screen -->
<div class="title-bar" data-responsive-toggle="widemenu" data-hide-for="large">
  <div class="title-bar-left">
    <button class="menu-icon" type="button" data-open="offCanvasLeft"></button>
  </div>
  <div class="title-bar-logo">
      <span class="title-bar-title"><a href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/CW-logo-white.svg"/></a></span>
  </div>

</div>

<!-- off-canvas left menu -->
<div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>
  <?php if ( has_nav_menu( 'mobile' ) ) : ?>
          <nav id="site-navigation" role="navigation" arialabel="<?php esc_attr_e(' Primary Menu', 'creativewhy'); ?>">
              <?php
                  wp_nav_menu( array(
                      'theme_location' => 'mobile',
                      'items_wrap'     => '<ul class="vertical menu"><li id="item-id"></li>%3$s</ul>',
                      'walker' => new CW_Walker_Nav_Menu()
                   ) );
              ?>
          </nav>
  <?php endif; ?>

</div>

<!-- "wider" top-bar menu for 'medium' and up -->
<div data-sticky-container>
    <div data-sticky data-options="marginTop:0;" style="width:100%">
<div id="widemenu" class="top-bar">
  <div class="top-bar-left">
    <div class="wide-logo-wrapper">
      <a href="<?php echo get_bloginfo('url'); ?>"><img class="wide-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/CW-logo-white.svg"/></a></li>
    </div>
    <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <nav id="site-navigation" role="navigation" arialabel="<?php esc_attr_e(' Primary Menu', 'creativewhy'); ?>">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'items_wrap'     => '<ul class="menu main-navigation"><li id="item-id"></li>%3$s</ul>',
                        // 'walker' => new CW_Walker_Nav_Menu()
                     ) );
                ?>
            </nav>
    <?php endif; ?>
  </div>
  <div class="top-bar-right">
    <a href="/connect-with-us" class="button primary round">CONNECT WITH US</a>
  </div>
</div>

</div>
</div>
