<?php

/**
 * This is the model class for table "steps".
 *
 * The followings are the available columns in table 'steps':
 * @property integer $REC_ID
 * @property integer $ACT_ID
 * @property integer $ING_ID
 * @property integer $STE_STEP_NO
 * @property integer $STE_GRAMS
 * @property integer $STE_CELSIUS
 * @property double $STE_KPA
 * @property integer $STE_RPM
 * @property integer $STE_CLOCKWISE
 * @property integer $STE_STIR_RUN
 * @property integer $STE_STIR_PAUSE
 * @property integer $STE_STEP_DURATION
 * @property integer $STT_ID
 */
class Steps extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Steps the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'steps';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('REC_ID, STE_STEP_NO', 'required'),
			array('REC_ID, ACT_ID, ING_ID, STE_STEP_NO, STE_GRAMS, STE_CELSIUS, STE_RPM, STE_CLOCKWISE, STE_STIR_RUN, STE_STIR_PAUSE, STE_STEP_DURATION, STT_ID', 'numerical', 'integerOnly'=>true),
			array('STE_KPA', 'numerical'),
			array('recipe, ingredient, stepType', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('REC_ID, ACT_ID, ING_ID, STE_STEP_NO, STE_GRAMS, STE_CELSIUS, STE_KPA, STE_RPM, STE_CLOCKWISE, STE_STIR_RUN, STE_STIR_PAUSE, STE_STEP_DURATION, STT_ID', 'safe', 'on'=>'search'),
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
			'recipe' => array(self::BELONGS_TO, 'Recipes', 'REC_ID'),
			'ingredient' => array(self::BELONGS_TO, 'Ingredients', 'ING_ID'),
			'stepType' => array(self::BELONGS_TO, 'StepTypes', 'STT_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'REC_ID' => 'Rec',
			'ACT_ID' => 'Act',
			'ING_ID' => 'Ing',
			'STE_STEP_NO' => 'Ste Step No',
			'STE_GRAMS' => 'Ste Grams',
			'STE_CELSIUS' => 'Ste Celsius',
			'STE_KPA' => 'Ste Kpa',
			'STE_RPM' => 'Ste Rpm',
			'STE_CLOCKWISE' => 'Ste Clockwise',
			'STE_STIR_RUN' => 'Ste Stir Run',
			'STE_STIR_PAUSE' => 'Ste Stir Pause',
			'STE_STEP_DURATION' => 'Ste Step Duration',
			'STT_ID' => 'Stt',
		);
	}

	public function getSearchFields(){
		return array('REC_ID', 'REC_TITLE_EN, REC_TITLE_DE');
	}
	
	public function getCriteria(){
		$criteria=new CDbCriteria;
		
		$criteria->compare('REC_ID',$this->REC_ID);
		$criteria->compare('ACT_ID',$this->ACT_ID);
		$criteria->compare('ING_ID',$this->ING_ID);
		$criteria->compare('STE_STEP_NO',$this->STE_STEP_NO);
		$criteria->compare('STE_GRAMS',$this->STE_GRAMS);
		$criteria->compare('STE_CELSIUS',$this->STE_CELSIUS);
		$criteria->compare('STE_KPA',$this->STE_KPA);
		$criteria->compare('STE_RPM',$this->STE_RPM);
		$criteria->compare('STE_CLOCKWISE',$this->STE_CLOCKWISE);
		$criteria->compare('STE_STIR_RUN',$this->STE_STIR_RUN);
		$criteria->compare('STE_STIR_PAUSE',$this->STE_STIR_PAUSE);
		$criteria->compare('STE_STEP_DURATION',$this->STE_STEP_DURATION);
		$criteria->compare('STT_ID',$this->STT_ID);
		
		//$criteria->with = array('recipe' => array());
		$criteria->with = array('ingredient' => array('nutrientData'));
		$criteria->with = array('stepType' => array());
		
		$criteria->compare('REC_ID',$this->recipe,true);
		$criteria->compare('ING_ID',$this->ingredient,true);
		$criteria->compare('STT_ID',$this->stepType,true);
		
		$criteria->order('STE_STEP_NO');
		
		return $criteria;
	}
	
	public function getSort(){
		$sort = new CSort;
		
		$sort->attributes = array(
			'REC_ID' => array(
				'asc' => 'REC_ID, STE_STEP_NO',
				'desc' => 'REC_ID DESC, STE_STEP_NO DESC',
			),
			'STE_STEP_NO' => array(
				'asc' => 'REC_ID, STE_STEP_NO',
				'desc' => 'REC_ID DESC, STE_STEP_NO DESC',
			),
			'ingredient' => array(
				'asc' => 'INC_ID',
				'desc' => 'INC_ID DESC',
			),
			'nutrientData' => array(
				'asc' => 'NUT_ID',
				'desc' => 'NUT_ID DESC',
			),
			/*
			'groupNames' => array(
				'asc' => 'ING_GROUP',
				'desc' => 'ING_GROUP DESC',
			),
			'subgroupNames' => array(
				'asc' => 'ING_SUBGROUP',
				'desc' => 'ING_SUBGROUP DESC',
			),
			'ingredientConveniences' => array(
				'asc' => 'ING_CONVENIENCE',
				'desc' => 'ING_CONVENIENCE DESC',
			),
			'storability' => array(
				'asc' => 'ING_STORABILITY',
				'desc' => 'ING_STORABILITY DESC',
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
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$this->getCriteria(),
			'sort'=>$this->getSort(),
		));
	}
}