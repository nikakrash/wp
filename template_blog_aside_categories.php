<div class="blog-category aside__block">
    <div class="bc__caption aside__caption">
        Категории
    </div>
    <div class="bc__cats">
        <?php
        $categories = get_categories();
        foreach ($categories as $item) {
            ?>
            <div class="bc__cat">
                <a href="<?="/category/{$item->slug}"; ?>" class="bc__name"><?=$item->name;?></a>
                <div class="bc__count">(<?=$item->category_count;?>)</div>
            </div>
            <?
        }
        ?>
    </div>
</div>