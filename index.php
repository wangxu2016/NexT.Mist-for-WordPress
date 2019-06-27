<?php get_header(); ?>
        <main id="main" class="main">
            <div class="main-inner">
                <div class="content-wrap">
                    <div id="content" class="content">
                        <section id="posts" class="posts-expand">
                            <?php if(have_posts()) : ?>
                            <?php while(have_posts()) : the_post(); ?>
                            <article class="post post-type-normal " itemscope="" itemtype="http://schema.org/Article">
                                <header class="post-header">
                                    <h1 class="post-title" itemprop="name headline">
                                        <a class="post-title-link" href="<?php the_permalink(); ?>" itemprop="url"><?php the_title() ?></a>
                                    </h1>
                                    <div class="post-meta">
                                    <span class="post-time">
                                        <span class="post-meta-item-icon"><i class="fa fa-calendar-o"></i></span>
                                        <span class="post-meta-item-text">发表于</span>
                                        <time itemprop="dateCreated" datetime="<?php the_time('m月d日') ?>"
                                              content="<?php the_time('m月d日') ?>>"><?php the_time('Y-m-d') ?>
                                        </time>
                                    </span>
                                        <span class="post-category">
                                        &nbsp; | &nbsp;
                                        <span class="post-meta-item-icon">
                                            <i class="fa fa-folder-o"></i>
                                        </span>
                                        <span class="post-meta-item-text">分类于</span>
                                        <span itemprop="about" itemscope="" itemtype="https://schema.org/Thing">
                                            <?php
                                            $first_name = get_the_category()[0]->cat_name;
                                            $cat=get_category_by_slug($first_name);
                                            $cat_links=get_category_link($cat->term_id);
                                            ?>
                                            <a href="<?php echo $cat_links;?>" itemprop="url" rel="index">

                                                <span itemprop="name"><?php echo $first_name; ?> </span>
                                            </a>
                                        </span>
                                    </span>
                                    <span class="post-comments-count">
                                            <a href="<?php the_permalink(); ?>" itemprop="discussionUrl">
                                                <span class="post-comments-count disqus-comment-count" data-disqus-identifier="<?php the_permalink(); ?>/" itemprop="commentsCount">
                                                </span>
                                            </a>
                                        </span>
					                </span>
                                        <span id="<?php the_permalink(); ?>"
                                              class="leancloud_visitors" data-flag-title="<?php the_title() ?>">
                                            &nbsp; | &nbsp;
                                        <span class="post-meta-item-icon">
                                            <i class="fa fa-eye"></i> <?php get_post_views(); ?>
                                        </span>
                                        <span class="post-meta-item-text">阅读次数 <?php get_post_views(); ?></span>
                                        <span class="leancloud-visitors-count"></span>
                                    </span>
                                    </div>
                                </header>
                                <div class="post-body" itemprop="articleBody">
                                    <?php the_excerpt(); ?>
                                    <div class="post-more-link text-center">
                                        <a class="btn" href="<?php the_permalink(); ?>" rel="contents">阅读全文 &raquo;</a>
                                    </div>
                                </div>
                                <div>
                                </div>
                                <footer class="post-footer">
                                    <div class="post-eof"></div>
                                </footer>
                            </article>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </section>
                        <?php pagination($query_string); ?>
                    </div>
                </div>
            <?php get_sidebar(); ?>
<?php get_footer(); ?>