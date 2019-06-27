<?php get_header(); ?>
<main id="main" class="main">
    <div class="main-inner">
        <?php while (have_posts()) : the_post(); ?>
            <div class="content-wrap">
                <div id="content" class="content">
                    <div id="posts" class="posts-expand">
                        <article class="post post-type-normal" itemscope="" itemtype="http://schema.org/Article">
                            <header class="post-header">
                                <h1 class="post-title" itemprop="name headline">
                                    <?php the_title(); ?>
                                </h1>
                                <div class="post-meta">
                                    <span class="post-time">
                                      <span class="post-meta-item-icon">
                                        <i class="fa fa-calendar-o"></i>
                                      </span>
                                      <span class="post-meta-item-text">发表于</span>
                                      <time itemprop="dateCreated" datetime="<?php the_time('Y-m-d H:i'); ?>"
                                            content="<?php the_time('Y-m-d H:i'); ?>">
                                                                    <?php the_time('Y-m-d'); ?>
                                      </time>
                                    </span>
                                    <span class="post-category">
                                        &nbsp; | &nbsp;
                                        <span class="post-meta-item-icon">
                                          <i class="fa fa-folder-o"></i>
                                        </span>
                                        <span class="post-meta-item-text">分类于</span>
                                    <?php
                                    $first_name = get_the_category()[0]->cat_name;
                                    $cat = get_category_by_slug($first_name);
                                    $cat_links = get_category_link($cat->term_id);
                                    ?>
                                        <span itemprop="about" itemscope="" itemtype="https://schema.org/Thing">
                                          <a href="<?php echo $cat_links; ?>" itemprop="url" rel="index">
                                            <span itemprop="name"><?php echo $first_name; ?></span>
                                          </a>
                                        </span>
                                    </span>
                                    <span id="<?php echo get_permalink(); ?>" class="leancloud_visitors"
                                          data-flag-title="<?php the_title(); ?>">
                                         &nbsp; | &nbsp;
                                        <span class="post-meta-item-icon">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                        <span class="post-meta-item-text">阅读次数 </span>
                                        <span class="leancloud-visitors-count"><?php get_post_views();?></span>
                                    </span>
                                </div>
                            </header>
                            <div class="post-body" itemprop="articleBody">
                                <?php the_content(); ?>
                            </div>
                            <div class="post-tags">
                                <?php the_tags('', ''); ?>
                            </div>
                            <!--这里是文章评论-->
                            <div class="comments" id="comments">
                                <div id="disqus_thread">
                                    <?php comments_template(); ?>
                                </div>
                            </div>
                            <?php if (get_option('my_subscriber_flag') == '启用') { ?>
                            <div>
                                <hr>
                                <div id="wechat_subscriber" style="display: block; padding: 10px 0; margin: 20px auto; width: 100%; text-align: center">
                                    <a href="<?php echo get_option('my_subscribe'); ?>" class="fancybox" rel="group"><img id="wechat_subscriber_qcode" src="<?php echo get_option('my_subscribe'); ?>" alt="hoxis wechat" style="width: auto; height:200px; max-width: 100%;"></a>
                                </div>
                                <div class="copyright-txt">
                                    <a href="/copyright"><i class="fa fa-copyright"></i>著作权归作者所有</a>
                                </div>
                            </div>
                            <?php } else{ ?>
                                <div>
                                    <hr>
                                    <div class="copyright-txt">
                                        <a href="/copyright"><i class="fa fa-copyright"></i>著作权归作者所有</a>
                                    </div>
                                </div>
                            <?php }?>
                            <footer class="post-footer">
                                <div class="post-nav">
                                    <div class="post-nav-next post-nav-item">
                                        <?php if (get_previous_post()) {
                                            previous_post_link('<i class="fa fa-chevron-left"></i> %link');
                                        } ?>
                                    </div>
                                    <div class="post-nav-prev post-nav-item">
                                        <?php if (get_next_post()) {
                                            next_post_link('%link<i class="fa fa-chevron-right"></i>');
                                        } ?>
                                    </div>
                                </div>
                            </footer>
                        </article>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php get_sidebar('article'); ?>
        <?php get_footer('article'); ?>