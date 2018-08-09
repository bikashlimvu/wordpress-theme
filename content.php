<div class="centering">
    <?php get_template_part('components/hero'); ?>
    <section class="section has-padding" id="about-me">
        <h2>About me</h2>
        <?php the_content(); ?>
    </section>
    <?php get_template_part('components/skills'); ?>
    <?php get_template_part('components/experience'); ?>
    <section class="section has-padding">
        <h2>Contact me</h2>
            <?php echo do_shortcode('[contact-form-7 id="169" title="Contact form 1"]'); ?>
    </section>
</div>
