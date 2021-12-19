<?php
/**
 * Social Share Links
 */

$protocol    = ( isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https://' : 'http://' );
$current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if ( isset( $args['vacancy_id'] ) ) {
	$current_url .= '#' . $args['vacancy_id'];
}

global $post;
$page_title = get_the_title( $post->ID );
$page_title = str_replace( '&', 'and', $page_title );
$page_title = str_replace( '#038;', '', $page_title );
?>
<div class="social__content">
	<span>Share</span>
	<ul class="social__list social__list--circle">
		<li class="facebook">
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $current_url ); ?>&t=<?php esc_attr( $page_title ); ?>"
				target="_blank"
				rel="noopener noreferrer"
				title="Share on Facebook">
				<span class="sr-only">Facebook</span>
			</a>
		</li>
		<li class="twitter">
			<a href="https://twitter.com/intent/tweet?source=<?php echo esc_url( $current_url ); ?>&text<?php esc_attr( $page_title ); ?>:<?php echo esc_url( $current_url ); ?>"
				target="_blank"
				rel="noopener noreferrer"
				title="Tweet">
				<span class="sr-only">Twitter</span>
			</a>
		</li>
		<li class="email">
			<a href="mailto:?subject=<?php echo esc_attr( $page_title ); ?>&body=<?php echo esc_attr( $page_title ); ?> : <?php echo esc_url( $current_url ); ?>"
				target="_blank"
				rel="noopener noreferrer"
				title="Email">
				<span class="sr-only">Email</span>
			</a>
		</li>
	</ul>
</div>

