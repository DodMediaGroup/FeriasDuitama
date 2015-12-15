		<?php
			$sponsors = Sponsors::model()->findAllByAttributes(array('status_sponsor'=>1, 'importance_sponsor'=>1));
		?>
		<section class="section sponsors">
			<header class="title-section">
				<h1>INVITAN</h1>
			</header>
			<div class="limiter-container">
				<div class="line-box">
					<?php foreach ($sponsors as $key => $sponsor) { ?>
						<div class="line sponsor">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/sponsors/<?php echo $sponsor->image_sponsor; ?>" alt="<?php echo $sponsor->name_sponsor; ?>">
						</div>
					<?php } ?>
				</div>
			</div>
		</section>