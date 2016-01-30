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
    <header>
      <h2 class="h1 entry-title">Contact Us</h1>
      <hr />
    </header>
    <div class="entry-content row">
      <div class="col-md-4 padding-md-left pull-right">
        <?php if( has_post_thumbnail() ): ?>
        <p>
          <?php the_post_thumbnail(); ?>
        </p>
        <?php endif; ?>
        <?php if( $email ): ?>
        <strong>Email</strong>
        <p><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></p>
        <?php endif; ?>
        <?php if( $phone ): ?>
        <strong>Phone</strong>
        <p><?php echo $phone ?></p>
        <?php endif; ?>
        <?php if( $fb_url || $tw_url ): ?>
          <strong>Social Media</strong>
          <ul class="list-inline">
            <?php if( $fb_url ): ?>
            <li><a target="_blank" href="<?php echo $fb_url ?>"><i class="fa fa-facebook"></i><span class="sr-only">Facebook</span></a></li>
            <?php endif; ?>
            <?php if( $tw_url ): ?>
            <li><a target="_blank" href="<?php echo $tw_url ?>"><i class="fa fa-twitter"></i><span class="sr-only">Twitter</span></a></li>
            <?php endif; ?>
          </ul>
        <?php endif; ?>

      </div>
      <div class="col-md-8">
        <span class="pull-right"><?php foreach ($terms as $term): ?><a class="label label-default" href="/contact?filter_categories[]=<?php echo $term->term_id ?>"><?php echo $term->name ?></a><?php endforeach; ?></span>
        <h1 class="h2 margin-top-none margin-bottom-none"><?php the_title(); ?></h1>
        <?php if( $title ): ?>
          <h4 class="margin-top-none"><?php echo $title ?></h4>
        <?php endif; ?>
        <?php if( $bio ): ?>
          <p><?php echo $bio ?></p>
        <?php endif; ?>
        <?php the_content(); ?>
      </div>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'proud'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php //comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
