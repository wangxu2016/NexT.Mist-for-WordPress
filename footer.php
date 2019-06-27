<footer id="footer" class="footer">
    <div class="footer-inner">
        <div class="copyright">
            <span itemprop="copyrightYear">&copy; <?php echo get_option('my_years'); ?></span>
            <span class="with-love"><i class="fa fa-heart"></i></span>
            <span class="author" itemprop="copyrightHolder"><?php echo stripslashes(get_option('my_author_name')); ?></span>
        </div>
        <div class="powered-by">
            Powered by <a class="theme-link" target="_blank" href="https://cn.wordpress.org/">WordPress</a> | 已运行 <span id="run_time"></span>
        </div>
        <div class="theme-info">Theme By <a class="theme-link" target="_blank" href="https://github.com/wangxu2016/NexT.Mist-for-WordPress">NexT.Mist</a></div>
    </div>
</footer>
<div class="back-to-top"></div>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/static/jquery/index.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/static/fastclick/lib/fastclick.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/static/jquery_lazyload/jquery.lazyload.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/static/velocity/velocity.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/static/velocity/velocity.ui.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/static/fancybox/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/static/js/utils.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/static/js/motion.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/static/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/static/js/main.js"></script>
<script type="text/javascript" id="motion.page.archive">
    $('.archive-year').velocity('transition.slideLeftIn');
</script>
<?php wp_footer(); ?>
<script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      tex2jax: {
        inlineMath: [ ['$','$'], ["\\(","\\)"]  ],
        processEscapes: true,
        skipTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code']
      }
    });
</script>
<script type="text/x-mathjax-config">
    MathJax.Hub.Queue(function() {
      var all = MathJax.Hub.getAllJax(), i;
      for (i=0; i < all.length; i += 1) {
        all[i].SourceElement().parentNode.className += ' has-jax';
      }
    });
</script>
<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML"></script>
<div style="display:none;"><?php echo stripslashes(get_option('my_tongji')); ?></div>
</body>
</html>

<!--
 _          __  _____   _____    _____   _____   _____    _____   _____   _____        __   _   _____  __    __  _____            ___  ___   _   _____   _____
| |        / / /  _  \ |  _  \  |  _  \ |  _  \ |  _  \  | ____| /  ___/ /  ___/      |  \ | | | ____| \ \  / / |_   _|          /   |/   | | | /  ___/ |_   _|
| |  __   / /  | | | | | |_| |  | | | | | |_| | | |_| |  | |__   | |___  | |___       |   \| | | |__    \ \/ /    | |           / /|   /| | | | | |___    | |
| | /  | / /   | | | | |  _  /  | | | | |  ___/ |  _  /  |  __|  \___  \ \___  \      | |\   | |  __|    }  {     | |          / / |__/ | | | | \___  \   | |
| |/   |/ /    | |_| | | | \ \  | |_| | | |     | | \ \  | |___   ___| |  ___| |      | | \  | | |___   / /\ \    | |         / /       | | | |  ___| |   | |
|___/|___/     \_____/ |_|  \_\ |_____/ |_|     |_|  \_\ |_____| /_____/ /_____/      |_|  \_| |_____| /_/  \_\   |_|        /_/        |_| |_| /_____/   |_|

-->