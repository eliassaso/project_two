
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<style type="text/css">

		::selection{ background-color: #E13300; color: white; }
		::moz-selection{ background-color: #E13300; color: white; }
		::webkit-selection{ background-color: #E13300; color: white; }

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}
		header{
			width: 80%;
			height: 50px;
		}
		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
			float: left;
		}
		h4 {
			
			border-bottom: 1px solid #EBEAFD;;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}
		h3 {
			float: left;
		}
		textarea{
			/*margin-top: 2%;*/
			float: right;
		}

		#body{
			margin: 0 15px 0 15px;
		}
		
		p.footer{
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}
		
		#containerBlog{
			background-color: #DDF5FF;
			width: 80%;
			height: 330px;
			padding-left: 2%; 
			margin: 10px;
			border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;
		}
		#containerComent_user{
			/*background-color: #FFFED3;*/
			width: 95%;
			/*height: 200px;*/
			/*padding-left: 2%; 
			margin: 10px;
			/*border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;*/
		}
		#containerPost{
			width: 95%;
			/*height: 200px;*/
			padding-left: 2%; 
			margin: 10px;
			/*border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;*/
		}
		#container{
			background-color: #D6D6D6;
			width: 90%;
			height: 70px;
			padding-left: 2%; 
			margin: 10px;
			border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;
		}
		#containerComent{
			width: 90%;
			/*height: 60px;*/
			padding-left: 2%; 
			margin: 10px;
			/*border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;*/
		}
		#containerComentSays{
			background-color: #E4E4E4;
			border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;
			width: 90%;
			height: 60px;
			padding-left: 2%; 
			margin: 10px;
			/*border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;*/
		}
		#div_header{
			float: right;
			margin-left: 2%;
		}

	</style>
</head>
<body>
	<header>
			<div id="div_header"><h2><a id='return' href="<?php echo base_url().'/index.php/blog/reload_admin_show' ?>">Return</a></h2></div>
	</header>

<div id="containerBlog">

	<h2><strong>BLOG DATA:</strong></h2><br><hr>
		<FORM name="frmBlogger" method="post" action="<?php echo base_url().'/index.php/blog/update_blog'; ?>" > 
			<h3>Blog Name:  <h3><INPUT TYPE="text" size="50" name="name_blog" value="<?php echo $blog->nombre_blog;?>"></h3></h3><br><br><br>
			<h3>Topic:  <h3><INPUT TYPE="text" size="80" name="detail" value="<?php echo $blog->detalle;?>"></h3><br><br><br>

			<h3><input type="submit" name="edit" value="Accept"></h3>

		</FORM>
</div>
	
</body>
</html>
