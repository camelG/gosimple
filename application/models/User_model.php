<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $table = 'user';

    public function get($where = [], $start = 0, $limit = 50, $all = null)
    {
        $this->db->from($this->table);

        if (!empty($where)) {
            $this->db->where($where);
        }

        if (empty($all)) {
            $this->db->where('del_flg', 0);
        }

        $this->db->limit($limit, $start);

        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }

    public function getOne($where = [], $select = null)
    {
        $this->db->select($select)->where('del_flg', 0);

        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($this->table);

        return $query->row();
    }

    public function updateOne($where = [], $data = [])
    {
        $this->db->where($where);

        return $this->db->update($this->table, $data);
    }

    public function updateBatch($where = [], $data = [])
    {
        $this->db->where($where);

        return $this->db->update_batch($this->table, $data);
    }

    public function insert($data = [])
    {
        $id = null;
        if ($this->db->insert($this->table, $data)) {
            $id = $this->db->insert_id();
        }

        return $id;
    }

    public function delete($where = [], $data = [])
    {
        return $this->updateOne($where, $data);
    }
}
