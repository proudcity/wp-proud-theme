<?php

namespace Proud\Theme\Teaser;

if ( !class_exists( 'TeaserOptions' ) ) {

  // Sets up options for listing on pages
  class TeaserOptions {

    private static $fields = [];

    function __construct() {
      // Set Fields
      self::$fields =  [
        'proud_teaser_content' => [
          'title' => __('Content Type', 'proud-teaser'),
          'options' => [
            'post' => __('News', 'proud-teaser'),
            'agencies' => __('Agencies', 'proud-teaser'),
          ]
        ],
        'proud_teaser_display' => [
          'title' => __('Teaser Display Mode', 'proud-teaser'),
          'options' => [
            'list' => __('List View', 'proud-teaser'),
            'mini' => __('Mini List', 'proud-teaser'),
            'cards' => __('Card View', 'proud-teaser'),
          ]
        ]
      ];
      // Actions
      add_action( 'admin_init', array( $this, 'add_teaser_options' ) );
      add_action( 'save_post', array( $this, 'on_save' ) );
      add_action( 'delete_post', array( $this, 'on_delete' ) );
    }

    public function add_teaser_options()
    {

      $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
      $template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
      // d($template_file);
      // check for a template type
      if ( strpos( $template_file, 'teasers.php' ) > 0 ) {
        add_meta_box( 'proud_teaser', 'Teaser Configuration', array( $this, 'build_box' ), 'page', 'side' );
      }

      add_action('save_post','my_meta_save');
    }

    public function build_box( $post ){

      foreach( self::$fields as $id => $field ) {
        $value = get_post_meta( $post->ID, $id, true );
        wp_nonce_field( $id . '_dononce', $id . '_noncename' );
        ?>

        <label><?php echo $field['title']; ?></label>
        <select value="<?php echo $value; ?>" name="<?php echo $id; ?>">
          <?php foreach ( $field['options'] as $key => $label ): ?>
            <option value="<?php echo $key; ?>"><?php echo $label; ?></option>
          <?php endforeach; ?>
        </select>
        <?php
      }
    } // build_box()

    public function on_save( $postID ){
      // d('uhhhh');
      foreach( self::$fields as $id => $field ) {
        if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
          || !isset( $_POST[ $id . '_noncename' ] )
          || !wp_verify_nonce( $_POST[ $id . '_noncename' ], $id . '_dononce' ) ) {
          continue;
        }

        $old = get_post_meta( $postID, $id, true );
        print $old;
        $new = $_POST[ $id ] ;
        print $new;
        if( $old ){
          if ( is_null( $new ) ){
            delete_post_meta( $postID, $id );
          } else {
            update_post_meta( $postID, $id, $new, $old );
          }
        } elseif ( !is_null( $new ) ){
          add_post_meta( $postID, $id, $new, true );
        }
      }
      return $postID;
    } // on_save()

    public function on_delete( $postID ){
      foreach( self::$fields as $id => $field ) {
        delete_post_meta( $postID, $id );
      }
      return $postID;
    } // on_delete()
  }

  $teaser = new TeaserOptions();
}

if ( !class_exists( 'ContentTeaser' ) ) {

  // Prints out a teaser list from the args on creation
  // args format: 
  // 'post_type' => 'post',
  // 'posts_per_page' => 5,
  // 'update_post_term_cache' => false, // don't retrieve post terms
  // 'update_post_meta_cache' => false, // don't retrieve post meta
  class ContentTeaser {
    
    private $display_type;
    private $query;

    public function __construct( $display_type, $args ) {
      $this->display_type = !empty( $display_type ) ? array_shift($display_type) : 'list';
      $this->query = new \WP_Query( $args );
    }

    public function print_wrapper_open() {
      switch( $this->display_type ) {
        case 'list':
          echo '<div class="proud-teaser-list">';
          break;

        case 'mini':
          echo '<ul class="title-list list-unstyled">';
          break;

        case 'cards':
          echo '<div class="card-columns card-columns-xs-1 card-columns-sm-2 card-columns-md-3 card-columns-equalize">';
      }
    }

    public function print_content() {
      $this->query->the_post();
      switch( $this->display_type ) {
        case 'list':
          ?>
          <div <?php post_class( "teaser" ); ?>>
            <div class="row">
              <?php if( has_post_thumbnail() ): ?>
              <div class="col-md-3 pull-right">
                <?php the_post_thumbnail(); ?>
              </div>
              <?php endif; ?>
              <div class="col-md-9 pull-left">
                <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                <p class="muted"><?php echo get_the_date(); ?></p>
                <?php the_excerpt(); ?>
              </div>
            </div>
          </div>
          <?php
          break;

        case 'mini':
          ?>
          <li <?php post_class( "teaser-mini" ); ?>>
            <?php the_title( sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' ); ?>
            <p class="muted"><?php echo get_the_date(); ?></p>
          </li>
          <?php
          break;

        case 'cards':
          ?>
          <div <?php post_class( "card-wrap" ); ?>>
            <div class="card">
              <?php if( has_post_thumbnail() ): ?>
              <div class="card-img-top text-center">
                <?php the_post_thumbnail(); ?>
              </div>
              <?php endif; ?>
              <div class="card-block">
                <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
              </div>
            </div>
          </div>
          <?php
      } 
    }

    public function print_wrapper_close() {
      switch( $this->display_type ) {
        case 'list':
          echo "</div>";
          break;

        case 'mini':
          echo "</ul>";
          break;

        case 'cards':
          echo "</div>";
          break;
      }
    }

    public function print_empty() {
      switch( $this->display_type ) {
        default:
          echo "<h2>No Content</h2>";
          break;
      }
    }

    public function print_teaser_list() {
      if( $this->query->have_posts() ) {
        $this->print_wrapper_open();
        while ( $this->query->have_posts() ) :
          $this->print_content();
        endwhile;
        $this->print_wrapper_close();
      }
      else {
        $this->print_empty();
      }
      // Restore original Query
      wp_reset_query();
    }
  }
}