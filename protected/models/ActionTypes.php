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
 * This is the model class for table "action_types".
 *
 * The followings are the available columns in table 'action_types':
 * @property integer $ATY_ID
 * @property string $ATY_DESC_EN_GB
 * @property string $ATY_DESC_DE_CH
 * @property integer $CREATED_BY
 * @property integer $CREATED_ON
 * @property integer $CHANGED_BY
 * @property integer $CHANGED_ON
 */
class ActionTypes extends ActiveRecordEC
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ActionTypes the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'action_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ATY_DESC_EN_GB, ATY_DESC_DE_CH, CREATED_BY, CREATED_ON', 'required'),
			array('CREATED_BY, CREATED_ON, CHANGED_BY, CHANGED_ON', 'numerical', 'integerOnly'=>true),
			array('ATY_DESC_EN_GB, ATY_DESC_DE_CH', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ATY_ID, ATY_DESC_EN_GB, ATY_DESC_DE_CH, CREATED_BY, CREATED_ON, CHANGED_BY, CHANGED_ON', 'safe', 'on'=>'search'),
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
			'ATY_ID' => 'Aty',
			'ATY_DESC_EN_GB' => 'Aty Desc En Gb',
			'ATY_DESC_DE_CH' => 'Aty Desc De Ch',
			'CREATED_BY' => 'Created By',
			'CREATED_ON' => 'Created On',
			'CHANGED_BY' => 'Changed By',
			'CHANGED_ON' => 'Changed On',
		);
	}
	
	public function getSearchFields(){
		return array('ATY_ID', 'ATY_DESC_' . Yii::app()->session['lang']);
	}
	
	
	public function getCriteriaString(){
		$criteria=new CDbCriteria;
		
		$criteria->compare($this->tableName().'.ATY_ID',$this->ATY_ID);
		$criteria->compare($this->tableName().'.ATY_DESC_EN_GB',$this->ATY_DESC_EN_GB,true);
		$criteria->compare($this->tableName().'.ATY_DESC_DE_CH',$this->ATY_DESC_DE_CH,true);
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

		$criteria->compare('ATY_ID',$this->ATY_ID);
		$criteria->compare('ATY_DESC_EN_GB',$this->ATY_DESC_EN_GB,true);
		$criteria->compare('ATY_DESC_DE_CH',$this->ATY_DESC_DE_CH,true);
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
				'asc' => 'ATY_ID',
				'desc' => 'ATY_ID DESC',
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