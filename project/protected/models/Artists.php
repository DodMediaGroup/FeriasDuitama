<?php

/**
 * This is the model class for table "artists".
 *
 * The followings are the available columns in table 'artists':
 * @property integer $id_artist
 * @property string $name_artist
 * @property string $image_artist
 * @property string $hour_artist
 * @property string $day_special
 * @property string $description_artist
 * @property string $video_artist
 * @property string $color_artist
 * @property integer $status_artist
 * @property integer $places_id_place
 * @property integer $dates_id_date
 *
 * The followings are the available model relations:
 * @property Dates $datesIdDate
 * @property Places $placesIdPlace
 */
class Artists extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'artists';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_artist, image_artist, hour_artist, description_artist, video_artist, color_artist, places_id_place, dates_id_date', 'required'),
			array('status_artist, places_id_place, dates_id_date', 'numerical', 'integerOnly'=>true),
			array('name_artist, image_artist, video_artist', 'length', 'max'=>255),
			array('day_special', 'length', 'max'=>250),
			array('color_artist', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_artist, name_artist, image_artist, hour_artist, day_special, description_artist, video_artist, color_artist, status_artist, places_id_place, dates_id_date', 'safe', 'on'=>'search'),
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
			'placesIdPlace' => array(self::BELONGS_TO, 'Places', 'places_id_place'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_artist' => 'Id Artist',
			'name_artist' => 'Name Artist',
			'image_artist' => 'Image Artist',
			'hour_artist' => 'Hour Artist',
			'day_special' => 'Day Special',
			'description_artist' => 'Description Artist',
			'video_artist' => 'Video Artist',
			'color_artist' => 'Color Artist',
			'status_artist' => 'Status Artist',
			'places_id_place' => 'Places Id Place',
			'dates_id_date' => 'Dates Id Date',
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

		$criteria->compare('id_artist',$this->id_artist);
		$criteria->compare('name_artist',$this->name_artist,true);
		$criteria->compare('image_artist',$this->image_artist,true);
		$criteria->compare('hour_artist',$this->hour_artist,true);
		$criteria->compare('day_special',$this->day_special,true);
		$criteria->compare('description_artist',$this->description_artist,true);
		$criteria->compare('video_artist',$this->video_artist,true);
		$criteria->compare('color_artist',$this->color_artist,true);
		$criteria->compare('status_artist',$this->status_artist);
		$criteria->compare('places_id_place',$this->places_id_place);
		$criteria->compare('dates_id_date',$this->dates_id_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Artists the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
