<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary">Master / User</i></h6>
            <a href='<?php echo $this->createUrl("add"); ?>' class="btn btn-primary btn-icon-split" >
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add User</span>
            </a>         
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Identity Number</th>
                        <th>Name</th>
                        <th>Major</th>
                        <th>Batch</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Identity Number</th>
                        <th>Name</th>
                        <th>Major</th>
                        <th>Batch</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
					<?php $this->renderPartial('_row',['modUser'=>$modUser]) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>