<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Destinasi extends REST_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('Destinasi_model', 'destinasi');

        // -6- limit apikey
        $this->methods['index_get']['limit'] = 50;
        $this->methods['index_delete']['limit'] = 20;
        $this->methods['index_post']['limit'] = 20;
        $this->methods['index_put']['limit'] = 20;
        // -6-
    }


    //-1- METHOD GET DATA
    public function index_get(){
        // -2- check if api have id or not 
       $id =  $this->get('id');
       if($id === null) {
        $destinasi = $this->destinasi->getDestinasi();
       } else {
        $destinasi = $this->destinasi->getDestinasi($id);
       }
        // -2-
        // var_dump($destinasi);

        if($destinasi){
            $this->response([
                'status' => true,
                'message' => 'Get data success',
                'data' => $destinasi,
            ], REST_Controller::HTTP_OK); 
        } else {
            $this->response([
                'status' => false,
                'message' => '(Get) data not found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }
    //-1-


        //-3- METHOD DELETE DATA
        public function index_delete(){
           $id = $this->delete('id');
    
            if($id ===  null){
                $this->response([
                    'status' => false,
                    'message' => 'provide an id'
                ], REST_Controller::HTTP_BAD_REQUEST); 
            } else {
                if($this->destinasi->deleteDestinasi($id) > 0 ){
                    $this->response([
                        'status' => true,
                        'id' => $id,
                        'message' => 'Success delete data',
                    ], REST_Controller::HTTP_OK); 
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Failed delete data not found',
                    ], REST_Controller::HTTP_BAD_REQUEST); 
                }
            }
        }
        // -3-


        //-4- METHOD POST DATA
        public function index_post(){
            $data = [
                'Place_Name' => $this->post('Place_Name'),
                'Description' => $this->post('Description'),
                'Category' => $this->post('Category'),
                'City' => $this->post('City'),
                'Price' => $this->post('Price'),
                'Rating' => $this->post('Rating'),
                'Time_Minutes' => $this->post('Time_Minutes'),
                'Lat' => $this->post('Lat'),
                'Long' => $this->post('Long'),
                '_1' => $this->post('_1'),
                'Rating_Count' => $this->post('Rating_Count'),
                'url' => $this->post('url'),
            ];

            if($this->destinasi->postDestinasi($data) > 0 ) {
                $this->response([
                    'status' => true,
                    'message' => 'Success post data',
                ], REST_Controller::HTTP_CREATED); 
            }  else{
                $this->response([
                'status' => false,
                'message' => 'failed post new data'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
         }
        // -4-

        //-5- METHOD PUT DATA
        public function index_put(){
            $id =  $this->put('id');

            $data = [
                'Place_Name' => $this->put('Place_Name'),
                'Description' => $this->put('Description'),
                'Category' => $this->put('Category'),
                'City' => $this->put('City'),
                'Price' => $this->put('Price'),
                'Rating' => $this->put('Rating'),
                'Time_Minutes' => $this->put('Time_Minutes'),
                'Lat' => $this->put('Lat'),
                'Long' => $this->put('Long'),
                '_1' => $this->put('_1'),
                'Rating_Count' => $this->put('Rating_Count'),
                'url' => $this->put('url'),
            ];

            if ($this->destinasi->putDestinasi($data, $id) > 0 ) {
                $this->response([
                    'status' => true,
                    'message' => 'Success update data',
                ], REST_Controller::HTTP_OK); 
            }  else {
                $this->response([
                'status' => false,
                'message' => 'failed update data'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
        }

}