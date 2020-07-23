<?php

/**
 * Cities content template.
 *
 * @package understrap
 */

// Exit if accessed directly.
?>
<div class="col-md-6 mt-5">
	<div class="card">
		<img class="card-img-top" src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="">
		<div class="card-body">
			<a href="<?php esc_url(the_permalink()); ?>">
				<h4 class="card-title text-center"><?php esc_html(the_title()) ?></h4>
			</a>
			<p class="card-text"><?php esc_html(the_excerpt()) ?></p>
		</div>
	</div>
</div>