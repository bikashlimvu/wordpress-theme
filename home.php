<?php
get_header();
?>
	<main>
		<?php
		if ( have_posts() ) :
			?>
			<section class="post-list">
				<div class="post-list__container">
					<div class="post-list__row">
						<div class="post-list__content">
							<div class="post-list__grid-sizer"></div>
							<?php
							while ( have_posts() ) :
								the_post();
								$post_item_ID        = get_the_ID();
								$post_title          = get_the_title();
								$post_url            = get_the_permalink();
								$post_date           = get_the_date( 'F j, Y' );
								$post_category       = get_the_category();
								$post_excerpt        = get_the_excerpt();
								$post_thumbnail_url  = get_the_post_thumbnail_url( $post_item_ID, 'services' );
								$post_thumbnail_id   = get_post_thumbnail_id( $post_item_ID );
								$post__thumbnail_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
								?>
								<div class="post-list__item">
									<?php if ( $post_thumbnail_url ) : ?>
										<a href="<?php echo esc_attr( esc_url( $post_url ) ); ?>" title="<?php echo esc_attr( $post_title ); ?>">
											<img src="<?php echo esc_attr( esc_url( $post_thumbnail_url ) ); ?>" alt="<?php echo esc_attr( $post__thumbnail_alt ); ?>">
										</a>
									<?php endif; ?>
									<div class="post-list__item__content">
										<div class="post-list__item__meta">
											<div class="post-list__item__meta__date">
												<?php echo esc_html( $post_date ); ?>
											</div>
											<div class="post-list__item__meta__category">
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
										<h2>
											<a href="<?php echo esc_attr( esc_url( $post_url ) ); ?>" title="<?php echo esc_attr( $post_title ); ?>">
												<?php echo esc_html( $post_title ); ?>
											</a>
										</h2>
										<?php if ( $post_excerpt ) : ?>
											<p><?php echo esc_html( $post_excerpt ); ?></p>
										<?php endif; ?>
										<a href="<?php echo esc_attr( esc_url( $post_url ) ); ?>" class="post-list__item__button">Continue Reading</a>
									</div>
								</div>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
						</div>
						<div class="post-list__pagination">
							<?php page_navi(); ?>
						</div>
					</div>
				</div>
			</section>
			<?php
		endif;
		?>
	</main>
<?php
get_footer();
