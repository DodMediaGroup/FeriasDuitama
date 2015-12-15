<?php

/**
 * This is the model class for table "slide".
 *
 * The followings are the available columns in table 'slide':
 * @property integer $id_slide
 * @property string $image_slide
 * @property string $text_slide
 * @property string $color_slide
 * @property integer $status_slide
 */
class Slide extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'slide';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_slide, text_slide, color_slide', 'required'),
			array('status_slide', 'numerical', 'integerOnly'=>true),
			array('image_slide', 'length', 'max'=>250),
			array('color_slide', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_slide, image_slide, text_slide, color_slide, status_slide', 'safe', 'on'=>'search'),
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
			'id_slide' => 'Id Slide',
			'image_slide' => 'Image Slide',
			'text_slide' => 'Text Slide',
			'color_slide' => 'Color Slide',
			'status_slide' => 'Status Slide',
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

		$criteria->compare('id_slide',$this->id_slide);
		$criteria->compare('image_slide',$this->image_slide,true);
		$criteria->compare('text_slide',$this->text_slide,true);
		$criteria->compare('color_slide',$this->color_slide,true);
		$criteria->compare('status_slide',$this->status_slide);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Slide the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
