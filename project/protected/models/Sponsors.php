<?php

/**
 * This is the model class for table "sponsors".
 *
 * The followings are the available columns in table 'sponsors':
 * @property integer $id_sponsor
 * @property string $name_sponsor
 * @property string $image_sponsor
 * @property integer $importance_sponsor
 * @property integer $status_sponsor
 */
class Sponsors extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sponsors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_sponsor, image_sponsor', 'required'),
			array('importance_sponsor, status_sponsor', 'numerical', 'integerOnly'=>true),
			array('name_sponsor, image_sponsor', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_sponsor, name_sponsor, image_sponsor, importance_sponsor, status_sponsor', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_sponsor' => 'Id Sponsor',
			'name_sponsor' => 'Name Sponsor',
			'image_sponsor' => 'Image Sponsor',
			'importance_sponsor' => 'Importance Sponsor',
			'status_sponsor' => 'Status Sponsor',
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

		$criteria->compare('id_sponsor',$this->id_sponsor);
		$criteria->compare('name_sponsor',$this->name_sponsor,true);
		$criteria->compare('image_sponsor',$this->image_sponsor,true);
		$criteria->compare('importance_sponsor',$this->importance_sponsor);
		$criteria->compare('status_sponsor',$this->status_sponsor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sponsors the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
