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
			width: 95%;
			height: 260px;
			padding-left: 2%; 
			margin: 10px;
			border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;
		}
		#containerPost{
			width: 95%;
			/*height: 250px;*/
			padding-left: 2%; 
			margin: 10px;
			/*border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;*/
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
	<div id="div_header"><h2><a id='return' href="<?php echo base_url().'/index.php' ?>">Log Out</a></h2></div>
	<div id="div_header"><h2><a id='return' href="<?php echo base_url().'/index.php/blog/reload_admin_show' ?>">Return</a></h2></div>
</header>


	<?php foreach($post_blogger as $entry) : ?>
		 <form id='containerPost' name="frmPostEntry" method="post" action="">
		 					<input type="hidden" name="id_post" value=<?php echo $entry->id_post;?>>
		 					<a href="<?php echo base_url().'/index.php/blog/delete_post/'.$entry->id_post; ?>"> ( Delete Post)</a> <br /> 
	                        <h2><?=$entry->titulo?></h2>
	                        <h4>Date: <?=$entry->fecha?></h4>
	                        Post: <?=$entry->contenido?><br />	<br />	<br />	

	                        <div id="containerComent">	

								<?php foreach($coment as $coments) : ?>

									<form id='containerComent_user' name="frmComent" method="post" action="<?php echo base_url().'/index.php/blog/update_comment'; ?>">
						 					<?php if($coments->id_post == $entry->id_post) { ?>
												
												<input type="hidden" name="id_coment" value=<?php echo $coments->id_comentario;?>>
						                        <strong><?=$coments->nombre_comentarista?></strong><br>
						                        <strong>Date:</strong> <?=$coments->fecha_comentario?>
						                        <strong>Coment:</strong> <?=$coments->contenido_comentario?>
						                        <a href="<?php echo base_url().'/index.php/blog/delete_comment/'.$coments->id_comentario; ?>"> ( Delete comment)</a> <br /> 

							                        <?php
														if ($coments->estado == "n" ){ ?>
																
															<input type="submit" name="approve" value="Approve"> <hr>


													<?php	}else{
															echo "State: <input type=checkbox disabled='true' name= 'approve' checked><hr>";
														};
													?>
						                                    

					                       		<?php }else{ ?>
					                       	<!--<h5>no more coments</h5>-->
					                       		<?php  } ?> 					                     																	                
			     					</form>   

			     				<?php endforeach; ?>			     				

		     				</div>
		     				<br><br><br><br>

		     				<hr size="5" color="#656565"/>
	 	</form>
    <?php endforeach; ?>

</body>
</html>
