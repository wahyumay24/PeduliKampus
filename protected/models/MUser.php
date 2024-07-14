<?php

/**
 * This is the model class for table "m_user".
 *
 * The followings are the available columns in table 'm_user':
 * @property integer $id
 * @property string $no_identitas
 * @property integer $id_major
 * @property integer $id_batch
 * @property string $name
 * @property string $dateofbirth
 * @property string $gender
 * @property string $username
 * @property string $password
 * @property integer $is_active
 * @property string $user_role
 * @property string $last_login
 * @property string $created_date
 * @property string $update_date
 * @property string $update_by
 * @property string $created_by
 * @property integer $is_deleted
 * @property string $deleted_by
 * @property string $deleted_date
 * @property integer $is_update 
 * @property string $photo
 */
class MUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('no_identitas, name, dateofbirth, gender, username, password, user_role, created_date, created_by', 'required'),
			array('id_major, id_batch, is_active, is_deleted, is_update', 'numerical', 'integerOnly'=>true),
			array('no_identitas, name, placeofbirth, gender, username, password, user_role, update_by, created_by, deleted_by', 'length', 'max'=>255),
			array('last_login, update_date, deleted_date, photo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, no_identitas, id_major, id_batch, name, dateofbirth, placeofbirth, gender, username, password, is_active, user_role, last_login, created_date, update_date, update_by, created_by, is_deleted, deleted_by, deleted_date, is_update', 'safe', 'on'=>'search'),
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
			'major' => array(self::BELONGS_TO, 'MMajor', 'id_major'),
			'batch' => array(self::BELONGS_TO, 'MBatch', 'id_batch')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'no_identitas' => 'No Identitas',
			'id_major' => 'Major',
			'id_batch' => 'Batch',
			'name' => 'Name',
			'dateofbirth' => 'Date of Birth',
			'placeofbirth' => 'Place of Birth',
			'gender' => 'Gender',
			'username' => 'Username',
			'password' => 'Password',
			'is_active' => 'Active',
			'user_role' => 'User Role',
			'last_login' => 'Last Login',
			'created_date' => 'Created Date',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
			'created_by' => 'Created By',
			'is_deleted' => 'Is Deleted',
			'deleted_by' => 'Deleted By',
			'deleted_date' => 'Deleted Date',
			'is_update' => 'Is Update',
			'photo' => 'Photo',
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
		$criteria->compare('no_identitas',$this->no_identitas,true);
		$criteria->compare('id_major',$this->id_major);
		$criteria->compare('id_batch',$this->id_batch);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('dateofbirth',$this->dateofbirth,true);
		$criteria->compare('placeofbirth',$this->placeofbirth,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('user_role',$this->user_role,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('update_by',$this->update_by,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('deleted_by',$this->deleted_by,true);
		$criteria->compare('deleted_date',$this->deleted_date,true);
		$criteria->compare('is_update',$this->is_update);
		$criteria->compare('photo',$this->photo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
