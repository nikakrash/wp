<div class="col-md-6">
    <article class="post blog-post-small _wide">
        <a href="<?= get_the_permalink($post->ID); ?>" class="bps__top post__top"
           style="background-image: url(<?= getPostThumbnail($post->ID, 'large'); ?>);">
            <span class="post__icon-wrapper">
                <span class="post__icon"><i class="fa fa-link"></i></span>
            </span>
        </a>
        <div class="bps__bottom post-bottom post__bottom">
            <a href="<?= get_the_permalink($post->ID); ?>" class="bps__title pb__title">
                <?= get_the_title(); ?>
            </a>
            <?
            /*
            ?>
            <div class="bps__text">
                <?=get_the_excerpt($post->ID); ?>
            </div>
            */
            ?>
            <div class="bps__buttons pb__buttons">
                <a href="<?= get_the_permalink($post->ID); ?>" class="bps__more pb__more button">К описанию проекта <i
                            class="icon icon-angle-right"></i></a>
            </div>
        </div>
    </article>
</div>