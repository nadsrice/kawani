<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Edit Company Detail</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('companies/edit/'.$company['id']); ?>" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" value="<?php echo $company['name']; ?>">
                            <div class="validation_error"><?php echo form_error('name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Short Name</label>
                        <div class="col-md-6">
                            <input type="text" name="short_name" class="form-control" value="<?php echo $company['short_name']; ?>">
                            <div class="validation_error"><?php echo form_error('short_name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-6">
                            <textarea name="description" class="form-control" rows="4" cols="40"><?php echo $company['description']; ?></textarea>
                            <div class="validation_error"><?php echo form_error('description'); ?></div>
                        </div>
                    </div>    
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="<?php echo $btn_submit; ?>">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
