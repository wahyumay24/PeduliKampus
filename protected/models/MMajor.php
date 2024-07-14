<?php

/**
 * This is the model class for table "m_major".
 *
 * The followings are the available columns in table 'm_major':
 * @property integer $id
 * @property string $major_name
 * @property integer $is_active
 * @property integer $is_deleted
 * @property integer $deleted_by
 * @property string $deleted_date
 * @property integer $is_update
 * @property integer $updated_by
 * @property string $updated_date
 * @property integer $created_by
 * @property string $created_date
 */
class MMajor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_major';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('major_name','required','message'=>'Please fill in the {attribute}'),
			array('is_active, is_deleted, deleted_by, is_update, updated_by, created_by', 'numerical', 'integerOnly'=>true),
			array('major_name', 'length', 'max'=>255),
			array('deleted_date, updated_date, created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, major_name, is_active, is_deleted, deleted_by, deleted_date, is_update, updated_by, updated_date, created_by, created_date', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'major_name' => 'Major Name',
			'is_active' => 'Active',
			'is_deleted' => 'Is Deleted',
			'deleted_by' => 'Deleted By',
			'deleted_date' => 'Deleted Date',
			'is_update' => 'Is Update',
			'updated_by' => 'Updated By',
			'updated_date' => 'Updated Date',
			'created_by' => 'Created By',
			'created_date' => 'Created Date',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('major_name',$this->major_name,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('deleted_by',$this->deleted_by);
		$criteria->compare('deleted_date',$this->deleted_date,true);
		$criteria->compare('is_update',$this->is_update);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MMajor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
