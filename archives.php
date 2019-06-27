<?php
/*
Template Name: archives
*/
?>
<?php get_header() ?>
<main id="main" class="main">
    <div class="main-inner">
        <div class="content-wrap">
            <div id="content" class="content">
                <section id="posts" class="posts-collapse">
                    <span class="archive-move-on"></span>
                    <span class="archive-page-counter">
                            很好! 目前共计 <?php $count_posts = wp_count_posts(); echo  $count_posts->publish;?> 篇日志。 继续努力。
                    </span>
                    <?php get_archives_list();?>
                </section>
            </div>
        </div>
        <div class="sidebar-toggle">
            <div class="sidebar-toggle-line-wrap">
                <span class="sidebar-toggle-line sidebar-toggle-line-first"></span>
                <span class="sidebar-toggle-line sidebar-toggle-line-middle"></span>
                <span class="sidebar-toggle-line sidebar-toggle-line-last"></span>
            </div>
        </div>
        <?php get_sidebar(); ?>
<?php get_footer() ?>