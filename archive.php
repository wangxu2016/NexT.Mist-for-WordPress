<?php get_header(); ?>
<main id="main" class="main">
    <div class="main-inner">
        <div class="content-wrap">
            <div id="content" class="content">
                <div id="posts" class="posts-collapse">
                    <?php if ( is_day() ) : ?>
                        <h2 class="uptop"><i class="fa fa-calendar" aria-hidden="true"></i> <?php printf(__('日期浏览: %s'), get_the_date('Y年n月j日 D') ); ?></h2>
                    <?php elseif ( is_month() ) : ?>
                        <h2 class="uptop"><i class="fa fa-calendar" aria-hidden="true"></i> <?php printf(__('日期浏览: %s'), get_the_date('Y年M') ); ?></h2>
                    <?php elseif ( is_year() ) : ?>
                        <h2 class="uptop"><i class="fa fa-calendar" aria-hidden="true"></i> <?php printf(__('日期浏览: %s'), get_the_date('Y年') ); ?></h2>
                    <?php elseif ( is_tag() ) : ?>
                        <h2 class="uptop"><i class="fa fa-tags" aria-hidden="true"></i> <?php printf(__('Tag: %s'), single_tag_title('', false ) ); ?></h2>
                    <?php else : ?>
                        <h2 class="uptop"><?php _e( 'Blog Archives' ); ?></h2>
                    <?php endif; ?>
                    <hr>
                    <?php if(have_posts()) : ?>
                        <?php while(have_posts()) : the_post(); ?>
                            <article class="post post-type-normal" itemscope="" itemtype="http://schema.org/Article">
                                <header class="post-header">
                                    <h1 class="post-title" style="margin-left: 80px">
                                        <a class="post-title-link" href="<?php the_permalink(); ?>" itemprop="url">
                                            <span itemprop="name"><?php the_title() ?></span>
                                        </a>
                                    </h1>
                                    <div class="post-meta">
                                        <time class="post-time" itemprop="dateCreated" datetime="<?php the_time('Y-m-d') ?>" content="<?php the_time('Y-m-d') ?>">
                                            <?php the_time('m月d日') ?>
                                        </time>
                                    </div>
                                </header>
                            </article>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="errors_404"><img src="<?php bloginfo('template_directory'); ?>/images/404.png" alt="404"></div>
                    <?php endif; ?>
                </div>
                <?php pagination($query_string); ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
        <?php get_footer(); ?>