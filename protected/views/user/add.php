<?php
$form=$this->beginWidget('CActiveForm', array(
                'id'=>'formUser',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                'validateOnSubmit'=>true
                ),
                'htmlOptions'=>['enctype'=>"multipart/form-data"]
            )); 
?>

<!-- Form User -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Add User</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">                   
                <div class="form-group">                 
                    <?php echo $form->labelEx($formUser,'no_identitas'); ?>
                    <?php echo $form->textField($formUser,'no_identitas', ['class'=>"form-control", 'placeholder'=>"Enter the identification number"]); ?>
                </div>           
                <div class="form-group">                 
                    <?php echo $form->labelEx($formUser,'name'); ?>
                    <?php echo $form->textField($formUser,'name', ['class'=>"form-control", 'placeholder'=>"Enter name"]); ?>
                </div>     
                <div class="form-group row">                
                    <?php echo $form->labelEx($formUser,'gender', ['class'=>"col-sm-2 col-form-label"]); ?> 
                    <div class="col-sm-10">
                        <?php echo $form->radioButtonlist($formUser,'gender', ['Laki-laki'=>'Laki-laki', 'Perempuan'=>'Perempuan'],['class'=>"form-check-input gender"]); ?>
                    </div>
                </div>       
                <div class="form-group row">  
                    <div class="col-sm-6">
                        <?php echo $form->labelEx($formUser, 'placeofbirth'); ?>
                        <?php echo $form->textField($formUser, 'placeofbirth', ['class'=>"form-control", 'placeholder'=>"Enter the place of birth"]); ?>
                    </div>
                    <div class="col-sm-6">
                        <?php echo $form->labelEx($formUser,'dateofbirth'); ?>
                        <?php echo $form->dateField($formUser,'dateofbirth', ['class'=>"form-control", 'id'=>'MUser_dateofbirth']); ?>
                    </div>
                </div>   
                <div class="form-group row">
                    <div class="col-sm-6">
                        <?php echo $form->labelEx($formUser,'id_major'); ?>
                        <?php echo $form->dropDownList(
                            $formUser,
                            'id_major', 
                            CHtml::listData(MMajor::model()->findAll(['condition'=>'is_active and NOT is_deleted','order'=>'major_name']),'id','major_name'), 
                            ['class'=>'custom-select']); 
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php echo $form->labelEx($formUser,'id_batch'); ?>
                        <?php echo $form->dropDownList(
                            $formUser,
                            'id_batch', 
                            CHtml::listData(MBatch::model()->findAll(['condition'=>'is_active and NOT is_deleted','order'=>'batch_name']),'id','batch_name'), 
                            ['class'=>'custom-select']); 
                        ?>
                    </div>
                </div>  
                <div class="form-group">                 
                    <?php echo $form->labelEx($formUser,'username'); ?>
                    <?php echo $form->textField($formUser,'username', ['class'=>"form-control", 'placeholder'=>"Enter username"]); ?>
                </div>    
                <div class="form-group">                 
                    <?php echo $form->labelEx($formUser,'password'); ?>
                    <?php echo $form->passwordField($formUser,'password', ['class'=>"form-control", 'placeholder'=>"Enter password"]); ?>
                </div>    
                <div class="form-group">
                    <?php echo $form->labelEx($formUser,'user_role'); ?>
                    <select class="custom-select" name="MUser[user_role]" id="MUser_user_role">
                        <!-- <option selected>Open this select menu</option> -->
                        <option value="admin">Admin</option>
                        <option value="student">Student</option>
                    </select>
                </div>    
                <div class="form-group form-check">                        
                    <?php echo $form->checkbox($formUser,'is_active', ['class'=>"form-check-input is_active", 'id'=>'MUser_is_active', 'checked'=> true]); ?>
                    <?php echo $form->labelEx($formUser,'is_active', ['class'=>"form-check-label"]); ?>
                </div>
                <div class="form-group">
                    <a href='<?php echo $this->createUrl("index"); ?>' class="btn btn-secondary">
                        <span class="text">Cancel</span>
                    </a>
                    <button type="button" class="btn btn-primary" id="btnSubmit" onclick='Save()'>Save</button>
                </div>
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <!-- Photo -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Photo</h6>
                    </div>
                    <div class="card-body">
                        <div class="custom-file">                        
                            <input type="file" class="custom-file-input" id="customFile" name="userFile" accept="image/*" onchange="upload()">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div class='mt-3 text-center'>
                            <canvas id= "canv1" style="height: 175px;" class='text-center'></canvas> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function upload(){
        var imgcanvas = document.getElementById("canv1");
        var fileinput = document.getElementById("customFile");
        var image = new SimpleImage(fileinput);
        image.drawTo(imgcanvas);
    }

    function ResetForm(){
        $('#MUser_no_identitas').val('');
        $('#MUser_name').val('');
        $('#MUser_placeofbirth').val('');
        $('#MUser_dateofbirth').val('');
        $('#MUser_id_major').val('');
        $('#MUser_id_batch').val('');
        $('#MUser_username').val('');
        $('#MUser_password').val('');
        $('#MUser_user_role').val('');
        $('#MUser_is_active').val(1).prop('checked', true);
    }

    function Save(){
        var no_identitas = $('#MUser_no_identitas').val();
        var name = $('#MUser_name').val();
        var gender = $('.gender').val();
        var placeofbirth = $('#MUser_placeofbirth').val();
        var dateofbirth = $('#MUser_dateofbirth').val();
        var id_major = $('#MUser_id_major').val();
        var id_batch = $('#MUser_id_batch').val();
        var username = $('#MUser_username').val();
        var password = $('#MUser_password').val();
        var user_role = $('#MUser_user_role').val();
        var is_active = $('#MUser_is_active').val();
        $.ajax({
            url: '<?php echo $this->createUrl("addUser"); ?>',
            type: 'POST',
            data: {
                no_identitas,
                name,
                gender,
				placeofbirth,
				dateofbirth,
				id_major,
                id_batch,
                username,
                password,
                user_role,
                is_active
            },
            dataType: 'json',
            success: function(result){
                if (result.success == true){
                    iconMsg = 'success';
                    titleMsg = 'Success';
                    ResetForm();
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
    
</script>

<?php $this->endWidget(); ?>