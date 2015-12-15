<?php
	$ruta = explode("/",Yii::app()->request->pathInfo);
	$page = strtolower($ruta[0]);

	$categories = EventCategories::model()->findAllByAttributes(array('status_category'=>1));
?>

	<header class="bar-menu">
		<div class="limiter-container">
			<div class="line-box line-table">
				<div class="line logo">
					<a href="<?php echo Yii::app()->homeUrl; ?>">Ferias de Duitama</a>
				</div>
				<nav class="line menu">
					<ul>
						<li>
							<span class="item information">INFORMACIÓN GENERAL</span>
							<ul>
								<li><a href="<?php echo $this->createUrl('invitacion/') ?>">INVITACIÓN</a></li>
								<li><a href="<?php echo $this->createUrl('patrocinadores/') ?>">PATROCINADORES</a></li>
								<li><a href="<?php echo $this->createUrl('contacto/') ?>">CONTACTO</a></li>
							</ul>
						</li>
						<li><a href="<?php echo $this->createUrl('programacion/') ?>" class="item programing">PROGRAMACIÓN</a></li>
						<li>
							<a href="<?php echo $this->createUrl('eventos/') ?>" class="item events">EVENTOS</a>
							<ul>
								<?php foreach ($categories as $key => $category) { ?>
									<li><a href="<?php echo $this->createUrl('eventos/'.$category->id_category.'_'.MyMethods::normalizarUrl($category->name_category)) ?>"><?php echo MyMethods::myStrtoupper($category->name_category); ?></a></li>
								<?php } ?>
							</ul>
						</li>
						<li><a href="<?php echo $this->createUrl('artistas/') ?>" class="item artists">ARTISTAS</a></li>
						<li><a href="<?php echo $this->createUrl('noticias/') ?>" class="item news">NOTICIAS</a></li>
					</ul>
					<button class="menu-button">
						<span class="bar"></span>
						<span class="bar"></span>
						<span class="bar"></span>
					</button>
				</nav>
			</div>
		</div>
	</header>