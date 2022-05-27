<?php
class ProductModel extends CI_Model{
	function productList(){
		$hasil=$this->db->get('products');
		return $hasil->result();
	}

	function department(){
		$hasil=$this->db->get('department');
		return $hasil->result();
	}

	function saveEmp($data){
		
		$result=$this->db->insert('products',$data);
		return $result;
	}

	function updateEmp($id, $data){
		$this->db->where('id', $id);
		$result=$this->db->update('products', $data);
		return $result;	
	}
	function deleteEmp(){
		$id=$this->input->post('id');
		$this->db->where('id', $id);
		$result=$this->db->delete('products');
		return $result;
	}	
}