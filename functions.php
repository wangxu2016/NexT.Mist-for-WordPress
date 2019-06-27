<?php
/*
Theme Name: NexT.Mist
Theme URI: https://github.com/wangxu2016/NexT.Mist-for-WordPress
Author: Wang Xu
Author URI: https://nknow.top/
Description: 精于心，简于形
Version: 1.1.1
License: GNU General Public License v3.0
Tags: black, white, concise
*/

function mystyle_page_menu_args($args)
{
    $args['show_home'] = true;
    return $args;
}

add_filter('wp_page_menu_args', 'mystyle_page_menu_args');

if (!function_exists('mystyle_content_nav')) :
    register_nav_menus(array('header-menu' => __('NexT.Mist导航菜单'),));

//禁用修订版本
    add_filter('wp_revisions_to_keep', 'specs_wp_revisions_to_keep', 10, 2);
    function specs_wp_revisions_to_keep($post)
    {
        return 0;
    }

//去除头部无用代码
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'locale_stylesheet');
    remove_action('wp_head', 'noindex', 1);
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rel_canonical');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_action('wp_head', 'wp_resource_hints', 2);
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
    remove_action('wp_footer', 'wp_print_footer_scripts');
    remove_action('publish_future_post', 'check_and_publish_future_post', 10, 1);
    remove_action('template_redirect', 'wp_shortlink_header', 11, 0);
    remove_action('template_redirect', 'rest_output_link_header', 11, 0);
    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    remove_filter('oembed_response_data', 'get_oembed_response_data_rich', 10, 4);
    add_filter('rest_enabled', '__return_false');
    add_filter('rest_jsonp_enabled', '__return_false');

//禁用Emoji表情
    function disable_emojis()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
    }

    add_action('init', 'disable_emojis');
    function disable_emojis_tinymce($plugins)
    {
        if (is_array($plugins)) {
            return array_diff($plugins, array('wpemoji'));
        } else {
            return array();
        }
    }

//移除菜单的多余CSS选择器
    add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
    add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
    add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
    function my_css_attributes_filter($var)
    {
        return is_array($var) ? array() : '';
    }

//替换Gravatar服务器
    function kratos_get_avatar($avatar)
    {
        $avatar = preg_replace("/http:\/\/(www|\d).gravatar.com/", "https://cn.gravatar.com", $avatar);
        return $avatar;
    }

    add_filter('get_avatar', 'kratos_get_avatar');

//启动友情链接
    add_filter('pre_option_link_manager_enabled', '__return_true');

//获得热评文章
    function mystyle_get_most_viewed($posts_num = 10, $days = 180)
    {
        global $wpdb;
        $sql = "SELECT ID , post_title , comment_count FROM $wpdb->posts WHERE post_type = 'post' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days AND ($wpdb->posts.`post_status` = 'publish' OR $wpdb->posts.`post_status` = 'inherit') ORDER BY comment_count DESC LIMIT 0 , $posts_num ";
        $posts = $wpdb->get_results($sql);
        $output = "";
        foreach ($posts as $post) {
            $output .= "\n<li><a href=\"" . get_permalink($post->ID) . "\" target=\"_blank\" >" . $post->post_title . "</a></li>";
        }
        echo $output;
    }

//新窗口打开评论里的链接
    function remove_comment_links()
    {
        global $comment;
        $url = get_comment_author_url();
        $author = get_comment_author();
        if (empty($url) || 'http://' == $url)
            $return = $author;
        else
            $return = "<a href='$url' rel='nofollow' target='_blank'>$author</a>";
        //带跳转路径，必须根目录有 go.php 解析文件
        //$return = "<a href='/go.php?url=$url' rel='nofollow' target='_blank'>$author</a>";
        return $return;
    }

    add_filter('get_comment_author_link', 'remove_comment_links');
    remove_filter('comment_text', 'make_clickable', 9);

//分页函数
    function pagination($query_string)
    {
        global $posts_per_page, $paged;
        $my_query = new WP_Query($query_string . "&posts_per_page=-1");
        $total_posts = $my_query->post_count;
        if (empty($paged)) $paged = 1;
        $prev = $paged - 1;
        $next = $paged + 1;
        $range = 4;  //分页数设置
        $showitems = ($range * 2) + 1;
        $pages = ceil($total_posts / $posts_per_page);
        if (1 != $pages) {
            echo "<nav class='pagination'>";
            echo ($paged > 2 && $paged + $range + 1 > $pages && $showitems < $pages) ? "<a class=\"page-number\" href='" . get_pagenum_link(1) . "'><i class='fa fa-angle-double-left' aria-hidden='true'></i></a>" : "";
            echo ($paged > 1 && $showitems < $pages) ? "<a class=\"page-number\" href='" . get_pagenum_link($prev) . "'><i class='fa fa-angle-left' aria-hidden='true'></i></a>" : "";
            for ($i = 1; $i <= $pages; $i++) {
                if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                    echo ($paged == $i) ? '<span class="page-number current">' . $i . '</span>' : '<a class="page-number" href="' . get_pagenum_link($i) . '">' . $i . '</a>';
                }
            }
            echo ($paged < $pages && $showitems < $pages) ? "<span class=\"space\">&hellip;</span>" : "";
            echo ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) ? "<a class=\"page-number\" href=\"" . get_pagenum_link($next) . "\">" . $pages . "</a>" : "";
            if ($next <= $pages) {
                echo '<a class="extend next" rel="next" href="' . get_pagenum_link($next) . '"><i class="fa fa-angle-right"></i></a>';
                if ($paged < $pages && $showitems < $pages) {
                    echo "<a class=\"page-number\" href='" . get_pagenum_link($pages) . "'><i class='fa fa-angle-double-right' aria-hidden='true'></i></a>";
                }
            }
            echo "</nav>";
        }
    }

//评论模板
    function tangstyle_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                ?>
                <li id="comment-<?php comment_ID(); ?>" class="comment_li">
                <?php _e('Pingback:', 'tangstyle'); ?>
                <?php comment_author_link(); ?>
                <?php edit_comment_link(__('(Edit)', 'tangstyle'), '<span class="edit-link">', '</span>'); ?>
                <?php
                break;
            default :
                global $post;
                ?>
                <li id="comment-li-<?php comment_ID(); ?>" class="comment_li">
                <div id="comment-<?php comment_ID(); ?>">
                    <div class="comment_top clearfix">
                        <div class="comment_avatar"><?php echo get_avatar($comment, 40); ?></div>
                        <div class="pull-left">
                            <p class="comment_author"><?php printf(__('%s'), get_comment_author_link()) ?></p>
                            <p class="comment_time"><?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></p>
                        </div>
                        <div class="pull-right"><?php comment_reply_link(array_merge($args, array('reply_text' => __('回复TA', 'tangstyle'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?><?php edit_comment_link(__('编辑', 'tangstyle'), '<span class="edit_link">', '</span>'); ?></div>
                    </div>
                    <div class="comment_text"><?php comment_text(); ?></div>
                </div>
                <?php
                break;
        endswitch;
    }
endif;

//颜色选择器
function color_picker_assets()
{
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('my-color-picker-handle');
    wp_enqueue_script('wp-color-picker');
}

;
add_action('admin_enqueue_scripts', 'color_picker_assets');

$theme_name = "NexT.Mist";
$short_name = "my";
$options = array(
    array(
        "name" => "首页标题",
        "id" => $short_name . "_title",
        "type" => "text",
        "std" => "它将显示在首页的 title 标签里"
    ),
    array(
        "name" => "首页描述 Description",
        "id" => $short_name . "_description",
        "type" => "textarea",
        "std" => "它将显示在首页的 meta 标签的 description 属性里"
    ),
    array(
        "name" => "首页关键字 KeyWords",
        "id" => $short_name . "_keywords",
        "type" => "textarea",
        "std" => "它将显示在首页的 meta 标签的 keywords 属性里。多个关键字以英文逗号隔开。"
    ),
    array(
        "type" => "hr",
    ),
    array(
        "name" => "版权年份（页脚）",
        "id" => $short_name . "_years",
        "type" => "text",
        "std" => "2019",
    ),
    array(
        "name" => "博主姓名",
        "id" => $short_name . "_author_name",
        "type" => "text",
        "std" => "WangXu",
    ),
    array(
        "name" => "统计代码（带上script标签）",
        "id" => $short_name . "_tongji",
        "type" => "textarea",
        "std" => "代码在页面底部，带上script标签"
    ),
    array(
        "type" => "hr",
    ),
    array(
        "name" => "头像图片链接",
        "id" => $short_name . "_avatar",
        "type" => "text",
        "std" => "https://nknow.top/wp-content/themes/NexT.Mist-for-WordPress/images/pic.png",
    ),
    array(
        "type" => "hr",
    ),
    array(
        "name" => "是否显示RSS订阅源",
        "id" => $short_name . "_rss",
        "type" => "select",
        "std" => "显示",
        "options" => array("隐藏", "显示")
    ),
    array(
        "type" => "hr",
    ),
    array(
        "name" => "是否显示Weibo",
        "id" => $short_name . "_weibo",
        "type" => "select",
        "std" => "隐藏",
        "options" => array("隐藏", "显示")
    ),
    array(
        "name" => "Weibo地址",
        "id" => $short_name . "_weibo_url",
        "type" => "text",
        "std" => "https://weibo.com/u/3618449725",
    ),
    array(
        "name" => "是否显示Twitter",
        "id" => $short_name . "_twitter",
        "type" => "select",
        "std" => "隐藏",
        "options" => array("隐藏", "显示")
    ),
    array(
        "name" => "Twitter地址",
        "id" => $short_name . "_twitter_url",
        "type" => "text",
        "std" => "https://twitter.com/SkipWx",
    ),
    array(
        "name" => "是否显示Facebook",
        "id" => $short_name . "_facebook",
        "type" => "select",
        "std" => "隐藏",
        "options" => array("隐藏", "显示")
    ),
    array(
        "name" => "Facebook地址",
        "id" => $short_name . "_facebook_url",
        "type" => "text",
        "std" => "https://www.facebook.com/profile.php?id=100037098938283",
    ),
    array(
        "name" => "是否显示GitHub",
        "id" => $short_name . "_github",
        "type" => "select",
        "std" => "隐藏",
        "options" => array("隐藏", "显示")
    ),
    array(
        "name" => "GitHub地址",
        "id" => $short_name . "_github_url",
        "type" => "text",
        "std" => "https://github.com/wangxu2016",
    ),
    array(
        "type" => "hr",
    ),
    array(
        "name" => "是否启用文章底部图片或二维码",
        "id" => $short_name . "_subscriber_flag",
        "type" => "select",
        "std" => "禁用",
        "options" => array("禁用", "启用")
    ),
    array(
        "name" => "底部图片链接",
        "id" => $short_name . "_subscribe",
        "type" => "text",
        "std" => "https://nknow.top/wp-content/themes/NexT.Mist-for-WordPress/static/icon/favicon.ico",
    ),
);

//注册后台管理
function mytheme_add_admin()
{
    global $theme_name, $short_name, $options;
    if ($_GET['page'] == basename(__FILE__)) {
        if ('save' == $_REQUEST['action']) {
            foreach ($options as $value) {
                update_option($value['id'], $_REQUEST[$value['id']]);
            }
            foreach ($options as $value) {
                if (isset($_REQUEST[$value['id']])) {
                    update_option($value['id'], $_REQUEST[$value['id']]);
                } else {
                    delete_option($value['id']);
                }
            }
            header("Location: themes.php?page=functions.php&saved=true");
            die;
        } else if ('reset' == $_REQUEST['action']) {
            foreach ($options as $value) {
                delete_option($value['id']);
                update_option($value['id'], $value['std']);
            }
            header("Location: themes.php?page=functions.php&reset=true");
            die;
        }
    }
    add_theme_page($theme_name . " 设置", "$theme_name 设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

//后台主题管理界面
function mytheme_admin()
{
    global $theme_name, $short_name, $options;
    if ($_REQUEST['saved']) echo '<div id="message" class="updated notice is-dismissible"><p>' . $theme_name . ' 设置已保存。</p></div>';

    ?>

    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/static/css/bootstrap.min.css">

    <div class="container-fluid">
        <h2 class="text-primary"><?php echo $theme_name; ?><a href="https://nknow.top/next-mist" target="_blank"
                                                              data-toggle="tooltip" data-placement="bottom"
                                                              title="点击查看更新"><span class="badge">v1.1.1</span></a></h2>
        <hr class="wp-header-end">
        <hr>
        <form class="form-horizontal" method="post">
            <?php foreach ($options as $value) {
                if ($value['type'] == "text") { ?>
                    <div class="form-group">
                        <label for="options" class="col-sm-2 control-label"><?php echo $value['name']; ?></label>
                        <div class="col-sm-10">
                            <input class="form-control" name="<?php echo $value['id']; ?>"
                                   id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"
                                   value="<?php if (get_settings($value['id']) != "") {
                                       echo stripslashes(get_settings($value['id']));
                                   } else {
                                       echo $value['std'];
                                   } ?>"/>
                        </div>
                    </div>
                <?php } elseif ($value['type'] == "textarea") { ?>
                    <div class="form-group">
                        <label for="options" class="col-sm-2 control-label"><?php echo $value['name']; ?></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" name="<?php echo $value['id']; ?>"
                                      type="<?php echo $value['type']; ?>"><?php if (get_settings($value['id']) != "") {
                                    echo stripslashes(get_settings($value['id']));
                                } else {
                                    echo $value['std'];
                                } ?></textarea>
                        </div>
                    </div>
                <?php } elseif ($value['type'] == "color") { ?>
                    <div class="form-group">
                        <label for="options" class="col-sm-2 control-label"><?php echo $value['name']; ?></label>
                        <div class="col-sm-3">
                            <input name="<?php echo $value['id']; ?>" class="input-color" type="text"
                                   value="<?php if (get_settings($value['id']) != "") {
                                       echo stripslashes(get_settings($value['id']));
                                   } else {
                                       echo $value['std'];
                                   } ?>"/>
                        </div>
                        <div class="col-sm-6">
                            <p class="form-control-static"><?php echo $value['explain']; ?></p>
                        </div>
                    </div>
                <?php } elseif ($value['type'] == "select") { ?>
                    <div class="form-group">
                        <label for="options" class="col-sm-2 control-label"><?php echo $value['name']; ?></label>
                        <div class="col-sm-2">
                            <select class="form-control" name="<?php echo $value['id']; ?>"
                                    id="<?php echo $value['id']; ?>">
                                <?php foreach ($value['options'] as $option) { ?>
                                    <option value="<?php echo $option; ?>" <?php if (get_settings($value['id']) == $option) {
                                        echo 'selected="selected"';
                                    } ?>>
                                        <?php
                                        if ((empty($option) || $option == '') && isset($value['option'])) {
                                            echo $value['option'];
                                        } else {
                                            echo $option;
                                        }
                                        ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } elseif ($value['type'] == "hr") { ?>
                    <hr>
                <?php } ?>
            <?php } ?>
            <div class="form-group" style="margin-top:50px;">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" name="save"> 保存</button>
                    <input type="hidden" name="action" value="save"/>
                </div>
            </div>
        </form>
    </div>
    <script src="<?php bloginfo('template_directory'); ?>/static/jquery/index.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/static/js/bootstrap.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $(function () {
            $('[class="input-color"]').wpColorPicker();
        });
    </script>

    <?php
}

add_action('admin_menu', 'mytheme_add_admin');

/* 动静分离+静态缓存 Static Cache */
//作者部署直接cdn加速，没有用到
//ob_start("Static_Switch");
//function Static_Switch($buffer)
//{
//    if (!is_admin()) {
//        $buffer_out = preg_replace('/https:\/\/www\.rslyycm\.cn\/wp-([^"\']*?)\.(jpg|png|gif|css|js|woff|woff2|ttfi|svg|eot)/i', 'https://static.rslyycm.cn/wp-$1.$2', $buffer);
//        return $buffer_out;
//    } else return $buffer;
//}

//去除部分垃圾评论
function refused_spam_comments($comment_data)
{
    $pattern = '/[一-龥]/u';
    if (!preg_match($pattern, $comment_data['comment_content'])) {
        ;
//;        err("You should type some Chinese word (like \"你好\") in your comment to pass the spam-check, thanks for your patience!");
    }
    return ($comment_data);
}

add_filter('preprocess_comment', 'refused_spam_comments');

//文章浏览次数
function set_post_views()
{
    if (is_singular()) {
        global $post;
        $post_ID = $post->ID;
        if ($post_ID) {
            $post_views = (int)get_post_meta($post_ID, 'views', true);
            if (!update_post_meta($post_ID, 'views', ($post_views + 1))) {
                add_post_meta($post_ID, 'views', 1, true);
            }
        }
    }
}
add_action('get_header', 'set_post_views');

function get_post_views($before = ' ', $after = '', $echo = 1)
{
    global $post;
    $post_ID = $post->ID;
    $views = (int)get_post_meta($post_ID, 'views', true);
    if ($echo) echo $before, number_format($views), $after;
    else return $views;
}

//修改分类列表样式
function customize_wp_list_categories($output)
{
    $output = preg_replace('/ class="([^\"]*)"/isU', ' class="category-list-item"', $output);

    $pattern = '/<\/a>\s\((\d+)\)\s/i';
    $replacement = '</a><span class="category-list-count">$1</span>';
    $output = preg_replace($pattern, $replacement, $output);
    $output = preg_replace('/<a/isU', '<a class="category-list-link"', $output);

    return $output;
}

add_filter('wp_list_categories', 'customize_wp_list_categories');

//文章底部tag增加标签前缀
function add_the_tags($output)
{
    $output = preg_replace('/ class="([^\"]*)"/isU', ' class="category-list-item"', $output);

    $pattern = '/"tag">/i';
    $replacement = '"tag"><i class="fa fa-tags"></i>';
    $output = preg_replace($pattern, $replacement, $output);
    return $output;
}
add_filter('the_tags', 'add_the_tags');


//文章归档
function get_archives_list()
{
    if (!$output = get_option('zww_archives_list')) {
        $the_query = new WP_Query('post_status=publish&posts_per_page=-1&ignore_sticky_posts=1'); //update: 加上忽略置顶文章
        $pre_year = 0;
        while ($the_query->have_posts()) :
            $the_query->the_post();
            $year = get_the_time('Y');
            if ($year != $pre_year) {
                $pre_year = $year;
                ?>
                <div class="collection-title">
                    <h2 class="archive-year motion-element"
                        id="archive-year-<?php echo $year; ?>"><?php echo $year; ?></h2>
                </div>
                <article class="post post-type-normal" itemscope="" itemtype="http://schema.org/Article">
                <header class="post-header">
                    <h1 class="post-title">
                        <a class="post-title-link"
                           href="<?php echo get_permalink();?>" itemprop="url">
                            <span itemprop="name"><?php echo get_the_title(); ?></span>
                        </a>
                    </h1>
                    <div class="post-meta">
                        <time class="post-time" itemprop="dateCreated"
                              datetime="<?php echo get_the_time('Y-m-d G:i:s'); ?>"
                              content="<?php echo get_the_time('Y-m-d'); ?>">
                            <?php echo get_the_time('m-d'); ?>
                        </time>
                    </div>
                </header>
                </article><?php

            } else {
                $pre_year = $year; ?>
                <article class="post post-type-normal" itemscope="" itemtype="http://schema.org/Article">
                <header class="post-header">
                    <h1 class="post-title">
                        <a class="post-title-link"
                           href="<?php echo get_permalink(); ?>" itemprop="url">
                            <span itemprop="name"><?php echo get_the_title(); ?></span>
                        </a>
                    </h1>
                    <div class="post-meta">
                        <time class="post-time" itemprop="dateCreated"
                              datetime="<?php echo get_the_time('Y-m-d G:i:s'); ?>"
                              content="<?php echo get_the_time('Y-m-d'); ?>">
                            <?php echo get_the_time('m-d'); ?>
                        </time>
                    </div>
                </header>
                </article><?php
            }
        endwhile;
        wp_reset_postdata();
        update_option('get_archives_list', $output);
    }
}
?>