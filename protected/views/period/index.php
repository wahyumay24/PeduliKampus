<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary">Master / Period</i></h6>
            <a onClick="SettingForm('AddPeriod')" class="btn btn-primary btn-icon-split" data-toggle="modal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Period</span>
            </a>         
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Period Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Period Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
					<?php $this->renderPartial('_row',['modPeriod'=>$modPeriod]) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="ModalPeriod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalPeriodTitle"></h5>
      </div>
        <?php 
        $formPeriod->is_active = true;
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'formPeriod',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                'validateOnSubmit'=>true
                ),
            )); 
        ?>
            <div class="modal-body">
                    <div class="form-group"> 
                        <input type='hidden' id='MPeriod_id'>                 
                        <?php echo $form->labelEx($formPeriod,'period_name'); ?>
                        <?php echo $form->textField($formPeriod,'period_name', ['class'=>"form-control", 'placeholder'=>"Enter a period name.."]); ?>
						<?php echo $form->error($formPeriod,'period_name'); ?>
                    </div>
                    <div class="form-group">                        
                        <?php echo $form->labelEx($formPeriod,'start_date'); ?>
                        <?php echo $form->dateField($formPeriod,'start_date', ['class'=>"form-control ", 'id'=>'MPeriod_start_date']); ?>
						<?php echo $form->error($formPeriod,'start_date'); ?>
                    </div>
                    <div class="form-group">                        
                        <?php echo $form->labelEx($formPeriod,'end_date'); ?>
                        <?php echo $form->dateField($formPeriod,'end_date', ['class'=>"form-control", 'id'=>'MPeriod_end_date']); ?>
						<?php echo $form->error($formPeriod,'end_date'); ?>
                    </div>
                    <div class="form-group">                
                        <?php echo $form->labelEx($formPeriod,'description'); ?>
                        <?php echo $form->textArea($formPeriod,'description', ['class'=>"form-control", 'id'=>'MPeriod_description', 'placeholder'=>"Enter a description.."]); ?>
                    </div>
                    <div class="form-group form-check">                        
                        <?php echo $form->checkbox($formPeriod,'is_active', ['class'=>"form-check-input is_active", 'id'=>'MPeriod_is_active', 'checked'=> true]); ?>
                        <?php echo $form->labelEx($formPeriod,'is_active', ['class'=>"form-check-label"]); ?>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick='RefreshPeriod()'>Close</button>
                <button type="button" class="btn btn-primary" id="btnSubmit">Save</button>
            </div>
        <?php $this->endWidget(); ?>
    </div>
  </div>
</div>

<script>
    $(function(){
         $('#MPeriod_is_active').change(function(){
            var a = $(this).prop('checked') ? 1 : 0;
            $(this).val(a);
            console.log(a);
        });
    })
    function SettingForm(type, id, PeriodName, is_active, description, start_date, end_date){
        if(type == 'AddPeriod'){
            $('#ModalPeriodTitle').text('Add Period');
            $('#MPeriod_id').val('');
            $('#MPeriod_period_name').val('');
            $('#MPeriod_description').val('');
            $('#MPeriod_is_active').val(1).prop('checked', true);
            let formattedDate = new Date().toISOString().split('T')[0];
			$('#MPeriod_start_date').val(formattedDate);
			$('#MPeriod_end_date').val(formattedDate);
            $('#btnSubmit').attr('onClick', 'AddPeriod()');
            $('#ModalPeriod').modal('show');
        } else if(type == 'EditPeriod'){
            $('#ModalPeriodTitle').text('Edit Period');
            $('#MPeriod_id').val(id);
            $('#MPeriod_period_name').val(PeriodName);
            $('#MPeriod_start_date').val(start_date);
            $('#MPeriod_end_date').val(end_date);
            $('#MPeriod_description').val(description);
            (is_active==1) ? $('#MPeriod_is_active').prop('checked', true) : $('#MPeriod_is_active').prop('checked', false);
            $('#MPeriod_is_active').val(is_active);
            $('#btnSubmit').attr('onClick', 'updatePeriod()');
            $('#ModalPeriod').modal('show');
        }
    }

    function RefreshPeriod(){
        $.ajax({
            url: '<?php echo $this->createUrl('RefreshPeriod'); ?>', 
            type:'POST', 
            data:{
            },
            dataType:'json',
            success: function(result){
                $('#dataTable').DataTable().destroy();
                $('#dataTable tbody').html(result.data);
                $('#dataTable').DataTable();
            }
        });
    }
    
    function AddPeriod(){
        var period_name = $('#MPeriod_period_name').val();        
        var is_active = $('#MPeriod_is_active').val();
        var start_date = $('#MPeriod_start_date').val();
        var end_date = $('#MPeriod_end_date').val();
		var description = $('#MPeriod_description').val();
        $.ajax({
            url: '<?php echo $this->createUrl('AddPeriod'); ?>', 
            type:'POST', 
            data:{
                period_name,
                is_active,
				start_date,
				end_date,
				description
            },
            dataType:'json',
            success: function(result){
                if (result.success == true){
                    $('#MPeriod_id').val('');
                    $('#MPeriod_period_name').val('');
                    let formattedDate = new Date().toISOString().split('T')[0];
			        $('#MPeriod_start_date').val(formattedDate);
			        $('#MPeriod_end_date').val(formattedDate);
                    $('#MPeriod_is_active').val(1);
                    $('#MPeriod_is_active').prop('checked', true);
                    $('#MPeriod_description').val('');
                    iconMsg = 'success';
                    titleMsg = 'Success';
                } else {           
                    iconMsg = 'error'; 
                    titleMsg= 'Failed';
                }
                Swal.fire({
                    title: titleMsg,
                    text: result.message,
                    icon: iconMsg
                });
            }
        });
    }

    function updatePeriod() {
        var id = $('#MPeriod_id').val();
        var period_name = $('#MPeriod_period_name').val();
        var is_active = $('#MPeriod_is_active').val();
        var start_date = $('#MPeriod_start_date').val();
        var end_date = $('#MPeriod_end_date').val();
        var description = $('#MPeriod_description').val();
        $.ajax({
            url: '<?php echo $this->createUrl('UpdatePeriod'); ?>',
            type: 'POST',
            data: {
                id,
                period_name,
                is_active,
				start_date,
				end_date,
				description
            },
            dataType: 'json',
            success: function(result){
                if (result.success == true){
                    iconMsg = 'success';
                    titleMsg = 'Success';
                    $('#ModalPeriod').modal('hide');
                    RefreshPeriod();
                } else {           
                    iconMsg = 'error'; 
                    titleMsg= 'Failed';
                }
                Swal.fire({
                    title: titleMsg,
                    text: result.message,
                    icon: iconMsg
                });
            }
        })
    }


    function DeletePeriod(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo $this->createUrl('DeletePeriod'); ?>',
                    type: 'POST',
                    data: {
                        id
                    },
                    dataType: 'json',
                    success: function(result){
                        if (result.success == true){
                            iconMsg = 'success';
                            titleMsg = 'Success';
                            RefreshPeriod();
                        } else {           
                            iconMsg = 'error'; 
                            titleMsg= 'Failed';
                        }
                        Swal.fire({
                            title: titleMsg,
                            text: result.message,
                            icon: iconMsg
                        });
                    }
                });
            
            }
        });
    }
</script>