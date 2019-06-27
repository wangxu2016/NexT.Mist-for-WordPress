<?php
/*
Template Name: categorys
*/
?>
<?php get_header(); ?>
    <main id="main" class="main">
    <div class="main-inner">
    <div class="content-wrap">
        <div id="content" class="content">
            <div id="posts" class="posts-expand">
                <div class="category-all-page">
                    <div class="category-all-title">
                        <?php $list = wp_list_categories('depth=1&title_li=0&orderby=id&show_count=1&echo=0'); ?>
                        目前共计 <?php echo substr_count($list,'category-list-item')?> 个分类
                    </div>
                    <div class="category-all">
                        <ul class="category-list">
                            <?php echo $list;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>