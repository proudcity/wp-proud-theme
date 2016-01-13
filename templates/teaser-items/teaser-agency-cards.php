<?php
// @todo: wp-proud-agency should be included here
//if ( ! class_exists( 'Agency' ) ) {
//  require_once( get_template_directory(__FILE__) . '../../plugins/wp-proud-agency/wp-proud-agency.php' );
//}
if ( !function_exists('get_agency_permalink') ) {
  function get_agency_permalink($post = 0) {
    $post = $post > 0 ? $post : get_the_ID();
    $url = get_post_meta( $post, 'url', true );
    if ( !empty($url) ) {
      return esc_html( $url );
    }
    else {
      return esc_url( apply_filters( 'the_permalink', get_permalink( $post ), $post ) );
    }
  }
}
?>
<div <?php post_class( "card-wrap" ); ?>>
  <div class="card">
    <?php if( has_post_thumbnail() ): ?>
    <div class="card-img-top text-center">
      <a href="<?php echo esc_url( get_agency_permalink() ) ?>"><?php the_post_thumbnail('card-thumb'); ?></a>
    </div>
    <?php endif; ?>
    <div class="card-block">
      <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_agency_permalink() ) ), '</a></h3>' ); ?>
    </div>
  </div>
</div>