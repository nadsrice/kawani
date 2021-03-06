<div class="row">
    <div class="col-md-6">&nbsp;</div>
    <div class="col-md-6">
        <div class="pull-right">
            <a href="<?php echo site_url('holidays/add'); ?>" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                <span>Add Holiday</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-list"></i> <h3 class="box-title">List of Holidays</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover" id="datatables-banks">
                    <thead>
                        <tr>
                            <th style="width: 250px;">&nbsp;</th>
                            <th class="text-left">Holiday</th>
                            <th class="text-left">Date</th>
                            <th class="text-left">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( ! empty($banks)): ?>
                            <?php foreach ($banks as $bank): ?>
                                <tr>
                                    <td>
                                        <a class="<?php echo $btn_view; ?>" href="<?php echo site_url('banks/details/' . $bank['id']); ?>">
                                            <i class="fa fa-search"></i> View
                                        </a>
                                        <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('banks/edit_confirmation/' . $bank['id']); ?>" data-toggle="modal" data-target="#update-bank-<?php echo md5($bank['id']); ?>">
                                            <i class="fa fa-pencil-square-o"></i> Edit
                                        </a>
                                         <a class="<?php echo $btn_update; ?>" href="<?php echo site_url('banks/update_status/' . $bank['id']); ?>" data-toggle="modal" data-target="#update-bank-status-<?php echo md5($bank['id']); ?>">
                                            <i class="fa fa-cog"></i> <?php echo $bank['status_label']; ?>
                                        </a>
                                    </td>
                                    <!-- <td class="text-right"><?php echo $bank['id']; ?></td> -->
                                    <td class="text-left"><?php echo $bank['name']; ?></td>
                                    <td class="text-left"><?php echo $bank['contact_person']; ?></td>
                                    <td class="text-right"><?php echo $bank['contact_number']; ?></td>
                                    <td class="text-left"><?php echo $bank['description']; ?></td>
                                </tr>
                                <div class="modal fade" id="update-bank-status-<?php echo md5($bank['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                                 <div class="modal fade" id="update-bank-<?php echo md5($bank['id']); ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <!-- http://localhost/kawani_ci/roles/update_status/1 -->

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="calendar"></div>
<script type="text/javascript">
    $(document).ready(function() {
        var date_last_clicked = null;
        $('#calendar').fullCalendar({
            eventSources: [
               {
                    color: '#18b9e6',
                    textColor: '#000000',
                    events: function(start, end, timezone, callback) {
                        $.ajax({
                            url: '<?php echo site_url('holidays/ajax_calendar_event'); ?>',
                            dataType: 'json',
                            success: function(response) {
                                var events = response.events;
                                callback(events);
                            }
                        });
                    }
               }
           ],
           dayClick:  function(date, jsEvent, view) {
                date_last_clicked = $(this);
                alert('ASDASD');
            },
        });
    });
</script>
