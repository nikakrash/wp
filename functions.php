<?php

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Настройки сайта',
        'menu_title' => 'Настройки сайта',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

// фильтрация для acf для поля неисправностей https://www.advancedcustomfields.com/resources/post-object/
// https://www.advancedcustomfields.com/resources/acf-fields-post_object-query/
function my_relationship_query($args, $field, $post_id)
{
    // only show children of the current post being edited
    //$args['post_parent'] = 10;
    $args['meta_key'] = '_wp_page_template';
    $args['meta_value'] = 'page-product.php';
    // return
    return $args;
}

add_filter('acf/fields/post_object/query/name=table__name', 'my_relationship_query', 10, 3);


// убирает type из подключеных скриптов для валидности
add_filter('style_loader_tag', 'myplugin_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'myplugin_remove_type_attr', 10, 2);
function myplugin_remove_type_attr($tag, $handle)
{
    return preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $tag);
}

// отключение лишних тегов в head
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'robots');

// отключение wp-emoji-release.min.js , который вылазит в head
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');


remove_filter('the_content', 'wpautop'); // Отключаем автоформатирование в полном посте
remove_filter('the_excerpt', 'wpautop'); // Отключаем автоформатирование в кратком(анонсе) посте
remove_filter('comment_text', 'wpautop'); // Отключаем автоформатирование в комментариях

define('AUTOMATIC_UPDATER_DISABLED', true);

// Отключаем сам REST API
add_filter('rest_enabled', '__return_false');

// Отключаем фильтры REST API
remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action('wp_head', 'rest_output_link_wp_head', 10, 0);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('auth_cookie_malformed', 'rest_cookie_collect_status');
remove_action('auth_cookie_expired', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_username', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_hash', 'rest_cookie_collect_status');
remove_action('auth_cookie_valid', 'rest_cookie_collect_status');
remove_filter('rest_authentication_errors', 'rest_cookie_check_errors', 100);


// подключение скриптов
//add_action('wp_enqueue_scripts', 'my_scripts');

function my_scripts()
{
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_template_directory_uri() . '/libs/jquery/jquery.js');
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/libs/bootstrap/bootstrap.js', null, null, true);
    wp_enqueue_script('mask', get_template_directory_uri() . '/libs/mask/mask.js', null, null, true);
    wp_enqueue_script('wow', get_template_directory_uri() . '/libs/wow/wow.js', null, null, true);
    wp_enqueue_script('swipe', get_template_directory_uri() . '/libs/swipe/swipe.js', null, null, true);
    wp_enqueue_script('swiper', get_template_directory_uri() . '/libs/swiper/js/swiper.min.js', null, null, true);
    /* wp_enqueue_script('lightbox', get_template_directory_uri() . '/libs/lightbox/js/lightbox.js', null, null, true); */
    wp_enqueue_script('mask', get_template_directory_uri() . '/libs/mask/mask.js', null, null, true);
    wp_enqueue_script('index', get_template_directory_uri() . '/js/app.js', null, null, true);
}

// регистрируем стили
//add_action('wp_enqueue_scripts', 'my_styles');

function my_styles()
{
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css', null, null);
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/fontawesome-all.min.css', null, null);
    /* wp_enqueue_style('lightbox', get_template_directory_uri() . '/libs/lightbox/css/lightbox.css', null, null); */
    wp_enqueue_style('fonts2', get_template_directory_uri() . '/fonts/stylesheet.css', null, null);
    wp_enqueue_style('blog', get_template_directory_uri() . '/css/blog.css', null, null);
    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', null, null);
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/libs/bootstrap/bootstrap.css', null, null);
    wp_enqueue_style('swiper', get_template_directory_uri() . '/libs/swiper/css/swiper.min.css', null, null);
    wp_enqueue_style('raleway', get_template_directory_uri() . '/fonts/stylesheet.css', null, null);
    wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css', null, null);
    wp_enqueue_style('media2', get_template_directory_uri() . '/css/media.css', null, null);
}


// отключение emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');


// отключение лишнего из wp_head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links_extra', 3);

add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('post-thumbnails', array('post'));


// отключение автообновления системы и плагинов, а так же отключается вывод сообщений
define('AUTOMATIC_UPDATER_DISABLED', true);
add_filter('pre_site_transient_update_core', create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_version_check');
remove_action('load-update-core.php', 'wp_update_plugins');
add_filter('pre_site_transient_update_plugins', create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_update_plugins');
remove_action('load-update-core.php', 'wp_update_themes');
add_filter('pre_site_transient_update_themes', create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_update_themes');


show_admin_bar(false);


// убираем все лишнее из админки
function remove_menus()
{
    global $menu;
    $restricted = array(
        __('Dashboard'),
        __('Posts'),
        __('Media'),
        __('Links'),
        __('Appearance'),
        __('Theme'),
        __('Tools'),
        __('Plugins'),
        __('Users'),
        __('Settings'),
        __('Comments')
    );
    end($menu);
    while (prev($menu)) {
        $value = explode(' ', $menu[key($menu)][0]);
        if (in_array(($value[0] != NULL ? $value[0] : ""), $restricted)) {
            unset($menu[key($menu)]);
        }
    }
    remove_menu_page('themes.php'); // убираем внешний вид
    remove_menu_page('edit.php?post_type=acf-field-group'); // убираем настройки кастом филдс
}

//add_action('admin_menu', 'remove_menus');


function wp_corenavi()
{
    global $wp_query;
    $pages = '';
    $max = $wp_query->max_num_pages;
    if (!$current = get_query_var('paged')) $current = 1;
    $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
    $a['total'] = $max;
    $a['current'] = $current;

    $total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
    $a['mid_size'] = 0; //сколько ссылок показывать слева и справа от текущей
    $a['end_size'] = 0; //сколько ссылок показывать в начале и в конце
    $a['next_text'] = '<div class="bp__button_older bp__button"><i class="icon icon-arrow-prev"></i> К предыдущим записям</div>'; //текст ссылки "Предыдущая страница"
    $a['prev_text'] = '<div class="bp__button_newer bp__button">К следующим записям<i class="icon icon-arrow-next"></i> </div>'; //текст ссылки "Следующая страница"

    if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>' . "\r\n";
    echo $pages . paginate_links($a);
}

/* Подсчет количества посещений страниц
---------------------------------------------------------- */
add_action('wp_head', 'kama_postviews');
function kama_postviews()
{

    /* ------------ Настройки -------------- */
    $meta_key = 'views';  // Ключ мета поля, куда будет записываться количество просмотров.
    $who_count = 1;            // Чьи посещения считать? 0 - Всех. 1 - Только гостей. 2 - Только зарегистрированных пользователей.
    $exclude_bots = 1;            // Исключить ботов, роботов, пауков и прочую нечесть :)? 0 - нет, пусть тоже считаются. 1 - да, исключить из подсчета.

    global $user_ID, $post;
    if (is_singular()) {
        $id = (int)$post->ID;
        static $post_views = false;
        if ($post_views) return true; // чтобы 1 раз за поток
        $post_views = (int)get_post_meta($id, $meta_key, true);
        $should_count = false;
        switch ((int)$who_count) {
            case 0:
                $should_count = true;
                break;
            case 1:
                if ((int)$user_ID == 0)
                    $should_count = true;
                break;
            case 2:
                if ((int)$user_ID > 0)
                    $should_count = true;
                break;
        }
        if ((int)$exclude_bots == 1 && $should_count) {
            $useragent = $_SERVER['HTTP_USER_AGENT'];
            $notbot = "Mozilla|Opera"; //Chrome|Safari|Firefox|Netscape - все равны Mozilla
            $bot = "Bot/|robot|Slurp/|yahoo"; //Яндекс иногда как Mozilla представляется
            if (!preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent))
                $should_count = false;
        }

        if ($should_count)
            if (!update_post_meta($id, $meta_key, ($post_views + 1))) add_post_meta($id, $meta_key, 1, true);
    }
    return true;
}

function kama_get_most_viewed($args = '')
{
    parse_str($args, $i);
    $num = isset($i['num']) ? $i['num'] : 10;
    $key = isset($i['key']) ? $i['key'] : 'views';
    $order = isset($i['order']) ? 'ASC' : 'DESC';
    $cache = isset($i['cache']) ? 1 : 0;
    $days = isset($i['days']) ? (int)$i['days'] : 0;
    $echo = isset($i['echo']) ? 0 : 1;
    $format = isset($i['format']) ? stripslashes($i['format']) : 0;
    global $wpdb, $post;
    $cur_postID = $post->ID;

    if ($cache) {
        $cache_key = (string)md5(__FUNCTION__ . serialize($args));
        if ($cache_out = wp_cache_get($cache_key)) { //получаем и отдаем кеш если он есть
            if ($echo) return print($cache_out); else return $cache_out;
        }
    }

    if ($days) {
        $AND_days = "AND post_date > CURDATE() - INTERVAL $days DAY";
        if (strlen($days) == 4)
            $AND_days = "AND YEAR(post_date)=" . $days;
    }

    $sql = "SELECT p.ID, p.post_title, p.post_date, p.guid, p.comment_count, (pm.meta_value+0) AS views
	FROM $wpdb->posts p
		LEFT JOIN $wpdb->postmeta pm ON (pm.post_id = p.ID)
	WHERE pm.meta_key = '$key' $AND_days
		AND p.post_type = 'post'
		AND p.post_status = 'publish'
	ORDER BY views $order LIMIT $num";
    $results = $wpdb->get_results($sql);
    if (!$results) return false;

    return $results;

}


function breadcrumbs()
{

    /* === OPTIONS === */
    $text['home'] = 'Главная'; // текст ссылки "Главная"

    $text['category'] = '%s'; // текст для страницы рубрики

    $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска

    $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега

    $text['author'] = 'Статьи автора %s'; // текст для страницы автора

    $text['404'] = 'Ошибка 404'; // текст для страницы 404

    $show_current = 1; // 1 - показывать название текущей статьи/страницы/рубрики, 0 - не показывать

    $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать

    $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать

    $show_title = 1; // 1 - показывать подсказку (title) для ссылок, 0 - не показывать

    $delimiter = ' / '; // разделить между "крошками"

    $before = '<span class="current">'; // тег перед текущей "крошкой"

    $after = '</span>'; // тег после текущей "крошки"

    /* === END OF OPTIONS === */

    global $post;

    $home_link = home_url('/');

    $link_before = '';

    $link_after = '';

    $link_attr = ' rel="v:url" property="v:title"';

    $link = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;

    $parent_id = $parent_id_2 = $post->post_parent;

    $frontpage_id = get_option('page_on_front');

    if (is_front_page()) {
        if ($show_on_home == 1) echo '<div><a href="' . $home_link . '">' . $text['home'] . '</a></div>';
    } else if (is_home()) {
        echo '<div><a href="' . $home_link . '">' . $text['home'] . '</a>' . $delimiter . ' <span>Блог</span> </div>';
    } else {

        echo '';

        if ($show_home_link == 1) {

            echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';

            if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;

        }

        if (is_category()) {

            $this_cat = get_category(get_query_var('cat'), false);

            if ($this_cat->parent != 0) {

                $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);

                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);

                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);

                $cats = str_replace('</a>', '</a>' . $link_after, $cats);

                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);

                echo $cats;

            }

            if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

        } elseif (is_search()) {

            echo $before . sprintf($text['search'], get_search_query()) . $after;

        } elseif (is_day()) {

            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;

            echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;

            echo $before . get_the_time('d') . $after;

        } elseif (is_month()) {

            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;

            echo $before . get_the_time('F') . $after;

        } elseif (is_year()) {

            echo $before . get_the_time('Y') . $after;

        } elseif (is_single() && !is_attachment()) {

            if (get_post_type() != 'post') {

                $post_type = get_post_type_object(get_post_type());

                $slug = $post_type->rewrite;

                printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);

                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

            } else {

                $cat = get_the_category();
                $cat = $cat[0];

                $cats = get_category_parents($cat, TRUE, $delimiter);

                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);

                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);

                $cats = str_replace('</a>', '</a>' . $link_after, $cats);

                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);

                echo $cats;

                if ($show_current == 1) echo $before . get_the_title() . $after;

            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {

            $post_type = get_post_type_object(get_post_type());

            echo $before . $post_type->labels->singular_name . $after;

        } elseif (is_attachment()) {

            $parent = get_post($parent_id);

            $cat = get_the_category($parent->ID);
            $cat = $cat[0];

            $cats = get_category_parents($cat, TRUE, $delimiter);

            $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);

            $cats = str_replace('</a>', '</a>' . $link_after, $cats);

            if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);

            echo $cats;

            printf($link, get_permalink($parent), $parent->post_title);

            if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

        } elseif (is_page() && !$parent_id) {

            if ($show_current == 1) echo $before . get_the_title() . $after;

        } elseif (is_page() && $parent_id) {

            if ($parent_id != $frontpage_id) {

                $breadcrumbs = array();

                while ($parent_id) {

                    $page = get_page($parent_id);

                    if ($parent_id != $frontpage_id) {

                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));

                    }

                    $parent_id = $page->post_parent;

                }

                $breadcrumbs = array_reverse($breadcrumbs);

                for ($i = 0; $i < count($breadcrumbs); $i++) {

                    echo $breadcrumbs[$i];

                    if ($i != count($breadcrumbs) - 1) echo $delimiter;

                }

            }

            if ($show_current == 1) {

                if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;

                echo $before . get_the_title() . $after;

            }

        } elseif (is_tag()) {

            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

        } elseif (is_author()) {

            global $author;

            $userdata = get_userdata($author);

            echo $before . sprintf($text['author'], $userdata->display_name) . $after;

        } elseif (is_404()) {

            echo $before . $text['404'] . $after;

        }

        if (get_query_var('paged')) {

            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';

            echo __('Page') . ' ' . get_query_var('paged');

            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';

        }

        echo '';

    }

} // end dimox_breadcrumbs()


add_filter('relevanssi_excerpt_content', 'custom_fields_to_excerpts', 10, 3);
function custom_fields_to_excerpts($content, $post, $query)
{

    $custom_field = get_post_meta($post->ID, 'normal_custom_field', true);
    $content .= " " . $custom_field;
    $custom_field = get_post_meta($post->ID, 'normal_custom_field2', true);
    $content .= " " . $custom_field;

    if ($fields) {
        foreach ($fields as $custom_field) {
            $content .= " " . $custom_field['repeater_sub_field_1'];
            $content .= " " . $custom_field['repeater_sub_field_2'];
        }
    }
    $fields = get_field('page_content', $post->ID);
    if ($fields) {
        foreach ($fields as $custom_field) {

            if ($custom_field['acf_fc_layout'] == 'layout_name_1') {
                $content .= " " . $custom_field['sub_custom_field'];
                $content .= " " . $custom_field['sub_custom_field2'];

            } elseif ($custom_field['acf_fc_layout'] == 'layout_name_2') {
                $content .= " " . $custom_field['sub_custom_field'];
            }
        }
    }
    return $content;
}

function getAllCats()
{
    $cat = get_queried_object();
    $cat_id = $cat->term_id;
    $cat_description = $cat->category_description;
    $cat_slug = $cat->slug;
    $cat_count = $cat->count;
    $cats = get_categories(array(
        'orderby' => 'slug',
        'order' => 'ASC'
    ));
    foreach ($cats as $cat) {
        $now_id = $cat->term_id;
        if ($now_id == $cat_id) {
            echo('<li class="active bc__cat"><span>' . $cat->name . '</span></li>');
        } else {
            echo('<li class="bc__cat"><a href="\category\\' . $cat->slug . '">' . $cat->name . '</a></li>');
        }
    }
}

function getPostThumbnail($id, $size = '')
{
    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($id), $size);
    return $thumbnail[0];
}

?>