<?php
     
class User extends CI_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
    }

    public function get_email()
    {
        $url = "https://reqres.in/api/users/1";

        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);

        // Print the return data
        //print_r(json_decode($result, true));
        $res = json_decode($result, true);
        echo $res['data']['email'];
    }

    public function get_all_email()
    {
        $ids = [1,3,10];

        $url = "https://reqres.in/api/users/";

        $ch_index = array(); // store all curl init
        $response = array();

        // create both cURL resources
        foreach ($ids as $key => $id) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,  $url.$id);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $ch_index[] = $ch;
        }

        //create the multiple cURL handle
        $mh = curl_multi_init();

        //add the handles
        foreach ($ch_index as $key => $ch) {
            curl_multi_add_handle($mh,$ch);
        }

        //execute the multi handle
        do {
            $status = curl_multi_exec($mh, $active);
            if ($active) {
                curl_multi_select($mh);
            }
        } while ($active && $status == CURLM_OK);

        //close the handles
        foreach ($ch_index as $key => $ch) {
            curl_multi_remove_handle($mh, $ch);
        }
        curl_multi_close($mh);


        // get all response
        foreach ($ch_index as $key => $ch) {
            $response[] = curl_multi_getcontent($ch);
        }

        foreach ($response as $key => $value) {
            $arr = json_decode($value);
            $emails[] = $arr->data->email;
        }

        foreach ($emails as $key => $email) {
            echo $email."\r\n";
        }
    }
    	
}