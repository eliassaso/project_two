<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" type="text/css" href="application/views/index.css">

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
	#containerPost{
		width: 80%;
		height: 290px;
		padding-left: 2%; 
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	
	#containerBlog{
		width: 80%;
		height: 100px;
		padding-left: 2%; 
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	#containerBlogger{
		width: 80%;
		height: 290px;
		padding-left: 2%; 
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	#return{
		
	}
	#div_header{
		float: right;
		margin-left: 2%;
	}
	</style>
</head>
<header>
		<div id="div_header"><h2><a id='return' href="<?php echo base_url().'/index.php' ?>">Log Out</a></h2></div>
		<div id="div_header"><h2><a id='return' href="<?php echo base_url().'/index.php/blog/edit_coment'; ?>">Blog Edit </a> </h2></div>
</header>

<body>

<div id="containerBlogger">
 
		<FORM name="frmBlogger" method="post" action="<?php echo base_url().'/index.php/blog/load_blogger_show'; ?>" > 
			<h1><strong>BLOGGER DATA:</strong></h1>
			<br><br><br>
			<h1><strong>Name:  </strong><?php echo $blogger->nombre;?></h1>
			<br><br><br>
			<h1><strong>Bibliography:  </strong><?php echo $blogger->bibliografia; ?></h1>
			<br><br><br>
			<h1><a href=<?php echo $blogger->redes_sociales; ?> target="_blank">facebook Blogger</a></h1><br><br><br>
			<input type="submit" name="edit" value="Edit">
		</FORM>

</div>

<div id="containerBlog">
	<FORM name="frmBlog" method="post" action="<?php echo base_url().'/index.php/blog/load_blog_show'; ?>" > 
		<h1><strong>BLOG DATA:</strong></h1>
		<h1><strong>Name: </strong> <?php echo $blog->nombre_blog;?></h1>
		<h1><strong>detail: </strong> <?php echo $blog->detalle; ?></h1><br><br><br>
		<input type="submit" name="edit" value="Edit">
	</FORM>
</div>

<div id="containerPost">
	<FORM name="frmPost" method="post" action="insert_post" > 
			
			

		<h1><strong>Write post:</strong></h1>
		<br><br><br>
		
		<input type="hidden" name="id_blog" value=<?php echo $blog->id_blog;?>>
		<input type="hidden" name="id_blogger" value=<?php echo $blogger->id_blogger;?>>



		<h2>Title:  <INPUT TYPE="text" PLACEHOLDER="title" name="title" ></h2>
		
		<h2>Post:</h2> <textarea name="post_blogger" type="textarea" rows="4" cols="120"> </textarea>
		<input type="submit" name="consultar" value="Create">

	</FORM>
</div>

</body>
</html>