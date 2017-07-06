<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<title>KAWANI Human Resource Information System [DEV:PROTOTYPE_VERSION]</title>

		<!-- <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
		<link rel="shortcut icon" type="image/png" href="http://eg.com/favicon.png"/> -->

		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/bootstrap/3.3.7/css/bootstrap.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/icon-fonts/font-awesome/4.3.0/css/font-awesome.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/icon-fonts/ionicons/2.0.1/css/ionicons.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/select2/select2.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/datatables/dataTables.bootstrap.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/daterangepicker/daterangepicker.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/timepicker/bootstrap-timepicker.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/toastr/toastr.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/iCheck/all.css'); ?>">

		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/adminLTE/2.3.11/dist/css/AdminLTE.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/libs/adminLTE/2.3.11/dist/css/skins/_all-skins.min.css'); ?>">


		 <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/kawani-styles.css'); ?>"> 
		 <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/app-custom.css'); ?>">


		<script type="text/javascript" src="<?php echo site_url('assets/libs/jquery/3.2.1/jquery.min.js'); ?>"></script>

		<script>
			var BASE_URL = '<?php echo base_url(); ?>';
		</script>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body class="<?php echo $layout_color . ' ' . $layout_option; ?>">
		<div class="wrapper">
			<?php (isset($main_header)) ? $this->load->view($main_header) : ''; ?>
			<?php (isset($main_sidebar)) ? $this->load->view($main_sidebar) : ''; ?>
			<div class="content-wrapper">
				<section class="content-header">
					<h1><?php echo $page_header; ?></h1><hr>
				</section>
				<section class="content">
					<?php $this->load->view('pages/view-alerts'); ?>
					<?php (isset($sub_view)) ? $this->load->view($sub_view) : ''; ?>
				</section>
			</div>
			<?php (isset($main_footer)) ? $this->load->view($main_footer) : ''; ?>
			<?php (isset($main_control_sidebar)) ? $this->load->view($main_control_sidebar) : ''; ?>
		</div>

		<script type="text/javascript" src="<?php echo site_url('assets/libs/bootstrap/3.3.7/js/bootstrap.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/adminLTE/2.3.11/dist/js/app.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/bootstrap-iconpicker/js/iconset/iconset-fontawesome-4.3.0.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/toastr/toastr.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/moment/moment.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/daterangepicker/daterangepicker.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/timepicker/bootstrap-timepicker.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/datatables/jquery.dataTables.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/datatables/dataTables.bootstrap.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/select2/select2.full.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/fastclick/fastclick.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/libs/iCheck/icheck.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('assets/js/kawani-datatables-custom.js'); ?>"></script>


		<!-- Custom Javascript -->
		<script type="text/javascript" src="<?php echo site_url('assets/js/icheck-custom.js'); ?>"></script>

		<script type="text/javascript">
			$(document).ready(function () {
				$('.select2').select2();
				$('.reservation').daterangepicker({
					format: 'YYYY-MM-DD h:mm:ss A',
					timePicker: true,
					timePickerIncrement: 1,
				});
				$(".timepicker").timepicker({
					showInputs: false
				});

				$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
					checkboxClass: 'icheckbox_flat-green',
					radioClass: 'iradio_flat-green'
				});
			});
		</script>
	</body>
</html>
