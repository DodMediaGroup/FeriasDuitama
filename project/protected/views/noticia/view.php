		<header class="title-page title-page__orange">
			<h1>NOTICIAS</h1>
		</header>
		<div class="limiter-container">
			<div class="btn-right">
				<a href="<?php echo $this->createUrl('noticias/') ?>" class="btn btn-yellow btn-icon btn-icon__left btn__back">VOLVER</a>
			</div>
			<article class="new__single">
				<figure class="post-image">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/news/<?php echo $new->image_new; ?>" alt="<?php echo $new->title_new; ?>">
				</figure>
				<header>
					<h1 class="title-post"><?php echo $new->title_new; ?></h1>
				</header>
				<section class="post-content">
					<?php echo $new->content_new; ?>
				</section>
			</article>
		</div>

		<?php $this->renderPartial('//layouts/__sponsors'); ?>