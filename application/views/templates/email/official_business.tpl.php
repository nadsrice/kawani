<html>
    <body>
        <h1>Official Business Request</h1>
        <p>Requested by: <?php echo $requester_data['full_name']; ?> - <?php echo $requester_data['employee_code']; ?></p>
        <p>Time Start:  <?php echo $ob_data['time_start']; ?></p>
        <p>Time End:    <?php echo $ob_data['time_end']; ?></p>
        <p>Agenda:    <?php echo $ob_data['agenda']; ?></p>
        <p>
        	This is to request my official business on <?php echo $ob_data['date'] ?> at <?php echo $ob_data['time_start'].' - '.$ob_data['time_end']; ?> in <?php echo $ob_data['account_name'] ?>.
        </p>
        <a href="<?php echo site_url('attendance_official_businesses/approve/'.$ob_data['id']); ?>">APPROVE</a> | <a href="<?php echo site_url('attendance_official_businesses/disapprove/'.$ob_data['id']); ?>">REJECT</a> <!-- | <a href="<?php echo site_url('attendance_leaves/disapprove/'.$ob_data['id']); ?>">CANCEL</a> --></p> 
    </body>
</html>
