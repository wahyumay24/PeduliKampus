<?php

class PeriodController extends Controller
{
	public function actionIndex()
	{
		$modPeriod = MPeriod::model()->findAll('NOT is_deleted');
		$formPeriod = new MPeriod();
		$this->render('index',[
			'modPeriod'=>$modPeriod,
			'formPeriod'=>$formPeriod
		]);
	}

	public function actionAddPeriod()
	{
		$period_name =  $_POST['period_name'];
		$is_active = $_POST['is_active'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$description = $_POST['description'];
		$formPeriod = new MPeriod();
		$formPeriod->period_name = $period_name;
		$formPeriod->is_active = $is_active;
		$formPeriod->start_date = $start_date;
		$formPeriod->end_date = $end_date;
		$formPeriod->description = $description;
		$formPeriod->created_by = 1;
		$formPeriod->created_date = date('Y-m-d H:i:s');
		$validateMessage = [];
		if($formPeriod->validate()){
			if($start_date > $end_date){
				$success = false;
				$message = 'The start date and end date entered are invalid.';
			}
			elseif($formPeriod->save()) {
				$success = true;
				$message = 'Data successfully saved.';
			} else {
				$success = false;
				$message = 'Failed to save data.';
			}
		}else{
			$success = false;
			
			foreach($formPeriod->getErrors() as $attribute => $errors){
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

	public function ActionUpdatePeriod()
	{
		$id = $_POST['id'];
		$period_name =  $_POST['period_name'];
		$is_active = $_POST['is_active'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$description = $_POST['description'];
		$validateMessage = [];
		$formPeriod = MPeriod::model()->findByPk($id);
		$formPeriod->is_update = 1;
		$formPeriod->updated_by = 1;
		$formPeriod->updated_date = date('Y-m-d H:i:s');
		$formPeriod->period_name = $period_name;
		$formPeriod->is_active = $is_active;
		$formPeriod->start_date = $start_date;
		$formPeriod->end_date = $end_date;
		$formPeriod->description = $description;
		// $data = [			
		// 	'is_update' => true,
		// 	'updated_by' => 1,
		// 	'updated_date' => date('Y-m-d H:i:s'),
		// 	'period_name' => $period_name,
		// 	'is_active' => $is_active,
		// 	'start_date' => $start_date,
		// 	'end_date' => $end_date,
		// 	'description' => $description
		// ];
		// $formPeriod = MPeriod::model()->updateByPk($id, $data);
		
		if($formPeriod->validate()){			
			if($start_date > $end_date){
				$success = false;
				$message = 'The start date and end date entered are invalid.';
			}
			elseif($formPeriod->save()) {
				$success = true;
				$message = 'Data successfully updated.';
			} else {
				$success = false;
				$message = 'Failed to update data.';
			}
		}else{
			$success = false;
			foreach($formPeriod->getErrors() as $attribute=>$errors){
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

	public function ActionDeletePeriod()
	{
		$id = $_POST['id'];
		$data = [			
			'is_deleted' => true,
			'deleted_by' => 1,
			'deleted_date' => date('Y-m-d H:i:s')
		];
		$formPeriod = MPeriod::model()->updateByPk($id, $data);

		if($formPeriod) {
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

	public function ActionRefreshPeriod()
	{
		$modPeriod = MPeriod::model()->findAll('NOT is_deleted');
		
		$data = [
			'data'=>$this->renderPartial('_row',['modPeriod'=>$modPeriod],true)
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