<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create Evenet</title>
</head>
<body>
	<form method="Post">
		
		Event Name: 
			<input type = "textbox" name = "eventName">

		<br />
		<br />

		Event Description:
			<input type = "textArea" name = "description">

		<br />
		<br />

		Date: 
			<input type="date" name = "e-Date">

		<br />
		<br />

		Time: 
			<input type="time" name = "e-Time">

		<br />
		<br />

		Contact Phone: 
			<input type = "textbox" name = "eventPhone">

		<br />
		<br />

		Contact Email: 
			<input type = "textbox" name = "eventEmail">

		<br />
		<br />

		Category:

			<select name="category">
				<option value="Public">Public</option>
				<option value="Private">Private</option>
				<option value="RSO">RSO</option>
			</select> 

		<br />
		<br />

		<input type = "submit" value = "submit">

	</form>
</body>
</html>