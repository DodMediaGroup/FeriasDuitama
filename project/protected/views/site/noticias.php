		<header class="title-page title-page__orange">
			<h1>NOTICIAS</h1>
		</header>
		<div class="limiter-container">
			<section class="news line-box">
				<?php foreach ($news as $key => $new) { ?>
					<article class="line new">
						<a href="<?php echo $this->createUrl('noticia/'.$new->id_new.'_'.MyMethods::normalizarUrl($new->title_new)) ?>" class="post">
							<figure class="post-image js-resizing" data-resizing="9/12">
								<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/news/<?php echo $new->image_new; ?>" alt="<?php echo $new->title_new; ?>">
							</figure>
							<header class="post-header">
								<h2 class="post-title"><?php echo $new->title_new; ?></h2>
								<p class="post-content">
									<?php echo substr(strip_tags($new->content_new), 0, 130); ?>...
								</p>
							</header>
						</a>
					</article>
				<?php } ?>
			</section>
		</div>

		<?php $this->renderPartial('//layouts/__sponsors'); ?>