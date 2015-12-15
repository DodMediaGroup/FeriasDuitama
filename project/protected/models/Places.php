<?php

/**
 * This is the model class for table "places".
 *
 * The followings are the available columns in table 'places':
 * @property integer $id_place
 * @property string $name_place
 * @property integer $status_place
 *
 * The followings are the available model relations:
 * @property Artists[] $artists
 * @property Events[] $events
 */
class Places extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'places';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_place', 'required'),
			array('status_place', 'numerical', 'integerOnly'=>true),
			array('name_place', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_place, name_place, status_place', 'safe', 'on'=>'search'),
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
			'artists' => array(self::HAS_MANY, 'Artists', 'places_id_place'),
			'events' => array(self::HAS_MANY, 'Events', 'places_id_place'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_place' => 'Id Place',
			'name_place' => 'Name Place',
			'status_place' => 'Status Place',
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

		$criteria->compare('id_place',$this->id_place);
		$criteria->compare('name_place',$this->name_place,true);
		$criteria->compare('status_place',$this->status_place);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Places the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
