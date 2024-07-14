<?php

class JurusanController extends Controller
{
	public function actionIndex()
	{
		$modJurusan = JurusanM::model()->findAll('NOT is_deleted');
		$formJurusan = new JurusanM();
		$this->render('index',[
			'modJurusan'=>$modJurusan,
			'formJurusan'=>$formJurusan
		]);
	}

	public function actionAdd()
	{
		$kode =  $_POST['kode'];
		$nama =  $_POST['nama'];
		$is_active = $_POST['is_active'];
		$formJurusan = new JurusanM();
		$formJurusan->kode = $kode;
		$formJurusan->nama = $nama;
		$formJurusan->is_active = $is_active;
		$formJurusan->created_by = 1;
		$formJurusan->created_date = date('Y-m-d H:i:s');
		$validateMessage = [];
		if($formJurusan->validate()){
			if($formJurusan->save()) {
				$success = true;
				$message = 'Data successfully saved.';
			} else {
				$success = false;
				$message = 'Failed to save data.';
			}
		}else{
			$success = false;
			
			foreach($formJurusan->getErrors() as $attribute => $errors){
				if(!empty($errors)){
					$validateMessage[$attribute] = $errors[0];
				}
			}
			if(!empty($validateMessage)){
				$message = reset($validateMessage);
			}else{
				$message = '';
			}
		}

		$data = [
			'success'=>$success,
			'message'=>$message,
			'errors'=>$validateMessage
		];
		echo json_encode($data);
	}

	public function ActionUpdate()
	{
		$id = $_POST['id'];
		$kode =  $_POST['kode'];
		$nama =  $_POST['nama'];
		$is_active = $_POST['is_active'];
		$validateMessage = [];
		$formJurusan = JurusanM::model()->findByPk($id);
		$formJurusan->updated_by = 1;
		$formJurusan->updated_date = date('Y-m-d H:i:s');
		$formJurusan->kode = $kode;
		$formJurusan->nama = $nama;
		$formJurusan->is_active = $is_active;

		if($formJurusan->validate()){			
			if($formJurusan->save()) {
				$success = true;
				$message = 'Data successfully updated.';
			} else {
				$success = false;
				$message = 'Failed to update data.';
			}
		}else{
			$success = false;
			foreach($formJurusan->getErrors() as $attribute => $errors){
				if(!empty($errors)){
					$validateMessage[$attribute] = $errors[0];
				}
			}

			if(!empty($validateMessage)){
				$message = reset($validateMessage);
			}else{
				$message = '';
			}
		}

		$data = [
			'success'=>$success,
			'message'=>$message,
			'errors'=>$validateMessage
		];
		echo json_encode($data);

	}

	public function ActionDelete()
	{
		$id = $_POST['id'];
		$data = [			
			'is_deleted' => true,
			'deleted_by' => 1,
			'deleted_date' => date('Y-m-d H:i:s')
		];
		$formJurusan = JurusanM::model()->updateByPk($id, $data);

		if($formJurusan) {
			$success = true;
			$message = 'Data successfully deleted.';
		} else {
			$success = false;
			$message = 'Failed to delete data.';
		}

		$data = [
			'success'=>$success,
			'message'=>$message
		];
		echo json_encode($data);
	}

	public function ActionRefresh()
	{
		$modJurusan = JurusanM::model()->findAll('NOT is_deleted');
		
		$data = [
			'data'=>$this->renderPartial('_row',['modJurusan'=>$modJurusan],true)
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