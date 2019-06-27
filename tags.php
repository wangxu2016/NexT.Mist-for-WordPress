<?php
/*
Template Name: tags
*/
?>
<?php get_header() ?>
<main id="main" class="main">
    <div class="main-inner">
        <div class="content-wrap">
            <div id="content" class="content">
                <div id="posts" class="posts-expand">
                    <div class="tag-cloud">
                        <div class="tag-cloud-title">
                            目前共计 <?php echo wp_count_terms('post_tag'); ?> 个标签
                        </div>
                        <div class="tag-cloud-tags">
                            <?php wp_tag_cloud('smallest=12&largest=30&unit=px&number=0&orderby=name&order=DESC'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
        <?php get_footer() ?>