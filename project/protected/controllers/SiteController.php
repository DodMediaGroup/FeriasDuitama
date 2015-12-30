<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		date_default_timezone_set('America/Bogota');

		$slides = Slide::model()->findAllByAttributes(array('status_slide'=>1), array('order'=>'t.id_slide DESC'));
		$lastNews = News::model()->findAllByAttributes(array('status_new'=>1), array('order'=>'t.id_new DESC', 'limit'=>2));

		$dateNow = new DateTime("now");
		$date = Dates::model()->findByAttributes(array('date_date'=>$dateNow->format('Y-m-d'), 'status_date'=>1));
		if($date != null)
			$events = Events::model()->findAllByAttributes(array('dates_id_date'=>$date->id_date, 'status_event'=>1), array('order'=>'t.hour_event ASC'));
		else
			$events = null;

		$this->render('index', array(
			'date_now'=>$dateNow,
			'events'=>$events,
			'lastNews'=>$lastNews,
			'slides'=>$slides
		));
	}

	public function actionInvitacion(){
		$this->pageTitle = 'Invitación - '.$this->pageTitle;

		$this->render('invitacion');
	}

	public function actionPatrocinadores(){
		$this->pageTitle = 'Patrocinadores - '.$this->pageTitle;

		$sponsors = Sponsors::model()->findAllByAttributes(array('status_sponsor'=>1), array('order'=>'t.importance_sponsor ASC'));

		$this->render('patrocinadores', array(
			'sponsors'=>$sponsors
		));
	}

	public function actionContacto(){
		$this->pageTitle = 'Contacto - '.$this->pageTitle;

		$this->render('contacto');
	}

	public function actionProgramacion(){
		$this->pageTitle = 'Programación - '.$this->pageTitle;
		$this->pageDescription = 'Consulta la programacion oficial de las ferias. Los esperamos sin falta en nuestros eventos religiosos, teatro, danza, noches de música, cabalgata, carrozas y comparsas, deportes extremos y actividades para toda la familia.';
		$this->tagImage = '/images/facebook-programacion.png';
		
		$events = array();
		$dates = Dates::model()->findAllByAttributes(array('status_date'=>1), array('order'=>'t.date_date ASC'));
		foreach ($dates as $key => $date) {
			$eventsDate = Events::model()->findAllByAttributes(array('status_event'=>1, 'dates_id_date'=>$date->id_date), array('order'=>'t.hour_event ASC'));
			if($eventsDate != null){
				$events[] = array(
					'events'=>$eventsDate,
					'date'=>$date
				);
			}
		}

		$this->render('programacion', array(
			'events'=>$events
		));
	}

	public function actionEventos(){
		$this->pageTitle = 'Eventos - '.$this->pageTitle;
		$this->pageDescription = 'Los esperamos sin falta en nuestros eventos religiosos, teatro, danza, noches de música, cabalgata, carrozas y comparsas, deportes extremos y actividades para toda la familia.';
		$this->tagImage = '/images/facebook-eventos.png';

		$categories = array();
		$categoriesDb = EventCategories::model()->findAllByAttributes(array('status_category'=>1));
		foreach ($categoriesDb as $key => $category) {
			$events = Events::model()->findAllByAttributes(array('status_event'=>1, 'great_event'=>1, 'event_categories_id_category'=>$category->id_category), array('order'=>'t.id_event ASC', 'limit'=>3));
			if($events != null){
				$categories[] = array(
					'events'=>$events,
					'category'=>$category
				);
			}
		}

		$this->render('eventos', array(
			'categories'=>$categories,
		));
	}

	public function actionArtistas(){
		$this->pageTitle = 'Artistas - '.$this->pageTitle;
		$this->pageDescription = 'Ven y disfruta en familia de lo mejor de la salsa, el merengue, el vallenato y mucho más en las ferias de Duitama 2016.';
		$this->tagImage = '/images/facebook-artistas.png';

		$artists = Artists::model()->findAllByAttributes(array('status_artist'=>1));

		$this->render('artistas', array(
			'artists'=>$artists,
		));
	}

	public function actionNoticias(){
		$this->pageTitle = 'Noticias - '.$this->pageTitle;
		
		$news = News::model()->findAllByAttributes(array('status_new'=>1), array('order'=>'t.id_new DESC'));

		$this->render('noticias', array(
			'news'=>$news,
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->pageTitle = 'Error - '.$this->pageTitle;
		$this->pageDescription = 'Paginá o solicitud no encontrada.';

		$this->layout='//layouts/error';
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	/*public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}*/

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}