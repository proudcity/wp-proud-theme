<?php while (have_posts()) : the_post(); 

  $custom = get_post_custom();
  $title    = $custom["_staff_member_title"][0];
  $email    = $custom["_staff_member_email"][0];
  $contact_link = $custom["_proud_contact_link"][0];
  $phone    = $custom["_staff_member_phone"][0];
  $bio      = $custom["_staff_member_bio"][0];
  $fb_url   = $custom["_staff_member_fb"][0];
  $tw_url   = $custom["_staff_member_tw"][0] ? 'http://www.twitter.com/' . $custom["_staff_member_tw"][0] : false;
  $linkedin_url = $custom["_proud_linkedin_link"][0];
  $terms = wp_get_post_terms( $post->ID, 'staff-member-group', array("fields" => "all"));
  ?>
  <article <?php post_class(); ?>>
    <div class="page-header">
      <h2><a href="/contact">Contact</a></h2>
    </div>
    <div class="entry-content row">
      <div class="col-md-4 padding-md-left pull-md-right">
        <?php if( has_post_thumbnail() ): ?>
        <p>
          <?php the_post_thumbnail(); ?>
        </p>
        <?php endif; ?>
        <?php if( ! empty( $email ) ){ ?>
          <strong>Email</strong>
          <p><a href="mailto:<?php echo sanitize_email( $email ); ?>"><?php echo sanitize_email( $email ); ?></a></p>
        <?php } ?>
        <?php if ( ! empty( $contact_link ) ) { ?>
          <strong>Link</strong>
          <p><a href="<?php echo esc_url( $contact_link ); ?>">Contact <?php the_title(); ?></a></p>
        <?php } // if contact_link ?>
        <?php if( $phone ): ?>
          <strong>Phone</strong>
          <p><a href="tel:<?php esc_html( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></p>
        <?php endif; ?>
        <?php if( $fb_url || $tw_url || $linkedin_url ): ?>
          <strong>Social Media</strong>
          <ul class="list-inline">
            <?php if( $fb_url ): ?>
            <li><a target="_blank" href="<?php echo esc_url( $fb_url ); ?>"><i class="fa fa-facebook-square fa-2x"></i><span class="sr-only">Facebook</span></a></li>
            <?php endif; ?>
            <?php if( $tw_url ): ?>
            <li><a target="_blank" href="<?php echo esc_url( $tw_url ); ?>"><i class="fa fa-twitter-square fa-2x"></i><span class="sr-only">Twitter</span></a></li>
            <?php endif; ?>
            <?php if ( ! empty( $linkedin_url ) ){ ?>
              <li><a target="_blank" href="<?php echo esc_url( $linkedin_url ); ?>"><i class="fa fa-linkedin fa-2x"></i><span class="sr-only">Linkedin</span></a></li>
            <?php } // if linkedin ?>
          </ul>
        <?php endif; ?>
        <?php if( $title ): ?>
          <?php if( $position_label = get_option( 'staff_position_label', false ) ): ?>
              <strong><?php echo esc_attr( $position_label ); ?></strong>
          <?php else: ?>
              <strong>Job Title</strong>
          <?php endif; ?>
          <p><?php echo esc_attr( $title ); ?></p>
        <?php endif; ?>
        <p><?php foreach ($terms as $term): ?><a style="display: inline-block;" class="label label-default" href="/contact?filter_categories[]=<?php echo absint( $term->term_id ); ?>"><?php echo esc_attr( $term->name ); ?></a><?php endforeach; ?></p>

      </div>
      <div class="col-md-8">
        <h1 class=""><?php the_title(); ?></h1>
        <?php if( $bio ): ?>
          <p><?php echo apply_filters('the_content', $bio); ?></p>
        <?php endif; ?>
      </div>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'proud'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php //comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
