<?
require 'parts/head.php';
?>



<?
// need to buffer main loop, because after using ACF, wp_query breaks
if (have_posts()) {
    $main_loop = '';
    $i = 0;
    while (have_posts()) {
        ob_start();
        the_post();
        setup_postdata($post);

        get_template_part('template_blog_post_big');

        $main_loop .= ob_get_contents();
        ob_end_clean();
        $i++;
    }
}
wp_reset_postdata();
?>

<div class="blog">
    <div class="content">
        <div class="blog__wrapper">
            <?php
                require "parts/blog-head.php";
            ?>
            <div class="row">
                <div class="col-md-9">
                    <div class="blog__left">
                        <?= $main_loop; ?>
                        <nav class="blog-pager">
                            <?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>
                        </nav>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="blog__right">
                        <aside>
                            <?php
                            get_template_part("template_blog_aside_categories");
                            get_template_part("template_blog_aside_popular");
                            get_template_part("template_blog_aside_sign");
                            get_template_part("template_blog_aside_socials");
                            ?>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?
require "parts/footer.php";
?>
