<section class="section has-padding">
    <h2>Experience</h2>

    <?php
        $args = array(
            'order'            => 'ASC',
            'post_type'        => 'post',
            'post_status'      => 'publish',
        );
        $posts_array = get_posts( $args );

        foreach ( $posts_array as $post ) : setup_postdata( $post );

        $company_name = get_field('company_name');
    ?>
        <div class="job">
            <div class="job-meta">
                <h3 class="job-title"><?php the_title(); ?></h3>
                <span class="sub-heading">Company</span>
                <p><?php echo $company_name; ?></p>
            </div>
            <div class="description">
                <span class="sub-heading">Job Description</span>
                <?php the_content(); ?>
            </div>
        </div>
    <?php
        endforeach;
        wp_reset_postdata();
    ?>
</section>
