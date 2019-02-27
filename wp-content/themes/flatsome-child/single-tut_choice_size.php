<?php
/**
 * The blog template file.
 *
 * @package flatsome
 */
$post = get_post( get_the_ID() );

get_header();

?>

<div id="content" class="blog-wrapper blog-single page-wrapper">
<div class="row">
    <?php 
    $content = apply_filters('the_content', $post->post_content);
    echo $content;
    ?>
</div>    
</div><!-- #content .page-wrapper -->

<?php get_footer();
