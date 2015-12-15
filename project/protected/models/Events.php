<?php

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $id_event
 * @property string $title_event
 * @property string $hour_event
 * @property integer $great_event
 * @property string $description_event
 * @property string $image_event
 * @property integer $status_event
 * @property integer $dates_id_date
 * @property integer $event_categories_id_category
 * @property integer $places_id_place
 *
 * The followings are the available model relations:
 * @property Dates $datesIdDate
 * @property EventCategories $eventCategoriesIdCategory
 * @property Places $placesIdPlace
 */
class Events extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'events';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_event, hour_event, dates_id_date, event_categories_id_category, places_id_place', 'required'),
			array('great_event, status_event, dates_id_date, event_categories_id_category, places_id_place', 'numerical', 'integerOnly'=>true),
			array('title_event, image_event', 'length', 'max'=>255),
			array('description_event', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_event, title_event, hour_event, great_event, description_event, image_event, status_event, dates_id_date, event_categories_id_category, places_id_place', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'datesIdDate' => array(self::BELONGS_TO, 'Dates', 'dates_id_date'),
			'eventCategoriesIdCategory' => array(self::BELONGS_TO, 'EventCategories', 'event_categories_id_category'),
			'placesIdPlace' => array(self::BELONGS_TO, 'Places', 'places_id_place'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_event' => 'Id Event',
			'title_event' => 'Title Event',
			'hour_event' => 'Hour Event',
			'great_event' => 'Great Event',
			'description_event' => 'Description Event',
			'image_event' => 'Image Event',
			'status_event' => 'Status Event',
			'dates_id_date' => 'Dates Id Date',
			'event_categories_id_category' => 'Event Categories Id Category',
			'places_id_place' => 'Places Id Place',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_event',$this->id_event);
		$criteria->compare('title_event',$this->title_event,true);
		$criteria->compare('hour_event',$this->hour_event,true);
		$criteria->compare('great_event',$this->great_event);
		$criteria->compare('description_event',$this->description_event,true);
		$criteria->compare('image_event',$this->image_event,true);
		$criteria->compare('status_event',$this->status_event);
		$criteria->compare('dates_id_date',$this->dates_id_date);
		$criteria->compare('event_categories_id_category',$this->event_categories_id_category);
		$criteria->compare('places_id_place',$this->places_id_place);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Events the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
