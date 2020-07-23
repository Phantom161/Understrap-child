<?php

/**
 * Realty content template.
 *
 * @package understrap
 */

// Exit if accessed directly.
?>
<div class="col-md-12 mt-5">
	<div class="card profile-header">
		<div class="body">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-12">
					<div class="profile-image float-md-right d-flex align-middle" style="height: 200px;"> <img
							src="<?php esc_url(the_post_thumbnail_url()); ?>" alt="">
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-12 pt-3">
					<a href="<?php esc_url(the_permalink()); ?>">
						<h4 class="mt-0 mb-0"><?php esc_html(the_title()) ?></h4>
					</a>
					<?php
					if (get_field('informacziya_stoimost')) { ?>
					<?php
						$price = esc_html(get_field('informacziya_stoimost'));
						$price = number_format($price, 0, ',', ' ');
						echo '<span class="job_post"><b>' . $price . ' руб.</b></span>';
						?>
					<?php }
					if (get_field('informacziya_adres')) { ?>
					<p><?php esc_html(the_field('informacziya_adres')); ?></p>
					<?php } ?>
					<div>
						<?php if (get_field('informacziya')) { ?>
						<div class="row">
							<?php if (get_field('informacziya_ploshhad')) { ?>
							<div class="col">
								<span>Площадь:</span>
								<p><?php esc_html(the_field('informacziya_ploshhad')); ?> м<sup>2</sup></p>
							</div>
							<?php }
								if (get_field('informacziya_zhilaya_ploshhad')) { ?>
							<div class="col">
								<span>Жилая площадь:</span>
								<p><?php esc_html(the_field('informacziya_zhilaya_ploshhad')); ?> м<sup>2</sup></p>
							</div>
							<?php }
								if (get_field('informacziya_etazh')) { ?>
							<div class="col">
								<span>Этаж:</span>
								<p><?php esc_html(the_field('informacziya_etazh')); ?></p>
							</div>
							<?php } ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>