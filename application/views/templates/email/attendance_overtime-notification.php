<html>
    <body>
        <h1>Overtime</h1>
        <p>Requested by: <?php echo $employee_data['first_name'].' '.$employee_data['last_name']; ?></p>
        <p>This is to request the approval for my overtime on <?php echo $ot_data['date']; ?> at 
          <?php echo $ot_data['time_start'].'-'.$ot_data['time_end']; ?> 

        </p>
        <p></p>
        <p><a href="<?php echo site_url('attendance_overtimes/approve/'.$ot_id); ?>">APPROVE</a> | <a href="<?php echo site_url('attendance_overtimes/reject/'.$ot_id); ?>">DISAPPROVE</a> | <a href=" <?php echo site_url('attendance_overtimes/cancel/'.$ot_id); ?> ">CANCEL</a></p>
    </body>
</html>
