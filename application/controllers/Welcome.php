<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function array_sort($array, $on, $order=SORT_ASC){

	    $new_array = array();
	    $sortable_array = array();

	    if (count($array) > 0) {
	        foreach ($array as $k => $v) {
	            if (is_array($v)) {
	                foreach ($v as $k2 => $v2) {
	                    if ($k2 == $on) {
	                        $sortable_array[$k] = $v2;
	                    }
	                }
	            } else {
	                $sortable_array[$k] = $v;
	            }
	        }

	        switch ($order) {
	            case SORT_ASC:
	                asort($sortable_array);
	                break;
	            case SORT_DESC:
	                arsort($sortable_array);
	                break;
	        }

	        foreach ($sortable_array as $k => $v) {
	            $new_array[$k] = $array[$k];
	        }
	    }

	    return $new_array;
	}

	public function compare_str(){
		$this->load->view('compare_str');
	}

	public function changed_str(){
		// echo '<pre>';
		// print_r($_GET);
		$str1 = $_GET['str1'];
		$str2 = $_GET['str2'];
		$arr1 = str_split($str1, 1);
		$arr2 = str_split($str2, 1);

		$data['str1'] = $str1;
	    $data['str2'] = $str2;


		$strnew1 = "";
	    $l1 = count($arr1);
	    $l2 = count($arr2);
	    for ($j = 0; $j < $l1; $j++) {
	        $ch1 = substr($str1, $j, 1);
	        $isMatched = false;
	        for ($p = 0; $p < $l2; $p++) {
	            $ch2 =  substr($str2, $p, 1);
	            if ($ch1 == $ch2) {
	                $isMatched = true;
	                break;
	            }
	        }
	        if(!$isMatched) {
	            $strnew1 .= $ch1;
	        }
	    }
	    // echo $strnew1;
	    // echo "<br>";
	    $strnew2 = "";
	    $str2 = $_GET['str1'];
		$str1 = $_GET['str2'];
		$arr1 = str_split($str1, 1);
		$arr2 = str_split($str2, 1);
	    $l1 = count($arr1);
	    $l2 = count($arr2);
	    for ($j = 0; $j < $l1; $j++) {
	        $ch1 = substr($str1, $j, 1);
	        $isMatched = false;
	        for ($p = 0; $p < $l2; $p++) {
	            $ch2 =  substr($str2, $p, 1);
	            if ($ch1 == $ch2) {
	                $isMatched = true;
	                break;
	            }
	        }
	        if(!$isMatched) {
	            $strnew2 .= $ch1;
	        }
	    }
	    // echo $strnew2;
	    
	    $data['strnew1'] = $strnew1;
	    $data['strnew2'] = $strnew2;
	    $this->load->view('changed_str',$data);
	}
}
