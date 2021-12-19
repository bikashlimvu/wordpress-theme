<?php
/**
 * Breadcrumbs
 */
?>
<ul class="breadcrumbs">
	<li>
		<a href="/">Home</a>
	</li>
	<?php
	$crumbs = explode( '/', $_SERVER['REQUEST_URI'] );

	$is_category = false;
	foreach ( $crumbs as $key => $crumb ) {
		// Check if the breadcrumb is used on a category page
		if ( 'category' === $crumb ) {
			$is_category = true;
		}

		// Remove the page link from the breadcrumb if it is a category page
		if ( $is_category && 'page' === $crumb ) {
			unset( $crumbs[ $key ] );
		}

		if ( empty( $crumb ) ) {
			unset( $crumbs[ $key ] );
		}
	}

	// Get Posts home page url
	$blog_page_id    = get_option( 'page_for_posts' );
	$blog_page_title = get_the_title( get_option( 'page_for_posts' ) );
	if ( get_option( 'page_for_posts' ) ) {
		$blog_url = esc_url( get_permalink( $blog_page_id ) );
	} else {
		$blog_url = esc_url( home_url( '/?post_type=post' ) );
	}

	$currentURL = site_url( '/' );
	$count      = count( $crumbs );
	$i          = 1;

	foreach ( $crumbs as $crumb ) {
		// if it is a category page and last breadcrumb link
		// Also check if the last breadcrumb link is a number - If it is not a pagination number than it should be skipped
		if ( $is_category && count( $crumbs ) === $i && 0 !== (int) $crumb ) {
			// Add 'page' to the pagination url in the breadcrumb
			$currentURL .= 'page/' . $crumb . '/';
			$currentURL  = str_replace( '/wp/', '/', $currentURL );

			// Add 'page' text to the pagination number in the breadcrumb
			$crumb = 'Page ' . $crumb;
		} else {
			$currentURL .= $crumb . '/';
			$currentURL  = str_replace( '/wp/', '/', $currentURL );
		}

		// Add blog home url
		if ( 1 === $i && is_singular( 'post' ) ) :
			?>
			<li>
				<a href="<?php echo esc_attr( esc_url( $blog_url ) ); ?>"><?php echo esc_html( $blog_page_title ); ?></a>
			</li>
			<?php
		endif;


		if ( $i !== $count ) :
			if ( 'category' !== $crumb ) :
				?>
				<li>
					<?php if ( 'tag' !== $crumb ) : ?>
						<a href="<?php echo esc_url( $currentURL ); ?>">
					<?php endif; ?>
						<?php echo esc_html( ucWords( str_replace( array( '.php', '_', '-' ), array( '', ' ', ' ' ), $crumb ) . '' ) ); ?>
					<?php if ( 'tag' !== $crumb ) : ?>
						</a>
					<?php endif; ?>
				</li>
				<?php
		endif;
		else :
			?>
			<li>
				<?php if ( is_search() ) : ?>
					<?php echo esc_html( 'Search Results for ' . "'" . esc_attr( get_search_query() ) . "'" ); ?>
				<?php elseif ( is_404() ) : ?>
					<?php echo esc_html( '404 - Page Not Found!' ); ?>
				<?php else : ?>
					<?php echo esc_html( ucWords( str_replace( array( '.php', '_', '-' ), array( '', ' ', ' ' ), $crumb ) . '' ) ); ?>
				<?php endif; ?>
			</li>
			<?php
		endif;
		$i++;
	}
	?>
</ul>
