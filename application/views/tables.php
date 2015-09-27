<!DOCTYPE html>
<html>
<head>
	<title>Tables</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src='/assets/js/pagination.js'></script>
</head>
<body>
	<div class='container'>
		<div class='row'>
			<div class='col-md-12'>
				<h1>Pagination with jQuery/AJAX in CodeIgniter</h1>

				<form>
					<label>Name:</label> <input type='text' name='name' id='name' />
					From Date: <input type='text' class='datepicker' name='from' id='from' />
					To Date: <input type='text' class='datepicker' name='to' id='to' />
				</form>	

				<div id='pages'></div>
				<div id='table'></div>

			</div>
		</div>
	</div>
</body>
</html>