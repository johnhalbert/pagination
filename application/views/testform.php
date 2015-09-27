<html>
<head>
	<title>Form</title>
</head>
<body>
<form action='/tables/retrieve' method='post'>
		<label>Name:</label> <input type='text' name='name' id='name' />
		From Date: <input type='text' class='datepicker' name='from' id='from' />
		To Date: <input type='text' class='datepicker' name='to' id='to' />
		<input type='hidden' name='' value='' />
		<input type='submit' value='Submit' />
	</form>	
</body>
</html>