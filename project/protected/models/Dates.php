<?php

/**
 * This is the model class for table "dates".
 *
 * The followings are the available columns in table 'dates':
 * @property integer $id_date
 * @property string $date_date
 * @property integer $status_date
 *
 * The followings are the available model relations:
 * @property Artists[] $artists
 * @property Events[] $events
 */
class Dates extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_date', 'required'),
			array('status_date', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_date, date_date, status_date', 'safe', 'on'=>'search'),
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
			'artists' => array(self::HAS_MANY, 'Artists', 'dates_id_date'),
			'events' => array(self::HAS_MANY, 'Events', 'dates_id_date'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_date' => 'Id Date',
			'date_date' => 'Date Date',
			'status_date' => 'Status Date',
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

		$criteria->compare('id_date',$this->id_date);
		$criteria->compare('date_date',$this->date_date,true);
		$criteria->compare('status_date',$this->status_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
