		<header class="title-page title-page__red">
			<h1>EVENTOS</h1>
		</header>
		<div class="limiter-container">
			<section class="events line-box">
				<?php foreach ($categories as $key => $category) { ?>
					<article class="events-category line">
						<h2 class="events-category__title"><?php echo MyMethods::myStrtoupper($category['category']->name_category) ?></h2>
						<ul>
							<?php foreach ($category['events'] as $key => $event) { ?>
								<li><?php echo MyMethods::myStrtoupper($event->title_event); ?></li>
							<?php } ?>
						</ul>
						<div class="btn-right">
							<a href="<?php echo $this->createUrl('eventos/'.$category['category']->id_category.'_'.MyMethods::normalizarUrl($category['category']->name_category)) ?>" class="btn btn-yellow">VER MÁS</a>
						</div>
					</article>
				<?php } ?>
			</section>
		</div>

		<?php $this->renderPartial('//layouts/__sponsors'); ?>