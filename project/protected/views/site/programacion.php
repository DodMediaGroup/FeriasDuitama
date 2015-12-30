		<header class="title-page title-page__green">
			<h1>PROGRAMACIÓN</h1>
		</header>

		<section class="section page__programming">
			<div class="limiter-container">
				<div class="accordion">
					<?php
					$colors = ['orange', 'blue', 'purple', 'red', 'yellow'];
					$days = array('Monday'=>'Lunes', 'Tuesday'=>'Martes', 'Wednesday'=>'Miercoles', 'Thursday'=>'Jueves', 'Friday'=>'Viernes', 'Saturday'=>'Sabado', 'Sunday'=>'Domingo');
					$colorIndex = -1;
					foreach ($events as $key => $event) {
						$date = new DateTime($event['date']->date_date);
						$day = $days[$date->format('l')].' '.intval($date->format('d'));
						
						$colorIndex++;
						if($colorIndex == count($colors))
							$colorIndex = 0;
					?>
						<h3 class="accordion-title accordion-title__<?php echo $colors[$colorIndex]; ?> accordion-title__icon"><?php echo $day; ?></h3>
						<div class="accordion-content">
							<table>
								<?php foreach ($event['events'] as $key => $eventItem) {
									$hour = new DateTime($eventItem->hour_event);
									$eventItem->hour_event = $hour->format('g:i A');
								?>
									<tr>
										<td>
											<p class="icon-line">
												<span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-hour.svg" alt="Hora" class="to-svg"></span>
												<?php echo $eventItem->hour_event; ?>
											</p>
										</td>
										<td>
											<p>
												<?php if($eventItem->great_event == 1){ ?>
													<a href="<?php echo $this->createUrl('eventos/'.$eventItem->event_categories_id_category.'_'.MyMethods::normalizarUrl($eventItem->eventCategoriesIdCategory->name_category).'?event='.$eventItem->id_event) ?>"><?php echo MyMethods::myStrtoupper($eventItem->title_event); ?></a>
												<?php }
												else
													echo MyMethods::myStrtoupper($eventItem->title_event);
												?>
											</p>
										</td>
										<td>
											<p class="icon-line">
												<span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon-place.svg" alt="Lugar" class="to-svg"></span>
												<?php echo MyMethods::myStrtoupper($eventItem->placesIdPlace->name_place); ?>
											</p>
										</td>
									</tr>
								<?php } ?>
							</table>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>

		<?php $this->renderPartial('//layouts/__sponsors'); ?>