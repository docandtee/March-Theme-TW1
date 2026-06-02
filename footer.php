<?php
/**
 * Theme footer template.
 *
 * @package TailPress
 */
?>
        </main>
        <?php do_action('tailpress_content_end'); ?>
    </div><!-- #content -->

    <?php get_template_part('template-parts/partials/footer-contact'); ?>

    <?php do_action('tailpress_content_after'); ?>

    <footer id="colophon" class="bg-dark" role="contentinfo">
        <div class="container mx-auto py-5 lg:py-10">
            <?php do_action('tailpress_footer'); ?>
            <div class="grid grid-flow-row grid-cols-12">
                <?php dynamic_sidebar('sidebar-footer'); ?>
            </div>
            <div class="flex items-center justify-center flex-wrap">
                <div class="text-sm">
                    &copy; <?php echo esc_html(date_i18n('Y')); ?> - <?php bloginfo('name'); ?>
                </div>
                <a class="text-white text-sm border-start border-white ps-2 ms-2" href="https://www.docandtee.com/" target="_blank" rel="external noopener noreferrer" aria-label="Visit the website of Doc and Tee Ltd - opens in new window">
					Website by Doc&amp;Tee <span class="sr-only sr-only-focusable">(opens new window)</span>
				</a>
            </div>
            
        </div>
    </footer>
    
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
