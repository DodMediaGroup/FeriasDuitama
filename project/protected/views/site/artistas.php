		<header class="title-page title-page__purple">
			<h1>ARTISTAS</h1>
		</header>
		<div class="limiter-container">
			<section class="artists line-box">
				<?php foreach ($artists as $key => $artist) { ?>
					<article class="artists__item artists__item__<?php echo $artist->color_artist; ?> line">
						<a href="<?php echo $this->createUrl('artista/'.$artist->id_artist.'_'.MyMethods::normalizarUrl($artist->name_artist)) ?>">
							<figure class="artist-image js-resizing" data-resizing="1">
								<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/artists/<?php echo $artist->image_artist; ?>" alt="<?php echo $artist->name_artist; ?>">
							</figure>
							<h2 class="artist-name"><?php echo MyMethods::myStrtoupper($artist->name_artist); ?></h2>
						</a>
					</article>
				<?php } ?>
			</section>
		</div>

		<?php $this->renderPartial('//layouts/__sponsors'); ?>