<?php

class AngkatanController extends Controller
{
	public function actionIndex()
	{
		$modAngkatan = AngkatanM::model()->findAll('NOT is_deleted');
		$formAngkatan = new AngkatanM();
		$this->render('index',[
			'modAngkatan'=>$modAngkatan,
			'formAngkatan'=>$formAngkatan
		]);
	}

	public function actionAddBatch()
	{
		$batch_name =  $_POST['batch_name'];
		$is_active = $_POST['is_active'];
		$formBatch = new MBatch();
		$formBatch->batch_name = $batch_name;
		$formBatch->is_active = $is_active;
		$formBatch->created_by = 1;
		$formBatch->created_date = date('Y-m-d H:i:s');
		$validateMessage = [];
		
		if($formBatch->validate()){
			if($formBatch->save()) {
				$success = true;
				$message = 'Data successfully saved.';
			} else {
				$success = false;
				$message = 'Failed to save data.';
			}
		}else{
			$success = false;

			foreach($formBatch->getErrors() as $attribut => $errors){
				if(!empty($errors)){
					$validateMessage[$attribut] = $errors[0];
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

	public function ActionUpdateBatch()
	{
		$id = $_POST['id'];
		$batch_name =  $_POST['batch_name'];
		$is_active = $_POST['is_active'];
		$validateMessage  = [];
		$formBatch = MBatch::model()->findByPk($id);
		$formBatch->is_update = 1;
		$formBatch->updated_by = 1;
		$formBatch->updated_date = date('Y-m-d H:i:s');
		$formBatch->batch_name = $batch_name;
		$formBatch->is_active = $is_active;

		if($formBatch->validate()){
			if($formBatch->save()) {
				$success = true;
				$message = 'Data successfully updated.';
			} else {
				$success = false;
				$message = 'Failed to update data.';
			}
		}else{
			$success = false;
			foreach($formBatch->getErrors() as $attribut => $errors){
				if(!empty($errors)){
					$validateMessage[$attribut] = $errors[0];
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

	public function ActionDeleteBatch()
	{
		$id = $_POST['id'];
		$data = [			
			'is_deleted' => true,
			'deleted_by' => 1,
			'deleted_date' => date('Y-m-d H:i:s')
		];
		$formBatch = MBatch::model()->updateByPk($id, $data);

		if($formBatch) {
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

	public function ActionRefreshBatch()
	{
		$modBatch = MBatch::model()->findAll('NOT is_deleted');
		
		$data = [
			'data'=>$this->renderPartial('_row',['modBatch'=>$modBatch],true)
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