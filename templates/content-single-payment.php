<?php
use Proud\Theme\Wrapper;

$id = get_the_ID();

$form_id = get_post_meta( $id, 'form', true );
if ( !empty($form_id) ) {

  // Docs: https://www.gravityhelp.com/documentation/article/embedding-a-form/#usage-examples
  // gravity_form( $id_or_title, $display_title = true, $display_description = true, $display_inactive = false, $field_values = null, $ajax = false, $tabindex, $echo = true );
  $form = gravity_form( $form_id, false, true, false, null, false, 0, false );
}
else {
  $link = $filename = get_post_meta( $id, 'link', true );
}

?>
<div class="page-header">
  <h2><a href="/payments" onclick="jQuery('.navbar-btn.payments-button').trigger('click');return false;">Payments</a></h2>
</div>

<h1 class="entry-title">
  <?php the_title(); ?>
</h1>


<div class="row">
  <div class="col-md-7">
    <h4>Online payments</h4>
    <?php if ($form): ?>
      <?php echo $form ?>
    <?php elseif ($link): ?>
      <p><a href="<?php echo $link ?>"class="btn btn-primary btn-lg" target="_blank">Pay online now &raquo;</a></p>
      <p><small><em>You will be redirected to our secure online payment provider.</em></small></p>
    <?php endif ?>
  </div>
  <div class="col-md-5">
    <h4>Other ways to pay</h4>
    <?php echo the_content() ?>
  </div>
</div>
