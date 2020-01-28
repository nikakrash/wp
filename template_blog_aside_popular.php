<div class="blog-popular aside__block">
    <div class="bp__caption aside__caption">
        Популярные записи
    </div>
    <div class="bp_posts">
        <?
        $posts = kama_get_most_viewed("num=5 &echo=0");
        if ($posts) {
            foreach ($posts as $post) {
                setup_postdata($post);
                $cat = get_the_category($post->ID);
                $category = $cat[0];
                ?>
                <div class="bp__post">
                    <a href="<?=get_the_permalink($post->ID);?>" class="bp__left">
                        <img src="<?=getPostThumbnail($post->ID, 'middle')?>" alt="<?=get_the_title(); ?>" class="bp__img">
                    </a>
                    <div class="bp__right post-bottom">
                        <a href="<?=get_the_permalink($post->ID);?>" class="bp__title pb__title"><?=get_the_title(); ?></a>
                        <div class="bp__info pb__info">
                            <a href="<?="/category/{$category->slug}"; ?>" class="bp__cat pb__cat"><?=$category->name; ?></a>
                            /
                            <time class="bp__time pb__time"><?=get_the_date();?></time>
                        </div>
                    </div>
                </div>
                <?
            }
        }

        wp_reset_postdata();
        ?>
    </div>

</div>