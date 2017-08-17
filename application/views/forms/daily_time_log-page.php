<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <!-- <div class="box-header with-border">
                <i class="fa fa-pencil-square-o"></i> <h3 class="box-title">Add Holiday</h3>
            </div> -->
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('daily_time_logs/time_in'); ?>" method="post">
                     <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-6">
                            <button type="submit" class="<?php echo $btn_submit; ?>">Time In</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('daily_time_logs/time_out'); ?>" method="post">
                     <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-6">
                            <button type="submit" class="<?php echo $btn_submit; ?>">Time Out</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
