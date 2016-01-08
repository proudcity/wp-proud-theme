<?php

namespace Proud\Theme\Wrapper;

/**
 * Theme wrapper
 *
 * @link https://roots.io/proud/docs/theme-wrapper/
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */

function container_class() {
  global $proudcore;
  return $proudcore::$layout->post_is_full_width() ? 'full-width-container' : 'container';
}

function template_path() {
  return ProudWrapping::$main_template;
}

function sidebar_path() {
  return new ProudWrapping('templates/sidebar.php');
}

function sidebar_agency_path() {
  return new ProudWrapping('templates/sidebar-agency.php');
}

function agency_title() {
  global $pageInfo;
  $url = get_permalink( $pageInfo['agency'] );
  $title = get_the_title( $pageInfo['agency'] );
  return "<a href='$url' title='$title'>$title</a>";
}

class ProudWrapping {
  // Stores the full path to the main template file
  public static $main_template;

  // Basename of template file
  public $slug;

  // Array of templates
  public $templates;

  // Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
  public static $base;

  public function __construct($template = 'base.php') {
    $this->slug = basename($template, '.php');
    $this->templates = [$template];

    if (self::$base) {
      $str = substr($template, 0, -4);
      array_unshift($this->templates, sprintf($str . '-%s.php', self::$base));
    }
  }

  public function __toString() {
    $this->templates = apply_filters('proud/wrap_' . $this->slug, $this->templates);
    return locate_template($this->templates);
  }

  public static function wrap($main) {
    // Check for other filters returning null
    if (!is_string($main)) {
      return $main;
    }

    self::$main_template = $main;
    self::$base = basename(self::$main_template, '.php');

    if (self::$base === 'index') {
      self::$base = false;
    }

    return new ProudWrapping();
  }
}
add_filter('template_include', [__NAMESPACE__ . '\\ProudWrapping', 'wrap'], 109);
