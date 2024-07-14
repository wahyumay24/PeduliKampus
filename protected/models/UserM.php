<?php

/**
 * This is the model class for table "user_m".
 *
 * The followings are the available columns in table 'user_m':
 * @property integer $id
 * @property string $no_identitas
 * @property string $nama
 * @property string $jenis_kelamin
 * @property integer $id_jurusan
 * @property integer $id_angkatan
 * @property string $photo
 * @property string $username
 * @property string $password
 * @property integer $akses
 * @property integer $point
 * @property integer $is_active
 * @property string $lastlogin_date
 * @property string $created_by
 * @property string $created_date
 * @property string $updated_by
 * @property string $updated_date
 * @property integer $is_deleted
 * @property string $deleted_by
 * @property string $deleted_date
 */
class UserM extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_m';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('no_identitas, nama, jenis_kelamin, id_jurusan, id_angkatan, username, password, akses, created_by, created_date, is_deleted', 'required'),
			array('id_jurusan, id_angkatan, akses, point, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			array('no_identitas, nama, jenis_kelamin, photo, username, password, created_by, updated_by, deleted_by', 'length', 'max'=>255),
			array('lastlogin_date, updated_date, deleted_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, no_identitas, nama, jenis_kelamin, id_jurusan, id_angkatan, photo, username, password, akses, point, is_active, lastlogin_date, created_by, created_date, updated_by, updated_date, is_deleted, deleted_by, deleted_date', 'safe', 'on'=>'search'),
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
			'jurusan' => array(self::BELONGS_TO, 'JurusanM', 'id_jurusan'),
			'angkatan' => array(self::BELONGS_TO, 'AngkatanM', 'id_angkatan')
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
			'nama' => 'Nama',
			'jenis_kelamin' => 'Jenis Kelamin',
			'id_jurusan' => 'Id Jurusan',
			'id_angkatan' => 'Id Angkatan',
			'photo' => 'Photo',
			'username' => 'Username',
			'password' => 'Password',
			'akses' => 'Akses',
			'point' => 'Point',
			'is_active' => 'Is Active',
			'lastlogin_date' => 'Lastlogin Date',
			'created_by' => 'Created By',
			'created_date' => 'Created Date',
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
		$criteria->compare('no_identitas',$this->no_identitas,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('jenis_kelamin',$this->jenis_kelamin,true);
		$criteria->compare('id_jurusan',$this->id_jurusan);
		$criteria->compare('id_angkatan',$this->id_angkatan);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('akses',$this->akses);
		$criteria->compare('point',$this->point);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('lastlogin_date',$this->lastlogin_date,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('deleted_by',$this->deleted_by,true);
		$criteria->compare('deleted_date',$this->deleted_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserM the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
