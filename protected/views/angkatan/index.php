<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary">Master / Angkatan</i></h6>
            <a onClick="SettingForm('AddBatch')" class="btn btn-primary btn-icon-split" data-toggle="modal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Batch</span>
            </a>         
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Batch Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Batch Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
					<?php $this->renderPartial('_row',['modBatch'=>$modBatch]) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalBatch" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalBatchTitle"></h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
          <!-- <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
        <?php 
        $formBatch->is_active = true;
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'formBatch',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                'validateOnSubmit'=>true
                ),
            )); 
        ?>
            <div class="modal-body">
                    <div class="form-group"> 
                        <input type='hidden' id='MBatch_id'>                 
                        <?php echo $form->labelEx($formBatch,'batch_name'); ?>
                        <?php echo $form->textField($formBatch,'batch_name', ['class'=>"form-control", 'placeholder'=>"Enter batch name"]); ?>
                    </div>
                    <div class="form-group form-check">                        
                        <?php echo $form->checkbox($formBatch,'is_active', ['class'=>"form-check-input is_active", 'id'=>'MBatch_is_active', 'checked'=> true]); ?>
                        <?php echo $form->labelEx($formBatch,'is_active', ['class'=>"form-check-label"]); ?>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick='RefreshBatch()'>Close</button>
                <button type="button" class="btn btn-primary" id="btnSubmit">Save</button>
            </div>
        <?php $this->endWidget(); ?>
    </div>
  </div>
</div>

<?php
Yii::app()->clientScript->registerScript('toogleCheckbox', "
    $(document).ready(function (){
        $('#MBatch_is_active').change(function(){
            var cbActive = $(this).prop('checked') ? 1 : 0;
            $(this).val(cbActive);
        });
    });
");
?>

<script>
    function SettingForm(type, id, batchName, is_active){
        if(type == 'AddBatch'){
            $('#ModalBatchTitle').text('Add Batch');
            $('#MBatch_id').val('');
            $('#MBatch_batch_name').val('');
            $('#MBatch_is_active').val(1);
            $('#MBatch_is_active').prop('checked', true);
            $('#btnSubmit').attr('onClick', 'AddBatch()');
            $('#ModalBatch').modal('show');
        } else if(type == 'EditBatch'){
            $('#ModalBatchTitle').text('Edit Batch');
            $('#MBatch_id').val(id);
            $('#MBatch_batch_name').val(batchName);
            (is_active==1) ? $('#MBatch_is_active').prop('checked', true) : $('#MBatch_is_active').prop('checked', false);
            $('#MBatch_is_active').val(is_active);
            $('#btnSubmit').attr('onClick', 'updateBatch()');
            $('#ModalBatch').modal('show');
        }
    }

    function RefreshBatch(){
        $.ajax({
            url: '<?php echo $this->createUrl('RefreshBatch'); ?>', 
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
    
    function AddBatch(){
        var batch_name = $('#MBatch_batch_name').val();
        var is_active = $('#MBatch_is_active').val();
        $.ajax({
            url: '<?php echo $this->createUrl('AddBatch'); ?>', 
            type:'POST', 
            data:{
                batch_name,
                is_active
            },
            dataType:'json',
            success: function(result){
                if (result.success == true){
                    $('#MBatch_id').val('');
                    $('#MBatch_batch_name').val('');
                    $('#MBatch_is_active').val(1);
                    $('#MBatch_is_active').prop('checked', true);
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

    function updateBatch() {
        var id = $('#MBatch_id').val();
        var batch_name = $('#MBatch_batch_name').val();
        var is_active = $('#MBatch_is_active').val();
        $.ajax({
            url: '<?php echo $this->createUrl('UpdateBatch'); ?>',
            type: 'POST',
            data: {
                id,
                batch_name,
                is_active
            },
            dataType: 'json',
            success: function(result){
                if (result.success == true){
                    iconMsg = 'success';
                    titleMsg = 'Success';
                    $('#ModalBatch').modal('hide');
                    RefreshBatch();
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


    function DeleteBatch(id) {
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
                    url: '<?php echo $this->createUrl('DeleteBatch'); ?>',
                    type: 'POST',
                    data: {
                        id
                    },
                    dataType: 'json',
                    success: function(result){
                        if (result.success == true){
                            iconMsg = 'success';
                            titleMsg = 'Success';
                            RefreshBatch();
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