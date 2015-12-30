<?php
class EventosController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/main';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('view'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $category = explode('_', $id);
        $category = $this->loadModel($category[0]);
        $events = array();

        $dates = Dates::model()->findAllByAttributes(array('status_date'=>1), array('order'=>'t.date_date ASC'));
        foreach ($dates as $key => $date) {
            $eventsDate = Events::model()->findAllByAttributes(array('dates_id_date'=>$date->id_date, 'status_event'=>1, 'great_event'=>1, 'event_categories_id_category'=>$category->id_category), array('order'=>'t.hour_event ASC'));
            $events = array_merge($events, $eventsDate);
        }

        if(isset($_GET['event'])){
            $event = Events::model()->findByAttributes(array('status_event'=>1, 'great_event'=>1, 'event_categories_id_category'=>$category->id_category, 'id_event'=>$_GET['event']));
            if($event == null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        else{
            if(isset($events[0])){
                $event = $events[0];

                $this->pageTitle = 'Eventos '.$category->name_category.' - '.$this->pageTitle;
                $this->pageDescription = 'Los esperamos sin falta en nuestros eventos religiosos, teatro, danza, noches de música, cabalgata, carrozas y comparsas, deportes extremos y actividades para toda la familia.';
                $this->tagImage = '/images/events/'.$event->image_event;
            }
            else
                $event = null;
        }   

        $this->render('view',array(
            'category'=>$category,
            'events'=>$events,
            'event'=>$event
        ));
    }

    public function loadModel($id)
    {
        $model=EventCategories::model()->findByAttributes(array('id_category'=>$id));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Events $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='events-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}