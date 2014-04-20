<?php 

    

 class Blog_model extends CI_Model {

 	    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

    }

	  function validate_credentials($username, $password){

            $queryUsuario = $this->db->query("SELECT * FROM usuario where user = '$username' and pass = $password");
      			return $queryUsuario->row();
           
    }

    function db_blogger(){

            $queryBlogger = $this->db->get('blogger');
            return $queryBlogger->row();

    }

    function db_blog(){

            $queryBlog= $this->db->get('blog');         
            return $queryBlog->row();

 
    }

    function db_post_blogger(){

            return $this->db->query('SELECT * FROM post ORDER BY id_post DESC')->result();
  
    }

    function get_coment_approve(){
    
      try {
             return $this->db->query("SELECT * FROM comentario WHERE estado = 's';")->result();  

      } catch (Exception $e) {

              echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            }      
 
    }

    function get_coment_post(){
    
            return $this->db->get('comentario')->result();    
 
    }

    function get_coment_id_recent(){
    
            return $this->db->query("SELECT * FROM comentario ORDER BY id_comentario DESC;")->row();   

 
    }

    function insert_content_post($db_post){
      
            
     $this->db->query("INSERT INTO post (id_blog, id_blogger, titulo, fecha, contenido) 
                               VALUES (".$db_post['id_blog'].", ".$db_post['id_blogger'].", 
                                      '".$db_post['title']."','".$db_post['fecha']."',
                                      '".$db_post['contenido']."')");   

            return "Insert sucessfully!!!";
 
    }

    function insert_coment($db_coment){
    
            
     $this->db->query("INSERT INTO comentario (id_post, nombre_comentarista, estado, fecha_comentario, contenido_comentario) 
                               VALUES (".$db_coment['id_post'].", ' ', 
                                      '".$db_coment['estado']."','".$db_coment['fecha_comentario']."',
                                      '".$db_coment['coment_post']."')");   
 
    }

    function db_update_comment($id_coment){
    
       try {

              $this->db->query ("UPDATE comentario SET estado = 's'  WHERE id_comentario = ".$id_coment.";"); 
         
      } catch (Exception $e) {

           echo 'Excepción capturada: ',  $e->getMessage(), "\n";

         }
                  //return "Insert sucessfully!!!";
    }

    function db_update_comment_facebook($datos){
    
     try {

            $this->db->query ("UPDATE comentario SET nombre_comentarista = '".$datos['nombre_usuario']."'  WHERE id_comentario = ".$datos['id_comentario'].";"); 
       
     } catch (Exception $e) {

       echo 'Excepción capturada: ',  $e->getMessage(), "\n";

     }

            //return "Insert sucessfully!!!";
 
    }

    function db_update_blogger($dataSet_blogger){
    
         try {

                $this->db->query ("UPDATE blogger SET nombre = '".$dataSet_blogger['user']."',
                                                      bibliografia = '".$dataSet_blogger['bibliography']."',
                                                      redes_sociales = '".$dataSet_blogger['social_networks']."'  
                                  WHERE  id_blogger = 1;"); 
           
         } catch (Exception $e) {

           echo 'Excepción capturada: ',  $e->getMessage(), "\n";

         }

            //return "Insert sucessfully!!!";
 
    }
    
    function db_update_blog($dataSet_blog){
    
         try {

                $this->db->query ("UPDATE blog SET nombre_blog = '".$dataSet_blog['name_blog']."',
                                                      detalle = '".$dataSet_blog['detail']."' 
                                  WHERE  id_blog = 1;"); 
           
         } catch (Exception $e) {

           echo 'Excepción capturada: ',  $e->getMessage(), "\n";

         }

            //return "Insert sucessfully!!!";
 
    }

    function db_delete_comment($id_coment){
    
       try {

              $this->db->query ("DELETE FROM comentario WHERE id_comentario = ".$id_coment.";"); 
         
       } catch (Exception $e) {

         echo 'Excepción capturada: ',  $e->getMessage(), "\n";

       }
    }

    function db_delete_post($id_post){
    
       try {

              $this->db->query ("DELETE FROM comentario WHERE id_post = ".$id_post.";");
              $this->db->query ("DELETE FROM post WHERE id_post = ".$id_post.";");  
         
       } catch (Exception $e) {

         echo 'Excepción capturada: ',  $e->getMessage(), "\n";

       }
    }

 }
?>