<?php
$categories = get_categories(
	array(
		'orderby' => 'name',
		'order'   => 'ASC',
	)
);

if ( $categories ) :
	?>
	<div class="sidebar__category">
		<h3>Post Categories</h3>
		<ul>
			<?php
			foreach ( $categories as $category ) :
				$category_name = $category->name;
				$category_url  = get_category_link( $category->term_id );
				?>
				<li>
					<i></i>
					<a href="<?php echo esc_attr( esc_url( $category_url ) ); ?>" title="<?php echo esc_attr( $category_name ); ?>">
						<?php echo esc_html( $category_name ); ?>
					</a>
					<span>( <?php echo esc_html( $category->count ); ?> )</span>
				</li>
			<?php
			endforeach;
			?>
		</ul>
	</div>
<?php
endif;
