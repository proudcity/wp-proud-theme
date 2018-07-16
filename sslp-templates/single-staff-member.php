<?php while (have_posts()) : the_post(); 

  $custom = get_post_custom();
  $title    = $custom["_staff_member_title"][0];
  $email    = $custom["_staff_member_email"][0];
  $phone    = $custom["_staff_member_phone"][0];
  $bio      = $custom["_staff_member_bio"][0];
  $fb_url   = $custom["_staff_member_fb"][0];
  $tw_url   = $custom["_staff_member_tw"][0] ? 'http://www.twitter.com/' . $custom["_staff_member_tw"][0] : false;
  $terms = wp_get_post_terms( $post->ID, 'staff-member-group', array("fields" => "all"));
  ?>
  <article <?php post_class(); ?>>
    <div class="page-header">
      <h2><a href="/contact">Contact</a></h2>
    </div>
    <div class="entry-content row">
      <div class="col-md-4 padding-md-left pull-right">
        <?php if( has_post_thumbnail() ): ?>
        <p>
          <?php the_post_thumbnail(); ?>
        </p>
        <?php endif; ?>
        <?php if( $email ): ?>
          <?php if(filter_var( $email, FILTER_VALIDATE_EMAIL ) ): ?>
            <strong>Email</strong>
            <p><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></p>
          <?php else: ?>
            <strong>Link</strong>
            <p><a href="<?php echo $email ?>"><?php echo $email ?></a></p>
          <?php endif; ?>
        <?php endif; ?>
        <?php if( $phone ): ?>
          <strong>Phone</strong>
          <p><?php echo $phone ?></p>
        <?php endif; ?>
        <?php if( $fb_url || $tw_url ): ?>
          <strong>Social Media</strong>
          <ul class="list-inline">
            <?php if( $fb_url ): ?>
            <li><a target="_blank" href="<?php echo $fb_url ?>"><i class="fa fa-facebook-square fa-2x"></i><span class="sr-only">Facebook</span></a></li>
            <?php endif; ?>
            <?php if( $tw_url ): ?>
            <li><a target="_blank" href="<?php echo $tw_url ?>"><i class="fa fa-twitter-square fa-2x"></i><span class="sr-only">Twitter</span></a></li>
            <?php endif; ?>
          </ul>
        <?php endif; ?>
        <?php if( $title ): ?>
          <?php if( $position_label = get_option( 'staff_position_label', false ) ): ?>
              <strong><?php echo $position_label ?></strong>
          <?php else: ?>
              <strong>Job Title</strong>
          <?php endif; ?>
          <p><?php echo $title ?></p>
        <?php endif; ?>
        <p><?php foreach ($terms as $term): ?><a class="label label-default" href="/contact?filter_categories[]=<?php echo $term->term_id ?>"><?php echo $term->name ?></a><?php endforeach; ?></p>

      </div>
      <div class="col-md-8">
        <h1 class=""><?php the_title(); ?></h1>
        <?php if( $bio ): ?>
          <p><?php echo apply_filters('the_content', $bio); ?></p>
        <?php else: ?>
          <?php the_content(); ?>
        <?php endif; ?>
      </div>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'proud'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php //comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
