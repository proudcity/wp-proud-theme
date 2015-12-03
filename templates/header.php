<header class="banner">
  <div id="navbar-external" class="navbar navbar-default navbar-external navbar-fixed-bottom" role="navigation">
    <ul id="logo-menu" class="nav navbar-nav">
      <li class="nav-logo">
        <a title="Home" rel="home" id="logo" href="<?= esc_url(home_url('/')); ?>"><img style="height:38px;" class="logo" src="http://dev.getproudcity.com/sites/default/files/inverted_logo/logo-icon-white.png" alt="Home" title="Home"></a>    
      </li>
      <li class="nav-text">
        <a title="Home" rel="home" href="<?= esc_url(home_url('/')); ?>"><strong><?php bloginfo('name'); ?></strong></a>
      </li>
    </ul>
    <div class="container-fluid menu-box">
      <div class="btn-toolbar pull-left" role="toolbar">
        <a data-proud-navbar="answers" href="#" class="btn navbar-btn faq-button proud-navbar-processed"><i class="fa fa-question-circle"></i> Answers</a>
        <a data-proud-navbar="payments" href="#" class="btn navbar-btn payments-button proud-navbar-processed"><i class="fa fa-credit-card"></i> Payments</a>
        <a data-proud-navbar="report" href="#" class="btn navbar-btn issue-button proud-navbar-processed"><i class="fa fa-wrench"></i> Issues</a>
      </div>
      <div class="btn-toolbar pull-right" role="toolbar">
        <a id="menu-button" href="#" class="btn navbar-btn menu-button proud-navbar-processed"><span class="hamburger">
          <span>toggle menu</span>
        </span></a>
        <a data-proud-navbar="search" href="#" class="btn navbar-btn search-btn proud-navbar-processed"><i class="fa fa-search"></i> <span class="text sr-only">Search</span></a>
      </div>
    </div>
    <?php
    if (has_nav_menu('primary_navigation')) :
      wp_nav_menu( [ 
        'theme_location'    => 'primary_navigation',
        'container'         => 'div',
        'container_class'   => 'below',
        'container_id'      => '',
        'menu_class'        => 'nav navbar-nav',
        'menu_id'           => 'main-menu',
        'echo'              => true,
        'fallback_cb'       => 'wp_page_menu',
        'before'            => '',
        'after'             => '',
        'link_before'       => '',
        'link_after'        => '',
        'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'             => 1,
        'walker'            => ''
      ] );
    endif;
    ?>
  </div>
  <div class="navbar navbar-header-region navbar-default">
    <div class="navbar-header"><div class="container">
      <h3>
        <a href="<?= esc_url(home_url('/')); ?>" title="Home" rel="home" id="logo"><img style="height:38px;" class="logo" src="http://dev.getproudcity.com/sites/default/files/inverted_logo/logo-icon-white.png" alt="Home" title="Home"></a>
        <a href="<?= esc_url(home_url('/')); ?>" title="Home" rel="home" class="navbar-brand"><strong><?php bloginfo('name'); ?></strong></a>
      </h3>
    </div></div>
  </div>
</header>
