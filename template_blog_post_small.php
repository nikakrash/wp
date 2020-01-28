<?
$cat = get_the_category($post->ID);
$category = $cat[0];
?>

<div class="col-sm col-sm_adapt d-flex">
    <div class="blog-item" style="background-image: url(<?= getPostThumbnail($post->ID, 'medium'); ?>)">
        <span class="blog-time"><?= get_the_date(); ?></span>
        <h4 class="blog-item__name"><?= get_the_title(); ?></h4>
        <div class="blog-item__bottom">
            <a href="<?= get_the_permalink($post->ID); ?>" class="blog-item__link">Читать <span class="blog-item__arrow arrow arrow_color_gray ico-font-arrow-right-middle"></span></a>
            <span class="blog-view">
                            <span class="blog-item__ico ico ico-eye"></span>
                            <span><?= (get_post_meta($post->ID, 'views', true)) ? get_post_meta($post->ID, 'views', true) : "0"; ?></span>
                        </span>
        </div>
    </div>
</div>