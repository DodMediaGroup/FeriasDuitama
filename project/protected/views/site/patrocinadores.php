		<header class="title-page title-page__blue">
			<h1>INFORMACIÓN GENERAL</h1>
			<h2>PATROCINADORES</h2>
		</header>
		<div class="limiter-container sponsors">
			<div class="line-box">
				<?php foreach ($sponsors as $key => $sponsor) { ?>
					<div class="line sponsor">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/sponsors/<?php echo $sponsor->image_sponsor; ?>" alt="<?php echo $sponsor->name_sponsor; ?>">
					</div>
				<?php } ?>
			</div>
		</div>