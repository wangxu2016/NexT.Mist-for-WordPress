<div class="sidebar-toggle">
    <div class="sidebar-toggle-line-wrap">
        <span class="sidebar-toggle-line sidebar-toggle-line-first"></span>
        <span class="sidebar-toggle-line sidebar-toggle-line-middle"></span>
        <span class="sidebar-toggle-line sidebar-toggle-line-last"></span>
    </div>
</div>
<aside id="sidebar" class="sidebar">
    <div class="sidebar-inner">
        <section class="site-overview sidebar-panel  sidebar-panel-active ">
            <div class="site-author motion-element" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                <img class="site-author-image" itemprop="image" src="<?php echo stripslashes(get_option('my_avatar')); ?>" alt="<?php echo stripslashes(get_option('my_author_name')); ?>">
                <p class="site-author-name" itemprop="name"><?php echo stripslashes(get_option('my_author_name')); ?></p>
                <p class="site-description motion-element" itemprop="description"><?php echo stripslashes(get_option('my_description')); ?></p>
            </div>
            <nav class="site-state motion-element">
                <div class="site-state-item site-state-posts">
                    <a href="/archives">
                        <span class="site-state-item-count"><?php echo wp_count_posts()->publish;?></span>
                        <span class="site-state-item-name">日志</span>
                    </a>
                </div>
                <div class="site-state-item site-state-categories">
                    <a href="/category">
                        <span class="site-state-item-count"><?php echo wp_count_terms('category'); ?></span>
                        <span class="site-state-item-name">分类</span>
                    </a>
                </div>
                <div class="site-state-item site-state-tags">
                    <a href="/tags">
                        <span class="site-state-item-count"><?php echo wp_count_terms('post_tag'); ?></span>
                        <span class="site-state-item-name">标签</span>
                    </a>
                </div>
            </nav>
            <?php if (get_option('my_rss') == '显示') { ?>
            <div class="feed-link motion-element">
                <a href="<?php bloginfo('rss2_url'); ?>" rel="alternate" target="_blank">
                    <i class="fa fa-rss"></i>
                    RSS
                </a>
            </div>
            <?php } ?>
            <div class="links-of-author motion-element">
                <?php if (get_option('my_weibo') == '显示') { ?>
                    <span class="links-of-author-item">
                    <a href="<?php echo stripslashes(get_option('my_weibo_url')); ?>" target="_blank" title="weibo">
                        <i class="fa fa-weibo"></i>
                        weibo
                    </a>
                </span>
                <?php } ?>
                <?php if (get_option('my_github') == '显示') { ?>
                    <span class="links-of-author-item">
                    <a href="<?php echo stripslashes(get_option('my_github_url')); ?>" target="_blank" title="github">
                        <i class="fa fa-github"></i>
                        github
                    </a>
                </span>
                <?php } ?>
                <?php if (get_option('my_twitter') == '显示') { ?>
                    <span class="links-of-author-item">
                    <a href="<?php echo stripslashes(get_option('my_twitter_url')); ?>" target="_blank"
                       title="twitter">
                        <i class="fa fa-twitter"></i>
                        twitter
                    </a>
                </span>
                <?php } ?>
                <?php if (get_option('my_facebook') == '显示') { ?>
                    <span class="links-of-author-item">
                    <a href="<?php echo stripslashes(get_option('my_facebook_url')); ?>" target="_blank"
                       title="facebook">
                        <i class="fa fa-facebook"></i>
                        facebook
                    </a>
                </span>
                <?php } ?>
            </div>
            <div class="links-of-author motion-element">
                <p class="site-author-name">友情链接</p>
                <span class="links-of-author-item">
                    <?php $resul = $wpdb->get_results("SELECT link_ID,link_url,link_name,link_description,link_target FROM $wpdb->links where link_visible ='y' ORDER BY rand() LIMIT 0 , 10");
                    foreach ($resul as $links) {
                        setup_postdata($links);
                        $link_url = $links->link_url;
                        $link_name = $links->link_name;
                        $link_target = $links->link_target;

                        ?>
                        <a href="<?php echo $link_url ?>"
                           target="<?php echo $link_target;?>"><?php echo $link_name; ?></a>
                    <?php } ?>
                </span>
            </div>
        </section>
    </div>
</aside>
</div>
</main>