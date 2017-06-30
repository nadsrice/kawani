<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('attendance_overtimes/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>File Overtime<span>
            </a>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Summary</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa   fa-clock-o"></i> Pending <span class="label pull-right pending_color">1,200</span></a></li>
                <li  class="active"><a href="#"><i class="fa fa-thumbs-up"></i> Approved <span class="label pull-right approved_color">103</a></li>
                <li><a href="#"><i class="fa fa-thumbs-down" ></i> Rejected <span class="label pull-right rejected_color">165</span></a></li>
                <li><a href="#"><i class="fa fa-times-circle"></i> Cancelled <span class="label pull-right cancelled_color">65</span></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>


    <div class="col-md-9">
        <div class="box box-primary">
             <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Filed Overtimes</h3>
            </div>
            <br>
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1" data-toggle="tab">My Overtime</a>
                </li>
                <li class="">
                    <a href="#tab2" data-toggle="tab">Approvals</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                    <table class="table table-bordered table-striped table-hover" id="">
                        <thead>
                            <tr>
                                <th class="text-left">Date</th>
                                <th class="text-left">Time Start</th>
                                <th class="text-left">Time End</th>
                                <th class="text-left">Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">TAB 1 DATA</td>
                                <td class="text-left">TAB 1 DATA</td>
                                <td class="text-left">TAB 1 DATA</td>
                                <td class="text-left">TAB 1 DATA</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade in" id="tab2">
                    <table class="table table-bordered table-striped table-hover" id="">
                        <thead>
                            <tr>
                                <th class="text-left">Employee Code</th>
                                <th class="text-left">Employee Name</th>
                                <th class="text-left">Date</th>
                                <th class="text-left">Time Start</th>
                                <th class="text-left">Time End</th>
                                <th class="text-left">Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-right">0072</td>
                                <td class="text-left">Josh Gono</td>
                                <td class="text-right">2020-06-28</td>
                                <td class="text-right">12:00 PM</td>
                                <td class="text-right">12:00 AM</td>
                                <td class="text-left">HAHA</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
