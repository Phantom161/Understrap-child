<?php

/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>

		<div class="entry-meta">

			<?php understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail($post->ID, 'large'); ?>

	<div class="entry-content">
		<?php if (get_field('informacziya')) { ?>
		<div class="realty-info mt-4 mb-4 row">
			<?php if (get_field('informacziya_ploshhad')) { ?>
			<div class="col">
				<p>Площадь:</p>
				<span><?php esc_html__(the_field('informacziya_ploshhad')); ?> м<sup>2</sup></span>
			</div>
			<?php }
				if (get_field('informacziya_zhilaya_ploshhad')) { ?>
			<div class="col">
				<p>Жилая площадь:</p>
				<span><?php esc_html__(the_field('informacziya_zhilaya_ploshhad')); ?> м<sup>2</sup></span>
			</div>
			<?php }
				if (get_field('informacziya_etazh')) { ?>
			<div class="col">
				<p>Этаж:</p>
				<span><?php esc_html__(the_field('informacziya_etazh')); ?></span>
			</div>
			<?php }
				if (get_field('informacziya_stoimost')) { ?>
			<div class="col">
				<p>Стоимость:</p>
				<?php
						$price = get_field('informacziya_stoimost');
						$price = number_format($price, 0, ',', ' ');
						echo '<span>' . $price . ' руб.</span>';
						?>
			</div>
			<?php }
				if (get_field('informacziya_adres')) { ?>

			<div class="col-md-12">
				<hr>
				<p><strong>Адрес:</strong></p>
				<p><?php esc_html__(the_field('informacziya_adres')); ?></p>
			</div>
			<?php } ?>
		</div>
		<?php } ?>

		<?php the_content(); ?>

		<?php
		$realty = get_posts([
			'post_type' => 'realty',
			'post_parent' => $post->ID,
			'posts_per_page' => 10,
			'orderby' => 'post_title',
			'order' => 'ASC',
		]);

		if ($realty) {
			global $post;

			foreach ($realty as $value) {
				setup_postdata($post);

				echo '<p class="lead"><a href="/realty/' . $value->post_name . '" >' . $value->post_title . '</a></p>';
			}

			// вернем $post Обратно
			wp_reset_postdata();
		}

		?>


		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->