<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Items extends CI_Controller {


   /**
    * Get All Data from this method.
    *
    * @return Response
   */
   public function index()
   {


       if(!empty($this->input->get("search"))){
          $this->db->like('title', $this->input->get("search"));
          $this->db->or_like('description', $this->input->get("search")); 
       }

       $query = $this->db->get('products');
       $data['data'] = $query->result();
       //print_r($data['data']);die;
       $data['total'] = $this->db->count_all("products");


       echo json_encode($data);
   }


   /**
    * Store Data from this method.
    *
    * @return Response
   */
   public function store()
   {

       // print_r($_POST);die;
        if(isset($_FILES["photo"]["name"]))  
        {  
            $config['upload_path'] = './upload/';  
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  
            $this->load->library('upload', $config);  
            if(!$this->upload->do_upload('photo'))  
            {  
                 echo $this->upload->display_errors();  
            }  
            else  
            {  
                 $imgData = $this->upload->data();  
                 //echo '<img src="'.base_url().'upload/'.$data["file_name"].'" width="300" height="225" class="img-thumbnail" />';  
            }  
        }
            $data = array(              
                'department_id' => $this->input->post('department_id'), 
                'name'          => $this->input->post('name'), 
                'dob'           => $this->input->post('dob'), 
                'phone'         => $this->input->post('phone'), 
                'photo'         => $imgData["file_name"], 
                'email'         => $this->input->post('email'), 
                'salary'        => $this->input->post('salary'), 
                'status'        => $this->input->post('status'), 
                'created'       => date("Y-m-d H:i:s")
            );
       //$insert = $this->input->post();
       $this->db->insert('employee', $data);
       $id = $this->db->insert_id();
       $q = $this->db->get_where('employee', array('id' => $id));


       echo json_encode($q->row());
    }


   /**
    * Edit Data from this method.
    *
    * @return Response
   */
   public function edit($id)
   {
       $q = $this->db->get_where('employee', array('id' => $id));

       $row = $q->row();
       // print_r($row);
       $originalDate = "2010-03-21";
        $newDate = date("Y-m-d", strtotime($row->dob));
        $row->dob = $newDate; 

        // print_r($row);
       echo json_encode($row);
   }


   /**
    * Update Data from this method.
    *
    * @return Response
   */
   public function update($id)
   {
    if(isset($_FILES["photo"]["name"]))  
    {  
        $config['upload_path'] = './upload/';  
        $config['allowed_types'] = 'jpg|jpeg|png|gif';  
        $this->load->library('upload', $config);  
        if(!$this->upload->do_upload('photo'))  
        {  
             echo $this->upload->display_errors();  
        }  
        else  
        {  
             $imgData = $this->upload->data();  
             //echo '<img src="'.base_url().'upload/'.$data["file_name"].'" width="300" height="225" class="img-thumbnail" />';  
        }  
    }
    else{
        $imgData["file_name"] = $this->input->post('old_photo');
    }
        $data = array(              
            'department_id' => $this->input->post('department_id'), 
            'name'          => $this->input->post('name'), 
            'dob'           => $this->input->post('dob'), 
            'phone'         => $this->input->post('phone'), 
            'photo'         => $imgData["file_name"], 
            'email'         => $this->input->post('email'), 
            'salary'        => $this->input->post('salary'), 
            'status'        => $this->input->post('status'), 
            'modified'       => date("Y-m-d H:i:s")
        );

       //$insert = $this->input->post();
       $this->db->where('id', $id);
       $this->db->update('employee', $data);
       $q = $this->db->get_where('employee', array('id' => $id));


       echo json_encode($data);
    }


   /**
    * Delete Data from this method.
    *
    * @return Response
   */
   public function delete($id)
   {


       $this->db->where('id', $id);
       $this->db->delete('employee');


       echo json_encode(['success'=>true]);
    }


}