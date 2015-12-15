		<header class="title-page title-page__red">
			<h1>EVENTOS</h1>
		</header>
		<div class="limiter-container">
			<div class="btn-right">
				<a href="<?php echo $this->createUrl('eventos/') ?>" class="btn btn-yellow btn-icon btn-icon__left btn__back">VOLVER</a>
			</div>
			<section class="events">
				<div class="line-box">
					<section class="line column">
						<header>
							<h2 class="title-post"><?php echo MyMethods::myStrtoupper($category->name_category) ?></h2>
						</header>
						<div class="events__list">
							<ul>
								<?php foreach ($events as $key => $event) { ?>
									<li> <a href="<?php echo $this->createUrl('api/event/'.$event->id_event) ?>" class="load-event <?php echo ($key == 0)?'active':''; ?>"><?php echo MyMethods::myStrtoupper($event->title_event) ?></a> </li>
								<?php } ?>
							</ul>
						</div>
					</section>
					<article class="line column event__load">
						<?php
							$event = $events[0];
							
							$hour = new DateTime($event->hour_event);
							$event->hour_event = $hour->format('g:i A');
						?>
						<header class="post-title">
							<h3 class="title-post"><?php echo MyMethods::myStrtoupper($event->title_event) ?></h3>
						</header>
						<figure class="post-image">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/events/<?php echo $event->image_event; ?>" alt="<?php echo $event->title_event; ?>">
						</figure>
						<div class="post-meta">
							<p>
								<span class="icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-place.svg" alt="Lugar" class="to-svg"></span>
								<span class="event-place"><?php echo MyMethods::myStrtoupper($event->placesIdPlace->name_place); ?></span>
							</p>
							<p>
								<span class="icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-hour.svg" alt="Hora" class="to-svg"></span>
								<span class="event-hour"><?php echo $event->hour_event; ?></span>
							</p>
						</div>
						<section class="post-content">
							<?php echo $event->description_event; ?>
						</section>
					</article>
				</div>
			</section>
		</div>

		<?php $this->renderPartial('//layouts/__sponsors'); ?>