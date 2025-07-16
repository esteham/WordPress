<footer class="bg-dark text-white py-5 mt-5">
    <div class="container">
        <div class="row">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <div class="col-md-4">
                    <?php if (is_active_sidebar("footer$i")): ?>
                        <?php dynamic_sidebar("footer$i"); ?>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
        <p class="text-center mt-4 mb-0">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
