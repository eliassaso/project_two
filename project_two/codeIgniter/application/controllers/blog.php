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

        //$this->id_blog = $data['blog']->id_blog;
        //$this->id_blogger = $data['blogger']->id_blogger;

        //print_r($data['blog']->nombre_blog);
        //echo $this->id_blog;
        

        	if ($data['post'] !== 'incorrect') :
        				
        			$this->load->view('blog_admin', $data);	
        		//print_r(base_url());
        	 else :
        	 		$data['post'] = "incorrect user or password";
        			$this->load->view('blog_show',$data);
        			//redirect(base_url());
        			//redirect("index.php");
        			endif;				
        	

        //$this->load->view(‘blog/list_posts’,$data);


       


        //$user = $this->validate_credentials($frmLogin["user"], $frmLogin["pass"]);
        //var_dump($user);


            /*if($user = $this->validate_credentials($frmLogin["user"], $frmLogin["pass"])){
                redirect(base_url());
            }else{
                $this->load->view('blog_show', array('error'=>TRUE));
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
        'nombre_usuario' => $this->input->post('nombre_usuario'),
        'coment_post' => $this->input->post('coment_post'),
        );

        if (($frmPostEntry['nombre_usuario'] == '') || ($frmPostEntry['coment_post'] == ' ')) {
            

            ?>
                <script type="text/javascript"> 
                    alert("check that the fields are full: 'who says' and 'comment'") 
                    window.location.href = "<?php echo base_url().'/index.php'?>";   
                </script>
            <?php


        } else {
             
		date_default_timezone_set('America/Costa_Rica');	
		$frmPostEntry['fecha_comentario'] = ($fecha = date("y-m-d"));
		$frmPostEntry['estado'] = "n";

		$this->blog_model->insert_coment($frmPostEntry);
        $this->index();

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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */