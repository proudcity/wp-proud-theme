<?php
    use Proud\Theme\Wrapper;
    use Proud\Core\ProudBreadcrumb;
?>
<div class="page-header">
    <?php if ( empty( $hide_mobile_menu ) ): ?>
    <a id="offcanvas-toggle" href="#" class="btn btn-primary visible-xs pull-right"><i aria-hidden="true" class="fa fa-bars"></i></a>
    <?php endif; ?>
    <!--<h2><?php echo Wrapper\parent_title(); ?></h2>-->
</div>
<?php ProudBreadcrumb::print_breadcrumb() ?>
