<?php
class ApiController extends Controller
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
                'actions'=>array('event'),
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
    public function actionEvent($id)
    {
        if(Yii::app()->request->isAjaxRequest){
            $event = Events::model()->findByAttributes(array('id_event'=>$id, 'status_event'=>1));
            if($event != null){
                $days = array('Monday'=>'Lunes', 'Tuesday'=>'Martes', 'Wednesday'=>'Miercoles', 'Thursday'=>'Jueves', 'Friday'=>'Viernes', 'Saturday'=>'Sabado', 'Sunday'=>'Domingo');

                $hour = new DateTime($event->hour_event);
                $date = new DateTime($event->datesIdDate->date_date);

                $event->hour_event = $hour->format('g:i A');
                $event->datesIdDate->date_date = $days[$date->format('l')].' '.intval($date->format('d'));

                echo CJSON::encode(array(
                    "title"=>MyMethods::myStrtoupper($event->title_event),
                    "image"=>Yii::app()->request->baseUrl.'/images/events/'.$event->image_event,
                    "place"=>MyMethods::myStrtoupper($event->placesIdPlace->name_place),
                    "hour"=>$event->datesIdDate->date_date.' - '.$event->hour_event,
                    "description"=>$event->description_event
                ));
            }
            else
                throw new CHttpException(404,'The requested page does not exist.');
        }
        else
            throw new CHttpException(404,'The requested page does not exist.');
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