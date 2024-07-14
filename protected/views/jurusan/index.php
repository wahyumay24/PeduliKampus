<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary">Master / Jurusan</i></h6>
            <a onClick="SettingForm('Add')" class="btn btn-primary btn-icon-split" data-toggle="modal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add</span>
            </a>         
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
					<?php $this->renderPartial('_row',['modJurusan'=>$modJurusan]) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalJurusan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitle"></h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
          <!-- <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
        <?php 
        $formJurusan->is_active = true;
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'formJurusan',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                'validateOnSubmit'=>true
                ),
            )); 
        ?>
            <div class="modal-body">
                    <div class="form-group">            
                        <?php echo $form->labelEx($formJurusan,'kode'); ?>
                        <?php echo $form->textField($formJurusan,'kode', ['class'=>"form-control", 'placeholder'=>"Enter code"]); ?>
                    </div>
                    <div class="form-group"> 
                        <input type='hidden' id='JurusanM_id'>                 
                        <?php echo $form->labelEx($formJurusan,'nama'); ?>
                        <?php echo $form->textField($formJurusan,'nama', ['class'=>"form-control", 'placeholder'=>"Enter name"]); ?>
                    </div>
                    <div class="form-group form-check">                        
                        <?php echo $form->checkbox($formJurusan,'is_active', ['class'=>"form-check-input is_active", 'id'=>'JurusanM_is_active', 'checked'=> true]); ?>
                        <?php echo $form->labelEx($formJurusan,'is_active', ['class'=>"form-check-label"]); ?>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick='Refresh()'>Close</button>
                <button type="button" class="btn btn-primary" id="btnSubmit">Save</button>
            </div>
        <?php $this->endWidget(); ?>
    </div>
  </div>
</div>

<?php
Yii::app()->clientScript->registerScript('toogleCheckbox', "
    $(document).ready(function (){
        $('#JurusanM_is_active').change(function(){
            var cbActive = $(this).prop('checked') ? 1 : 0;
            $(this).val(cbActive);
        });
    });
");
?>

<script>
    function SettingForm(type, id, kode, nama, is_active){
        if(type == 'Add'){
            $('#ModalTitle').text('Add');
            $('#JurusanM_id').val('');
            $('#JurusanM_kode').val('');
            $('#JurusanM_nama').val('');
            $('#JurusanM_is_active').val(1);
            $('#JurusanM_is_active').prop('checked', true);
            $('#btnSubmit').attr('onClick', 'Add()');
            $('#ModalJurusan').modal('show');
        } else if(type == 'Edit'){
            $('#ModalTitle').text('Edit');
            $('#JurusanM_id').val(id);
            $('#JurusanM_kode').val(kode);
            $('#JurusanM_nama').val(nama);
            (is_active==1) ? $('#JurusanM_is_active').prop('checked', true) : $('#JurusanM_is_active').prop('checked', false);
            $('#JurusanM_is_active').val(is_active);
            $('#btnSubmit').attr('onClick', 'Update()');
            $('#ModalJurusan').modal('show');
        }
    }

    function Refresh(){
        $.ajax({
            url: '<?php echo $this->createUrl('Refresh'); ?>', 
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
    
    function Add(){
        var kode = $('#JurusanM_kode').val();    
        var nama = $('#JurusanM_nama').val();        
        var is_active = $('#JurusanM_is_active').val();
        $.ajax({
            url: '<?php echo $this->createUrl('Add'); ?>', 
            type:'POST', 
            data:{
                kode,
                nama,
                is_active
            },
            dataType:'json',
            success: function(result){
                if (result.success == true){
                    $('#JurusanM_id').val('');
                    $('#JurusanM_kode').val('');
                    $('#JurusanM_nama').val('');
                    $('#JurusanM_is_active').val(1);
                    $('#JurusanM_is_active').prop('checked', true);
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

    function Update() {
        var id = $('#JurusanM_id').val();
        var kode = $('#JurusanM_kode').val();
        var nama = $('#JurusanM_nama').val();
        var is_active = $('#JurusanM_is_active').val();
        $.ajax({
            url: '<?php echo $this->createUrl('Update'); ?>',
            type: 'POST',
            data: {
                id,
                kode,
                nama,
                is_active
            },
            dataType: 'json',
            success: function(result){
                if (result.success == true){
                    iconMsg = 'success';
                    titleMsg = 'Success';
                    $('#ModalJurusan').modal('hide');
                    Refresh();
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


    function Delete(id) {
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
                    url: '<?php echo $this->createUrl('Delete'); ?>',
                    type: 'POST',
                    data: {
                        id
                    },
                    dataType: 'json',
                    success: function(result){
                        if (result.success == true){
                            iconMsg = 'success';
                            titleMsg = 'Success';
                            Refresh();
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