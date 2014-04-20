<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//load::models('blog_model');


class Blog extends CI_Controller {

	public $id_blog;
	public $id_blogger;


	public function __construct()
    	{
        	parent::__construct();
        	//$data['post'] = '';
        	//$this->load->library('database');
        	$this->load->model('blog_model'); 

    	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	/*public function index()
	{
		$this->load->view('welcome_message');
	}*/

	public function index()
	{
		
		$data['blogger'] = $this->blog_model->db_blogger();
        $data['blog'] = $this->blog_model->db_blog();
        $data['post_blogger'] = $this->blog_model->db_post_blogger();
        $data['coment'] = $this->blog_model->get_coment_approve();
		$data['post'] = '';
		$this->load->view('blog_show',$data);
		
	}
 	
 	public function consultPassword()
 	{
		
 		$frmLogin = array(
        'user' => $this->input->post('user'),
        'pass' => $this->input->post('pass')
        );

 		$frmLogin["pass"] = "SHA('".$frmLogin["pass"]."')";
        //$this->load->model('blog_model');
        $data['post'] = $this->blog_model->validate_credentials($frmLogin["user"], $frmLogin["pass"]);
        $data['post_blogger'] = $this->blog_model->db_post_blogger();
        $data['coment'] = $this->blog_model->get_coment_approve();
        $data['blogger'] = $this->blog_model->db_blogger();
        $data['blog'] = $this->blog_model->db_blog();    

        	if (count($data['post']) > 0) :
        				
        			$this->load->view('blog_admin', $data);	
        		//print_r(base_url());
        	 else :
        	 		$data['post'] = "incorrect";
        			$this->load->view('blog_show',$data);
        			endif;	
					
        /*if(count($data['post']) > 0){
        	$this->load->view('blog_admin', $data);
			
        }	else {
        	$message = "incorrect";
			redirect(base_url()/$message);
			
		}*/					
        	

    	}

	public function insert_post(){

		$frmPost = array(
        'title' => $this->input->post('title'),
        'contenido' => $this->input->post('post_blogger'),
        'id_blog' => $this->input->post('id_blog'),
        'id_blogger' => $this->input->post('id_blogger')
        );
		date_default_timezone_set('America/Costa_Rica');	
		$frmPost['fecha'] = ($fecha = date("y-m-d"));
        $data['blogger'] = $this->blog_model->db_blogger();
        $data['blog'] = $this->blog_model->db_blog(); 

        if (($frmPost['title'] == '') || ($frmPost['contenido'] == ' ')) {
            
            ?>
                <script type="text/javascript"> 
                    alert("check that the fields are full: 'Title' and 'content'")   
                </script>
            <?php

             $this->load->view('blog_admin', $data); 

        } else {               

    		$result_insert = $this->blog_model->insert_content_post($frmPost);
            $this->load->view('blog_admin', $data);    

        }
	}

	public function insert_coment(){

		
       
        $frmPostEntry = array(
        'id_post' => $this->input->post('id_post'),
        'coment_post' => $this->input->post('coment_post')
        );

        if (($frmPostEntry['coment_post'] == ' ')) {
            

            ?>
                <script type="text/javascript"> 
                    alert("check that the fields are full: 'who says' and 'comment'") 
                    window.location.href = "<?php echo base_url().'/index.php'?>";   
                </script>
            <?php


        } else {
         
        //$frmPostEntry['nombre_usuario'] = $datos['name'];       
		date_default_timezone_set('America/Costa_Rica');	
		$frmPostEntry['fecha_comentario'] = ($fecha = date("y-m-d"));
		$frmPostEntry['estado'] = "n";

		$this->blog_model->insert_coment($frmPostEntry);

        
        $this->send_mail($frmPostEntry);
        $this->fb();
        //$this->index();

        }   
	}

    public function edit_coment(){

        $data['post_blogger'] = $this->blog_model->db_post_blogger();
        $data['coment'] = $this->blog_model->get_coment_post();
        //print_r($data['coment']);
        $this->load->view('edit_coment_show',$data);

    }

    public function update_comment(){

        $id_comment = $this->input->post('id_coment');
        $this->blog_model->db_update_comment($id_comment);

        //$this->load->view('edit_coment_show',$data);
        $this->edit_coment();
        //echo $id_comment;
    }
    public function delete_comment($id_coment){

        $this->blog_model->db_delete_comment($id_coment);
        $this->edit_coment();

    }
    //cuando se elimina un post se deben eliminar sus comentarios
    public function delete_post($id_post){

        $this->blog_model->db_delete_post($id_post);
        $this->edit_coment();

    }    

    public function reload_admin_show(){

        $data['blogger'] = $this->blog_model->db_blogger();
        $data['blog'] = $this->blog_model->db_blog(); 

        $this->load->view('blog_admin', $data);    
    }
    public function load_blogger_show(){

        $data['blogger'] = $this->blog_model->db_blogger();

        $this->load->view('edit_blogger_show', $data);    
    }
    public function load_blog_show(){

        $data['blog'] = $this->blog_model->db_blog(); 

        $this->load->view('edit_blog_show', $data);    
    }
    public function update_blogger(){

        $frmBlogger = array(

            'user' => $this->input->post('user'),
            'bibliography' => $this->input->post('bibliography'),
            'social_networks' => $this->input->post('social_networks')

            );

        $this->blog_model->db_update_blogger($frmBlogger);
        $this->reload_admin_show();
        //$this->load->view('edit_coment_show',$data);
        //$this->edit_coment();
        //echo $id_comment;
    }
    public function update_blog(){

        $frmBlog = array(

            'name_blog' => $this->input->post('name_blog'),
            'detail' => $this->input->post('detail'),
            );

        $this->blog_model->db_update_blog($frmBlog);
        $this->reload_admin_show();
        //$this->load->view('edit_coment_show',$data);
        //$this->edit_coment();
        //echo $id_comment;
    }
	
	public function send_mail($coment){
		
			//se verifica que el archivo exista y este bien escrito!!
		///$str_datos = file_get_contents("config.json");
 
	
		$str_datos = file_get_contents("/var/www/php/project_two/codeIgniter/application/controllers/jsonFile.json");
	
		//se decodifican los datos del archivo json.
		$datos = json_decode($str_datos,true);
		//se crean las variables para cada uno de los valores del json para mas orden
		$ip_server = $datos['data_base']['ip_server'];
		$db_user = $datos['data_base']['user'];
		$db_pass = $datos['data_base']['pass'];
		 
		$senders = $datos['mail']['senders'];
		$pass = $datos['mail']['pass'];
		$server = $datos['mail']['server'];
		$receives = $datos['mail']['receives'];
			
		//se envia el correo con el protocolo SMTP
		require("class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Host = $server; // SMTP a utilizar. Por ej. smtp.elserver.com
		$mail->Username = $senders; // Correo completo a utilizar
		$mail->Password = $pass; // Contraseña
		$mail->Port = 587; // Puerto a utilizar
		$mail->From = "eliassaso@gmail.com"; // Desde donde enviamos (Para mostrar)
		$mail->FromName = "Elias";//"ELSERVER.COM";
		$mail->AddAddress($receives);//("eliassaso@gmail.com"); // Esta es la dirección a donde enviamos
		$mail->AddCC("");//("cuenta@dominio.com"); // Copia
		$mail->AddBCC("");//("cuenta@dominio.com"); // Copia oculta
		$mail->IsHTML(true); // El correo se envía como HTML
		$mail->Subject = "New comment"; // Este es el titulo del email.
		$body = "<h1 style='color:blue'>Comment: ".$coment['coment_post']."</h1>";
		//$body .= "<h1 style='color:blue'>Number of registered students = **** $fila **** </h1>";
		$mail->Body = $body; // Mensaje a enviar
		$mail->AltBody = "You have a new comment"; // Texto sin html
		$mail->AddAttachment("");//("imagenes/imagen.jpg", "imagen.jpg");
		$exito = $mail->Send(); // Envía el correo.

        return;
        
		/*if($exito){
			echo "\n\n*******Connected successfully!!!  The mail was sent.************\n\n";
		}else{
			echo "There was a drawback. Contact an administrator.\n";
		}*/
		
		//var_dump('idPost: '.$coment['id_post'].' --  User: '.$coment['nombre_usuario'].' --   Content: '.$coment['coment_post']);
		
	}

    public function fb(){

        require_once("fb.php"); 
        // Para conseguir las KEY, crean la aplicacion desde http://www.facebook.com/developers/createapp.php
        $facebook =  new Facebooklogin('688464854525247', 'aa3842f86f58308817e7b7199bcd700a',base_url().'/index.php/blog/fb'); // La url debe coneter el archivo donde esta ese script. Ejemplo: http://miweb.com/loginconfacebook.php/   
        // A continuacion se declaran los permisos 
        //$facebook->permissions("link"); // Se declara el permiso de acceso a la fecha de cumpleaños 
        $facebook->permissions("name"); // Se decalra el permiso de acceso al email 
        // Termina declaración de permisos       
        $facebook->conect(); // Empieza la conexión a Facebook 
        $datos = $facebook->getinfo(); // Se definde la variable datos con los datos del usuario. 
         
        //return $datos['name']; 

        $this->load->model('blog_model'); 
        $ultimo_comentario['comentario_reciente'] = $this->blog_model->get_coment_id_recent();
        $id_comentario = $ultimo_comentario['comentario_reciente']->id_comentario;

        $datos_actualizar = array('nombre_usuario' => $datos['name'], 'id_comentario' => $id_comentario);

        //date_default_timezone_set('America/Costa_Rica');
        //$this->send_mail($datos_actualizar);
        $this->blog_model->db_update_comment_facebook($datos_actualizar);
  
        $this->index();

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */