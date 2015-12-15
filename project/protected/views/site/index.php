		<div class="slider">
			<?php foreach ($slides as $key => $slide) { ?>
				<article class="slide <?php echo $slide->color_slide; ?>">
					<div class="slide-item" data-in="left">
						<div class="slide-image" style="background-image: url('<?php echo Yii::app()->request->baseUrl; ?>/images/slide/<?php echo $slide->image_slide; ?>')"></div>
					</div>
					<div class="slide-item" data-in="bottomRight">
						<div class="image-decoration"></div>
					</div>
					<div class="slide-item" data-in="top" data-delay="600">
						<div class="slide-text">
							<div class="content__text">
								<?php echo $slide->text_slide; ?>
							</div>
						</div>
					</div>
				</article>
			<?php } ?>
		</div>

		<?php $this->renderPartial('//layouts/__sponsors'); ?>


		<?php if(count($events) > 0){ ?>
			<section class="section events-live">
				<header class="title">
					<h1>PROGRAMACIÓN EN VIVO</h1>
				</header>
				<div class="limiter-container">
					<div class="oxl-carousel">
						<?php foreach ($events as $key => $event) {
							$hour = new DateTime($event->hour_event);
							$event->hour_event = $hour->format('g:i A');
						?>
							<div class="event">
								<h2><?php echo MyMethods::myStrtoupper($event->title_event); ?></h2>
								<div class="info">
									<p><span class="icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-hour.svg" alt="Hora" class="to-svg"></span><?php echo $event->hour_event; ?></p>
									<p><span class="icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-place.svg" alt="Lugar" class="to-svg"></span><?php echo MyMethods::myStrtoupper($event->placesIdPlace->name_place); ?></p>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>
		<?php } ?>

		<section class="section social-feed">
			<div class="limiter-container">
				<div id="social-feed">
					<div class="grid-sizer"></div>
				</div>
			</div>
		</section>

		<aside class="section parallax index__parallax">
			<div class="limiter-container">
				<a href="">POR LA DUITAMA QUE SOÑAMOS</a>
			</div>
		</aside>

		<section class="section news index__news">
			<header class="title-section">
				<h1>NOTICIAS</h1>
			</header>
			<div class="limiter-container">
				<div class="line-box">
					<?php foreach ($lastNews as $key => $new) { ?>
						<article class="line new">
							<div class="post">
								<figure class="post-image js-resizing" data-resizing="9/12">
									<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/news/<?php echo $new->image_new; ?>" alt="<?php echo $new->title_new; ?>">
								</figure>
								<header class="post-header">
									<h2 class="post-title"><?php echo $new->title_new; ?></h2>
									<p class="post-content">
										<?php echo substr(strip_tags($new->content_new), 0, 130); ?>...
									</p>
								</header>
							</div>
							<div class="btn-right">
								<a href="<?php echo $this->createUrl('noticia/'.$new->id_new.'_'.MyMethods::normalizarUrl($new->title_new)) ?>" class="btn btn-yellow">VER MÁS</a>
							</div>
						</article>
					<?php } ?>
				</div>
			</div>
		</section>