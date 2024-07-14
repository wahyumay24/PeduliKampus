<?php

/**
 * This is the model class for table "m_batch".
 *
 * The followings are the available columns in table 'm_batch':
 * @property integer $id
 * @property string $batch_name
 * @property integer $is_active
 * @property integer $created_by
 * @property string $created_date
 * @property integer $is_update
 * @property integer $updated_by
 * @property string $updated_date
 * @property integer $is_deleted
 * @property integer $deleted_by
 * @property string $deleted_date
 */
class MBatch extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_batch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batch_name', 'required', 'message'=>'Please fill in the {attribute}'),
			array('is_active, created_by, is_update, updated_by, is_deleted, deleted_by', 'numerical', 'integerOnly'=>true),
			array('batch_name', 'length', 'max'=>255),
			array('created_date, updated_date, deleted_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, batch_name, is_active, created_by, created_date, is_update, updated_by, updated_date, is_deleted, deleted_by, deleted_date', 'safe', 'on'=>'search'),
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
			'batch_name' => 'Batch Name',
			'is_active' => 'Active',
			'created_by' => 'Created By',
			'created_date' => 'Created Date',
			'is_update' => 'Is Update',
			'updated_by' => 'Updated By',
			'updated_date' => 'Updated Date',
			'is_deleted' => 'Is Deleted',
			'deleted_by' => 'Deleted By',
			'deleted_date' => 'Deleted Date',
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
		$criteria->compare('batch_name',$this->batch_name,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('is_update',$this->is_update);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('deleted_by',$this->deleted_by);
		$criteria->compare('deleted_date',$this->deleted_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MBatch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
