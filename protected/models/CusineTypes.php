<?php
/*
This is the EveryCook Recipe Database. It is a web application for creating (and storing) machine (and human) readable recipes.
These recipes are linked to foods and suppliers to allow meal planning and shopping list creation. It also guides the user step-by-step through the recipe with the CookAssistant
EveryCook is an open source platform for collecting all data about food and make it available to all kinds of cooking devices.

This program is copyright (C) by EveryCook. Written by Samuel Werder, Matthias Flierl and Alexis Wiasmitinow.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

See GPLv3.htm in the main folder for details.
*/

/**
 * This is the model class for table "cusine_types".
 *
 * The followings are the available columns in table 'cusine_types':
 * @property integer $CUT_ID
 * @property double $CUT_GPS_LAT
 * @property double $CUT_GPS_LNG
 * @property string $CUT_GOOGLE_REGION
 * @property string $CUT_DESC_EN_GB
 * @property string $CUT_DESC_DE_CH
 * @property integer $CREATED_BY
 * @property integer $CREATED_ON
 * @property integer $CHANGED_BY
 * @property integer $CHANGED_ON
 */
class CusineTypes extends ActiveRecordEC
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CusineTypes the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'cusine_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CUT_DESC_EN_GB, CUT_DESC_DE_CH, CREATED_BY, CREATED_ON, CHANGED_BY, CHANGED_ON', 'required'),
			array('CREATED_BY, CREATED_ON, CHANGED_BY, CHANGED_ON', 'numerical', 'integerOnly'=>true),
			array('CUT_GPS_LAT, CUT_GPS_LNG', 'numerical'),
			array('CUT_GOOGLE_REGION', 'length', 'max'=>50),
			array('CUT_DESC_EN_GB, CUT_DESC_DE_CH', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CUT_ID, CUT_GPS_LAT, CUT_GPS_LNG, CUT_GOOGLE_REGION, CUT_DESC_EN_GB, CUT_DESC_DE_CH, CREATED_BY, CREATED_ON, CHANGED_BY, CHANGED_ON', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'CUT_ID' => 'Cut',
			'CUT_GPS_LAT' => 'Cut Gps Lat',
			'CUT_GPS_LNG' => 'Cut Gps Lng',
			'CUT_GOOGLE_REGION' => 'Cut Google Region',
			'CUT_DESC_EN_GB' => 'Cut Desc En Gb',
			'CUT_DESC_DE_CH' => 'Cut Desc De Ch',
			'CREATED_BY' => 'Created By',
			'CREATED_ON' => 'Created On',
			'CHANGED_BY' => 'Changed By',
			'CHANGED_ON' => 'Changed On',
		);
	}
	
	public function getSearchFields(){
		return array('CUT_ID', 'CUT_DESC_' . Yii::app()->session['lang']);
	}
	
	
	public function getCriteriaString(){
		$criteria=new CDbCriteria;
		
		$criteria->compare($this->tableName().'.CUT_ID',$this->CUT_ID);
		$criteria->compare($this->tableName().'.CUT_GPS_LAT',$this->CUT_GPS_LAT);
		$criteria->compare($this->tableName().'.CUT_GPS_LNG',$this->CUT_GPS_LNG);
		$criteria->compare($this->tableName().'.CUT_GOOGLE_REGION',$this->CUT_GOOGLE_REGION,true);
		$criteria->compare($this->tableName().'.CUT_DESC_EN_GB',$this->CUT_DESC_EN_GB,true);
		$criteria->compare($this->tableName().'.CUT_DESC_DE_CH',$this->CUT_DESC_DE_CH,true);
		$criteria->compare($this->tableName().'.CREATED_BY',$this->CREATED_BY);
		$criteria->compare($this->tableName().'.CREATED_ON',$this->CREATED_ON);
		$criteria->compare($this->tableName().'.CHANGED_BY',$this->CHANGED_BY);
		$criteria->compare($this->tableName().'.CHANGED_ON',$this->CHANGED_ON);
		return $criteria;
	}
	
	public function getCriteria(){
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('CUT_ID',$this->CUT_ID);
		$criteria->compare('CUT_GPS_LAT',$this->CUT_GPS_LAT);
		$criteria->compare('CUT_GPS_LNG',$this->CUT_GPS_LNG);
		$criteria->compare('CUT_GOOGLE_REGION',$this->CUT_GOOGLE_REGION,true);
		$criteria->compare('CUT_DESC_EN_GB',$this->CUT_DESC_EN_GB,true);
		$criteria->compare('CUT_DESC_DE_CH',$this->CUT_DESC_DE_CH,true);
		$criteria->compare('CREATED_BY',$this->CREATED_BY);
		$criteria->compare('CREATED_ON',$this->CREATED_ON);
		$criteria->compare('CHANGED_BY',$this->CHANGED_BY);
		$criteria->compare('CHANGED_ON',$this->CHANGED_ON);
		//Add with conditions for relations
		//$criteria->with = array('???relationName???' => array());
		
		return $criteria;
	}
	
	public function getSort(){
		$sort = new CSort;
		$sort->attributes = array(
		/*
			'sortId' => array(
				'asc' => 'CUT_ID',
				'desc' => 'CUT_ID DESC',
			),
		*/
			'*',
		);
		return $sort;
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search(){
		return new CActiveDataProvider($this, array(
			'criteria'=>$this->getCriteria(),
			'sort'=>$this->getSort(),
		));
	}
}