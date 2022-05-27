<?php
class Products extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('ProductModel');
	}
	function index(){
		$this->load->view('listProducts');
	}
	function show(){
		$data=$this->ProductModel->productList();
		echo json_encode($data);
	}
	function save(){
		$config = array();
	    $config['upload_path'] = './upload/';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size']      = '0';
	    $config['overwrite']     = FALSE;
	    $this->load->library('upload', $config);  
		$file_name = "";
		$dataInfo = array();
	    $files = $_FILES;
	    $cpt = count($_FILES['product_image']['name']);
          
		if(isset($_FILES["product_image"]["name"]))  
       	{  
       		for($i=0; $i<$cpt; $i++)
		    	{           
		        $_FILES['product_image']['name']= $files['product_image']['name'][$i];
		        $_FILES['product_image']['type']= $files['product_image']['type'][$i];
		        $_FILES['product_image']['tmp_name']= $files['product_image']['tmp_name'][$i];
		        $_FILES['product_image']['error']= $files['product_image']['error'][$i];
		        $_FILES['product_image']['size']= $files['product_image']['size'][$i];    

		        if(!$this->upload->do_upload('product_image'))  
	            {  
	                 echo $this->upload->display_errors();  
	            } 
	            else{
	            	$dataInfo[] = $this->upload->data(); 
	            }
		    	}
            	$file_names = array_column($dataInfo, 'file_name');
            	//$file_name = json_encode($file_names);
            	$file_name = implode(',', $file_names);
            //print_r($dataInfo);die;
       	}
       		$data = array(				
				'product_name' => $this->input->post('product_name'), 
				'product_price'=> $this->input->post('product_price'), 
				'product_desccription' => $this->input->post('product_desccription'), 
				'product_image' => $file_name
			);
		$result=$this->ProductModel->saveEmp($data);
		echo json_encode($result);
	}
	function update(){
		$id=$this->input->post('id');
		$config = array();
	    $config['upload_path'] = './upload/';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size']      = '0';
	    $config['overwrite']     = FALSE;
	    $this->load->library('upload', $config);  
		$file_name = "";
		$dataInfo = array();
	    $files = $_FILES;
	    $cpt = count($_FILES['product_image']['name']);
          
		if($_POST["edit_image"]>0)  
       	{  
       		for($i=0; $i<$cpt; $i++)
		    	{           
		        $_FILES['product_image']['name']= $files['product_image']['name'][$i];
		        $_FILES['product_image']['type']= $files['product_image']['type'][$i];
		        $_FILES['product_image']['tmp_name']= $files['product_image']['tmp_name'][$i];
		        $_FILES['product_image']['error']= $files['product_image']['error'][$i];
		        $_FILES['product_image']['size']= $files['product_image']['size'][$i];    

		        if(!$this->upload->do_upload('product_image'))  
	            {  
	                 echo $this->upload->display_errors();  
	            } 
	            else{
	            	$dataInfo[] = $this->upload->data(); 
	            }
		    	}
            	$file_names = array_column($dataInfo, 'file_name');
            	//$file_name = json_encode($file_names);
            	$file_name = implode(',', $file_names);
            //print_r($dataInfo);die;
       	}
       	else{
	        $file_name = $this->input->post('old_image');
	    	}
       		$data = array(				
				'product_name' => $this->input->post('product_name'), 
				'product_price'=> $this->input->post('product_price'), 
				'product_desccription' => $this->input->post('product_desccription'), 
				'product_image' => $file_name
			);
		$result=$this->ProductModel->updateEmp($id,$data);
		echo json_encode($result);
	}
	function delete(){
		$data=$this->ProductModel->deleteEmp();
		echo json_encode($data);
	}
}