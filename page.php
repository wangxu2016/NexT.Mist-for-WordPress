<?php get_header(); ?>
<main id="main" class="main">
    <div class="main-inner">
        <div class="content-wrap">
            <div id="content" class="content">
                <div id="posts" class="posts-expand">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                    <?php endwhile; else: ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
        <?php get_footer(); ?>