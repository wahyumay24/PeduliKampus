<?php

class UserController extends Controller
{
	public function actionIndex()
	{
		$modUser = UserM::model()->findAll('NOT t.is_deleted');
		$formUser = new UserM();
		$this->render('index',[
			'modUser'=>$modUser,
			'formUser'=>$formUser
		]);
	}
// test
	public function actionAdd($id = null)
	{	
		$formUser = new UserM();
		if(!empty($id)) {
			$formUser = UserM::model()->findByPk($id);
		} 
		
		// if(isset($_POST['UserM'])){
		// 	// $file_photo = $_FILES['userFile']['tmp_name'];
		// 	// $photo = base64_encode(file_get_contents($file_photo));
		// 	$formUser->attributes = $_POST['UserM'];
		// 	// $formUser->photo = $_POST['idImage'];
		// 	// $formUser->dateofbirth = date('Y-m-d');
		// 	$formUser->password = hash('sha256',$_POST['UserM']['password']);
		// 	$formUser->created_by = 'aa';
		// 	$formUser->created_date = date('Y-m-d H:i:s');
		// 	// echo "<pre>";
		// 	// var_dump($formUser->validate(), $formUser->getErrors());die;
		// 	$formUser->save();
		// 	if($formUser->save()){
		// 		$this->redirect('add', ['success' => 'Data Berhasil simpan']);
		// 	}
		// }
		
		
		$this->render('add', [
			'formUser' =>$formUser
		]);
	}

	public function actionAddUser()
	{
		$no_identitas =  $_POST['no_identitas'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$placeofbirth = $_POST['placeofbirth'];
		$dateofbirth = $_POST['dateofbirth'];
		$id_major = $_POST['id_major'];
		$id_batch = $_POST['id_batch'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$user_role = $_POST['user_role'];
		$is_active = $_POST['is_active'];
		$formUser = new UserM();
		$formUser->no_identitas = $no_identitas;
		$formUser->name = $name;
		$formUser->gender = $gender;		
		$formUser->placeofbirth = $placeofbirth;
		$formUser->dateofbirth = $dateofbirth;
		$formUser->id_major = $id_major;
		$formUser->id_batch = $id_batch;
		$formUser->username = $username;
		$formUser->password = $password;
		$formUser->user_role = $user_role;
		$formUser->is_active = $is_active;
		$formUser->created_by = 1;
		$formUser->created_date = date('Y-m-d H:i:s');
		$validateMessage = [];
		if($formUser->validate()){
			if($formUser->save()) {
				$success = true;
				$message = 'Data successfully saved.';
			} else {
				$success = false;
				$message = 'Failed to save data.';
			}
		}else{
			$success = false;
			
			foreach($formUser->getErrors() as $attribute => $errors){
				if(!empty($errors)){
					$validateMessage[$attribute] = $errors[0];
				}
			}
			if(!empty($validateMessage)){
				$message = reset($validateMessage);
			}else{
				$message ='';
			}
		}

		$data = [
			'success'=>$success,
			'message'=>$message,
			'errors' => $validateMessage
		];
		echo json_encode($data);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}