<?php
get_header();
?>
<main>
	<?php
	if ( have_posts() ) :
		?>
		<section class="post-single">
			<div class="post-single__container">
				<div class="post-single__row">
					<?php
					while ( have_posts() ) :
						the_post();
						$post_item_ID        = get_the_ID();
						$post_tags           = get_the_tags();
						$post_date           = get_the_date( 'F j, Y' );
						$post_category       = get_the_category();
						$post_thumbnail_url  = get_the_post_thumbnail_url( $post_item_ID, 'blog' );
						$post_thumbnail_id   = get_post_thumbnail_id( $post_item_ID );
						$post__thumbnail_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
						?>
						<div class="post-single__main">
							<?php if ( $post_thumbnail_url ) : ?>
								<div class="post-single__image">
									<img src="<?php echo esc_attr( esc_url( $post_thumbnail_url ) ); ?>" alt="<?php echo esc_attr( $post__thumbnail_alt ); ?>">
								</div>
							<?php endif; ?>
							<div class="post-single__inner">
								<div class="post-single__meta">
									<div class="post-single__meta__date">
										<?php echo esc_html( $post_date ); ?>
									</div>
									<div class="post-single__meta__category">
										<?php
										if ( $post_category ) {
											foreach ( $post_category as $post_cat ) {
												$post_category_name = $post_cat->name;
												$post_category_id   = $post_cat->term_id;
												$post_category_link = get_category_link( $post_category_id );
												?>
												<a href="<?php echo esc_attr( esc_url( $post_category_link ) ); ?>">
													<?php echo esc_html( $post_category_name ); ?>
												</a>
												<?php
											}
										}
										?>
									</div>
								</div>
								<?php
								// Display post tags
								if ( $post_tags ) :
									?>
									<div class="post-single__tags">
										<?php
										foreach ( $post_tags as $post_tag ) {
											$post_tag_name = $post_tag->name;
											$post_tag_id   = $post_tag->term_id;
											$post_tag_url  = get_tag_link( $post_tag_id );
											?>
												<a href="<?php echo esc_attr( esc_url( $post_tag_url ) ); ?>">
												<?php echo esc_html( $post_tag_name ); ?>
												</a>
												<?php
										}
										?>
									</div>
								<?php endif; ?>
							</div>
							<div class="post-single__pagination">
								<?php
								$previous_post = get_previous_post();
								$next_post     = get_next_post();

								if ( $previous_post ) {
									$previous_post_title         = $previous_post->post_title;
									$previous_post_url           = get_the_permalink( $previous_post->ID );
									$previous_post_thumbnail_url = get_the_post_thumbnail_url( $previous_post->ID, 'thumbnail' );
									$previous_post_thumbnail_id  = get_post_thumbnail_id( $previous_post->ID );
									$previous_post_thumbnail_alt = get_post_meta( $previous_post_thumbnail_id, '_wp_attachment_image_alt', true );
								}

								if ( $next_post ) {
									$next_post_title         = $next_post->post_title;
									$next_post_url           = get_the_permalink( $next_post->ID );
									$next_post_thumbnail_url = get_the_post_thumbnail_url( $next_post->ID, 'thumbnail' );
									$next_post_thumbnail_id  = get_post_thumbnail_id( $next_post->ID );
									$next_post_thumbnail_alt = get_post_meta( $next_post_thumbnail_id, '_wp_attachment_image_alt', true );
								}
								?>
								<?php if ( $previous_post ) : ?>
									<a href="<?php echo esc_attr( esc_url( $previous_post_url ) ); ?>" class="post-single__pagination__left">
										<div class="post-single__pagination__text">
											<span>Previous Post</span>
											<h6><?php echo esc_html( $previous_post_title ); ?></h6>
										</div>
										<?php if ( $previous_post_thumbnail_url ) : ?>
											<img src="<?php echo esc_attr( esc_url( $previous_post_thumbnail_url ) ); ?>" alt="<?php echo esc_attr( $previous_post_thumbnail_alt ); ?>">
										<?php endif; ?>
									</a>
								<?php endif; ?>
								<?php if ( $next_post ) : ?>
									<a href="<?php echo esc_attr( esc_url( $next_post_url ) ); ?>" class="post-single__pagination__right">
										<div class="post-single__pagination__text">
											<span>Next Post</span>
											<h6><?php echo esc_html( $next_post_title ); ?></h6>
										</div>
										<?php if ( $next_post_thumbnail_url ) : ?>
											<img src="<?php echo esc_attr( esc_url( $next_post_thumbnail_url ) ); ?>" alt="<?php echo esc_attr( $next_post_thumbnail_alt ); ?>">
										<?php endif; ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
						<?php
					endwhile;
					?>
					<aside class="post-single__sidebar sidebar">
					</aside>
				</div>
			</div>
		</section>
		<?php
	endif;
	?>
</main>
<?php get_footer(); ?>
