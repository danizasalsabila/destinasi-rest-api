<?php

class Destinasi_model extends CI_Model{

    public function getDestinasi($id = null){
        if($id === null){
         return $this->db->get('destinasi_sort_comma')->result_array();
        } else {
         return $this->db->get_where('destinasi_sort_comma', ['place_id' => $id])->result_array();
        }
    }

    public function deleteDestinasi($id){ 
        $this->db->delete('destinasi_sort_comma', ['place_id' => $id]);
        return $this->db->affected_rows();
    }

    public function postDestinasi($data){
        $this->db->insert('destinasi_sort_comma', $data);
        return $this->db->affected_rows();
    }

    public function putDestinasi($data, $id){
        $this->db->update('destinasi_sort_comma',  $data, ['place_id' => $id]);
        return $this->db->affected_rows();
    }
} 