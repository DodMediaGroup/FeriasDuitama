		<header class="title-page title-page__purple">
			<h1>ARTISTAS</h1>
		</header>
		<div class="limiter-container">
			<div class="btn-right">
				<a href="<?php echo $this->createUrl('artistas/') ?>" class="btn btn-yellow btn-icon btn-icon__left btn__back">VOLVER</a>
			</div>
			<article class="page__artist page__artist__blue">
				<header>
					<h2 class="artist-title"><?php echo MyMethods::myStrtoupper($artist->name_artist); ?></h2>
					<h3 class="artist-date">
						<?php echo MyMethods::myStrtoupper($artist->datesIdDate->date_date); ?>
						<?php echo ($artist->day_special != '')?(' / '.MyMethods::myStrtoupper($artist->day_special)):''; ?></h3>
					<p class="artist-more"><?php echo $artist->hour_artist ?> - <?php echo MyMethods::myStrtoupper($artist->placesIdPlace->name_place); ?></p>
				</header>
				<div class="limiter-container">
					<div class="artist-video">
						<iframe class="js-resizing" data-resizing="9/16" src="https://www.youtube.com/embed/<?php echo $artist->video_artist ?>" frameborder="0" allowfullscreen></iframe>
					</div>
					<section class="artist-description">
						<figure class="artist-image"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/artists/350x350/<?php echo $artist->image_artist ?>" alt="<?php echo $artist->name_artist ?>"></figure>
						<?php echo $artist->description_artist ?>
					</section>
				</div>
			</article>
		</div>

		<?php $this->renderPartial('//layouts/__sponsors'); ?>