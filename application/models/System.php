<?php
defined('BASEPATH') or exit('No direct script access allowed');

class System extends CI_Model
{

    public function get_system_list()
    {
        return $this->db->get('system')->result_array();
    }

    public function update_entry($data)
    {
        $i = 0;
        $result = [];
        foreach ($data as $key => $value) {
            $this->content = $value;
            $result[$i++] = $this->db->update('system', $this, array('title' => $key));
        }
        return $result;
    }
}
