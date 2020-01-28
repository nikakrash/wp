<?
$cat = get_the_category($post->ID);
$category = $cat[0];
?>
<div class="col-md-12">
    <article class="post blog-post-big">
        <a href="<?=get_the_permalink($post->ID);?>" class="bpb__top post__top" style="background-image: url(<?=getPostThumbnail($post->ID, 'large'); ?>);">
            <span class="post__icon-wrapper">
                <span class="post__icon"><i class="fa fa-link"></i></span>
            </span>
        </a>
        <div class="bpb__bottom post-bottom post__bottom">
            <a href="<?=get_the_permalink($post->ID);?>" class="bpb__title pb__title">
                <?=get_the_title();?>
            </a>
            <div class="bpb__info pb__info">
                <a href="<?="/category/{$category->slug}"; ?>" class="bpb__cat pb__cat"><i class="fas fa-link"></i> <?=$category->name; ?></a>
                /
                <time class="bpb__time pb__time"><i class="far fa-calendar-alt"></i> <?=get_the_date(); ?></time>
            </div>
            <div class="bpb__text bpb__text_overflow bpb__text_small">
                <?=get_the_excerpt($post->ID); ?>
            </div>
            <div class="bpb__buttons pb__buttons">
                <a href="<?=get_the_permalink($post->ID);?>" class="bpb__more pb__more button">Читать далее <i class="icon icon-angle-right"></i></a> <?=(get_post_meta($post->ID,'views',true)) ? get_post_meta($post->ID,'views',true) : "0"; ?> <i class="fal fa-eye"></i>
            </div>
        </div>
    </article>
</div>
