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

        $events = Events::model()->findAllByAttributes(array('status_event'=>1, 'great_event'=>1, 'event_categories_id_category'=>$category->id_category), array('order'=>'t.id_event ASC'));

        $this->render('view',array(
            'category'=>$category,
            'events'=>$events
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