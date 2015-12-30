<?php
class ArtistaController extends Controller
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
        $artist = $this->loadModel($id);

        $hour = new DateTime($artist->hour_artist);
        $artist->hour_artist = $hour->format('g:i A');
        
        $days = array('Monday'=>'Lunes', 'Tuesday'=>'Martes', 'Wednesday'=>'Miercoles', 'Thursday'=>'Jueves', 'Friday'=>'Viernes', 'Saturday'=>'Sabado', 'Sunday'=>'Domingo');
        $months = array('November'=>'Noviembre', 'December'=>'Diciembre', 'January'=>'Enero', 'February'=>'Febrero');
        $date = new DateTime($artist->datesIdDate->date_date);
        $artist->datesIdDate->date_date = $days[$date->format('l')].' '.intval($date->format('d')).' de '.((isset($months[$date->format('F')]))?$months[$date->format('F')]:$date->format('F'));
        
        $this->pageTitle = 'Artistas - '.$this->pageTitle;
        $this->pageDescription = 'Ven y disfruta en familia de lo mejor de la salsa, el merengue, el vallenato y mucho más en las ferias de Duitama 2016.';
        $this->tagImage = '/images/facebook-artistas.jpg';

        $this->render('view',array(
            'artist'=>$artist,
        ));
    }

    public function loadModel($id)
    {
        $model=Artists::model()->findByAttributes(array('id_artist'=>$id, 'status_artist'=>1));
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