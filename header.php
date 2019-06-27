<!doctype html>
<html class="theme-next mist use-motion">
<head>
    <meta name="generator" content="Hexo 3.8.0">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <link href="<?php bloginfo('template_directory'); ?>/static/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css">
    <link href="<?php bloginfo('template_directory'); ?>/static/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <meta name="author" content="<?php echo stripslashes(get_option('my_author_name')); ?>">
    <?php if (is_home()) { ?>
        <title><?php bloginfo('name'); ?></title>
        <meta name="keywords" content="<?php echo stripslashes(get_option('my_keywords')); ?>">
        <meta name="description" content="<?php echo stripslashes(get_option('my_description')); ?>">
    <?php } ?>
    <?php
    if (!function_exists('utf8Substr')) {
        function utf8Substr($str, $from, $len)
        {
            return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $from . '}' . '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $len . '}).*#s', '$1', $str);
        }
    }
    if (is_single()) {
        if ($post->post_excerpt) {
            $description = $post->post_excerpt;
        } else {
            if (preg_match('/<p>(.*)<\/p>/iU', trim(strip_tags($post->post_content, "<p>")), $result)) {
                $post_content = $result['1'];
            } else {
                $post_content_r = explode("\n", trim(strip_tags($post->post_content)));
                $post_content = $post_content_r['0'];
            }
            $description = utf8Substr($post_content, 0, 220);
        }
        $keywords = "";
        $tags = wp_get_post_tags($post->ID);
        foreach ($tags as $tag) {
            $keywords = $keywords . $tag->name . ",";
        }
    }
    ?>
    <?php if (is_single()) { ?>
        <title><?php echo trim(wp_title('', 0)); ?></title>
        <meta name="description" content="<?php echo trim($description); ?>"/>
        <meta name="keywords" content="<?php echo rtrim($keywords, ','); ?>"/>
    <?php } ?>
    <?php if (is_page()) { ?>
        <title><?php echo trim(wp_title('', 0)); ?></title>
        <meta name="keywords" content="<?php echo stripslashes(get_option('my_keywords')); ?>">
        <meta name="description" content="<?php echo stripslashes(get_option('my_description')); ?>">
    <?php } ?>
    <?php if (is_category()) { ?>
        <title><?php single_cat_title(); ?> | <?php bloginfo('name'); ?></title>
        <meta name="keywords" content="<?php echo stripslashes(get_option('my_keywords')); ?>">
        <meta name="description" content="<?php echo stripslashes(get_option('my_description')); ?>">
    <?php } ?>
    <?php if (is_search()) { ?>
        <title>搜索结果 | <?php bloginfo('name'); ?></title>
        <meta name="keywords" content="<?php echo stripslashes(get_option('my_keywords')); ?>">
        <meta name="description" content="<?php echo stripslashes(get_option('my_description')); ?>">
    <?php } ?>
    <?php if (is_day()) { ?>
        <title><?php the_time('Y年n月j日'); ?> | <?php bloginfo('name'); ?></title>
        <meta name="keywords" content="<?php echo stripslashes(get_option('my_keywords')); ?>">
        <meta name="description" content="<?php echo stripslashes(get_option('my_description')); ?>">
    <?php } ?>
    <?php if (is_month()) { ?>
        <title><?php the_time('Y年M'); ?> | <?php bloginfo('name'); ?></title>
        <meta name="keywords" content="<?php echo stripslashes(get_option('my_keywords')); ?>">
        <meta name="description" content="<?php echo stripslashes(get_option('my_description')); ?>">
    <?php } ?>
    <?php if (is_year()) { ?>
        <title><?php the_time('Y年'); ?> | <?php bloginfo('name'); ?></title>
        <meta name="keywords" content="<?php echo stripslashes(get_option('my_keywords')); ?>">
        <meta name="description" content="<?php echo stripslashes(get_option('my_description')); ?>">
    <?php } ?>
    <?php if (is_404()) { ?>
        <title>页面不见了 | <?php bloginfo('name'); ?></title>
        <meta name="keywords" content="<?php echo stripslashes(get_option('my_keywords')); ?>">
        <meta name="description" content="<?php echo stripslashes(get_option('my_description')); ?>">
    <?php } ?>
    <?php if (function_exists('is_tag')) {
        if (is_tag()) { ?>
            <title><?php single_tag_title("", true); ?> | <?php bloginfo('name'); ?></title>
            <meta name="keywords" content="<?php echo stripslashes(get_option('my_keywords')); ?>">
            <meta name="description" content="<?php echo stripslashes(get_option('my_description')); ?>">
        <?php }
    } ?>
    <?php wp_head(); ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/static/icon/favicon.ico">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php bloginfo('name'); ?>">
    <meta property="og:url" content="<?php echo home_url();?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta property="og:description" content="<?php echo stripslashes(get_option('my_description')); ?>">
    <meta property="og:locale" content="zh-Hans">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php echo stripslashes(get_option('my_description')); ?>">
    <link href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" id="hexo.configuration">
        var NexT = window.NexT || {};
        var CONFIG = {
            scheme: 'Mist',
            sidebar: {"position": "left", "display": "post"},
            fancybox: true,
            motion: true,
            duoshuo: {
                userId: 666,
                author: '<?php echo stripslashes(get_option("my_author_name")); ?>'
            }
        };
    </script>
</head>
<body itemscope="" itemtype="http://schema.org/WebPage" lang="zh-Hans">
<div class="container one-collumn sidebar-position-left page-home">
    <!--header-->
    <div class="headband"></div>
    <header id="header" class="header" itemscope="" itemtype="http://schema.org/WPHeader">
        <div class="header-inner">
            <div class="site-meta ">
                <div class="custom-logo-site-title">
                    <a href="/" class="brand" rel="start">
                        <span class="logo-line-before"><i></i></span>
                        <span class="site-title"><?php bloginfo('name'); ?></span>
                        <span class="logo-line-after"><i></i></span>
                    </a>
                </div>
                <p class="site-subtitle"><?php echo stripslashes(get_option('my_description')); ?></p>
            </div>
            <div class="site-nav-toggle">
                <button>
                    <span class="btn-bar"></span>
                    <span class="btn-bar"></span>
                    <span class="btn-bar"></span>
                </button>
            </div>
            <nav class="site-nav">
                <ul id="menu" class="menu menu-left">
                    <li class="menu-item menu-item-home">
                        <a href="/" rel="section">
                            <i class="menu-item-icon fa fa-home fa-fw"></i> <br>
                            首页
                        </a>
                    </li>
                    <li class="menu-item menu-item-archives">
                        <a href="/archives" rel="section">
                            <i class="menu-item-icon fa fa-archive fa-fw"></i> <br>
                            归档
                        </a>
                    </li>
                    <li class="menu-item menu-item-categories">
                        <a href="/category" rel="section">
                            <i class="menu-item-icon fa fa-th fa-fw"></i> <br>
                            分类
                        </a>
                    </li>
                    <li class="menu-item menu-item-tags">
                        <a href="/tags" rel="section">
                            <i class="menu-item-icon fa fa-tags fa-fw"></i> <br>
                            标签
                        </a>
                    </li>
                    <li class="menu-item menu-item-about">
                        <a href="/about" rel="section">
                            <i class="menu-item-icon fa fa-user fa-fw"></i> <br>
                            关于
                        </a>
                    </li>
                </ul>
                <div class="site-search">
                    <form class="site-search-form" action="<?php bloginfo('siteurl'); ?>">
                        <input type="text" id="st-search-input" class="st-search-input st-default-search-input" placeholder="搜索…" value="<?php the_search_query(); ?>" name="s">
                    </form>
                </div>
            </nav>
        </div>
    </header>