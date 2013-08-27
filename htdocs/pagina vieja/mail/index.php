<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Send a mail with php and ajax using jquery</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="ajax.js"></script>
</head>

<body>

<div id="wrap">
	<h1>Send a mail using jquery, php and Ajax</h1>
	<h4>By <a href="http://lastwebdesigner.com" title="web design resources">LastWebDesigner</a></h4>
	<div class="mail">
			<div id="response">
		
		</div>
		<form id="formail" action="" method ="post">
			<label>Name : </label>
			<input type="text" name="name" id="name" />
			<label>Your mail :</label>
			<input type="text" name="mail" id="mail" />
			<label>Subject : </label>
			<input type="text" name="subject" id="subject" />
			<label>Text :</label>
			<textarea name="text" id="text" cols="40" rows="10"></textarea> 
			<input type="submit" value="send mail" id="sendmail" name="sendmail" />
			</form>
	</div>

</div>

</body>
</html>
