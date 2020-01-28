<?
require "parts/head.php";
?>

<?
require "parts/header.php";
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

        get_template_part('template_blog_post_small');

        $main_loop .= ob_get_contents();
        ob_end_clean();
        $i++;
    }
}
wp_reset_postdata();
?>

<section class="section-top section-top_inner section-top_blog section_line_bottom">
    <div class="container">
        <div class="top-main">
            <div class="top-main__text top-main__text_blog top-main__text_inner">
                <h1>Блог<span class="dott"></span></h1>
                <div class="btn-box">
                    <div class="btn btn_bord_pink" data-toggle="modal" data-target="#modalWindow" data-caption="Оставьте свои контактные данные и мы свяжемся с Вами">Сотрудничать</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section blog section_line_bottom">
    <div class="container">
        <div class="row">
            <?=$main_loop; ?>
        </div>
        <div class="btn-box btn-box_bottom-section">
            <a class="btn btn_bord_pink">Больше статей</a>
            <?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>

        </div>
    </div>
</section>

<section class="section order section_back_dark">
    <div class="container">
        <div class="order-container">
            <div class="order__head">
                <h2 class="h2 text_color_pink">
                    Получите<br> консультацию<span class="dott"></span>
                </h2>
                <span class="subtitle text_color_white">Наш менеджер свяжется с&nbsp;Вами в&nbsp;течение 30&nbsp;минут или в&nbsp;любое удобное для Вас время</span>
            </div>
            <div class="order__btn">
                <div class="btn btn_bord_pink" data-toggle="modal" data-target="#modalWindow" data-caption="Оставьте свои контакты и мы свяжемся с Вами">Получить</div>
            </div>
        </div>
    </div>
</section>
</body>
</html>