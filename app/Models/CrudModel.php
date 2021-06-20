<?php

namespace App\Models;

use CodeIgniter\Model;

class CrudModel extends Model
{
    protected $table = "user";

    // Cek id
    public function cek_id($table, $field, $where = false)
    {
        $db = \Config\Database::connect();
        // $builder = $this->builder();
        $builder = $db->table($table);
        $builder->select('*');
        if ($where) { // jika where memiliki nilai array
            $builder->where($where);
        }
        $builder->orderBy($field, "DESC");
        $builder->limit(1);
        $query = $builder->get();
        $cek = $query->getRow();
        if (empty($cek)) {
            return "1";
        } else {
            $data = $cek->$field + 1;
            return $data;
        }
    }

    // ======== ********************************************************************** ==============

    // select
    public function select_data($table, $return = "getResult", $where = false, $like = null, $order = null, $limit = false, $group = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->select('*');
        if ($where) { // jika where memiliki nilai array
            $builder->where($where);
        }

        if ($like !== null) { // jika like memiliki nilai array
            foreach ($like as $like => $like_by) {
                $builder->like($like, $like_by);
            }
        }

        if ($order !== null) { // jika order memiliki nilai
            foreach ($order as $order => $order_by) {
                $builder->orderBy($order, $order_by);
            }
        }

        if ($limit) { // jika limit memiliki nilai
            $builder->limit($limit);
        }

        if ($group !== null) { // jika group memiliki nilai
            foreach ($group as $group) {
                $builder->groupBy($group);
            }
        }
        $query = $builder->get();
        return $query->$return();
    }

    // select
    public function select_data_count($table, $return = "getResult", $where = false, $like = null, $order = null, $limit = false, $group = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->select('count(*) as count');
        if ($where) { // jika where memiliki nilai array
            $builder->where($where);
        }

        if ($like !== null) { // jika like memiliki nilai array
            foreach ($like as $like => $like_by) {
                $builder->like($like, $like_by);
            }
        }

        if ($order !== null) { // jika order memiliki nilai
            foreach ($order as $order => $order_by) {
                $builder->orderBy($order, $order_by);
            }
        }

        if ($limit) { // jika limit memiliki nilai
            $builder->limit($limit);
        }

        if ($group !== null) { // jika group memiliki nilai
            foreach ($group as $group) {
                $builder->groupBy($group);
            }
        }
        $query = $builder->get();
        return $query->$return();
    }

    // select join
    public function select_data_join($select = "*", $table, $return = "getResult", $join = null, $where = false, $like = null, $order = null, $group = null, $limit = false)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->select($select);
        if ($join !== null) { // jika join memiliki nilai array
            foreach ($join as $jo) {
                $builder->join($jo["table"], $jo["cond"], $jo["type"]);
            }
        }

        if ($where) { // jika where memiliki nilai array
            $builder->where($where);
        }

        if ($like !== null) { // jika like memiliki nilai array
            foreach ($like as $like => $like_by) {
                $builder->like($like, $like_by);
            }
        }

        if ($order !== null) { // jika order memiliki nilai
            foreach ($order as $order => $order_by) {
                $builder->orderBy($order, $order_by);
            }
        }

        if ($limit) { // jika limit memiliki nilai
            $builder->limit($limit);
        }

        if ($group !== null) { // jika group memiliki nilai
            foreach ($group as $group) {
                $builder->groupBy($group);
            }
        }
        $query = $builder->get();
        return $query->$return();
    }

    // select custom query
    public function select_custom($query, $return = "getResult")
    {
        $db = \Config\Database::connect();
        $query = $db->query($query);
        return $query->$return();
    }

    // select max
    public function select_function($function, $table, $field, $where = false)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->$function($field);
        if ($where) { // jika where memiliki nilai array
            $builder->where($where);
        }
        $query = $builder->get();
        return $query->getRow();
    }

    public function insert_data($table, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $q = $builder->insert($data);
        // $q    =    $this->insert($table, $data);
        if ($q) {
            return true;
        } else {
            return false;
        }
    }

    public function update_data($table, $data, $where)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->where($where);
        $q = $builder->update($data);
        if ($q) {
            return true;
        } else {
            return false;
        }
    }

    // hapus id
    public function hapus_data($table, $where)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($table);
        $builder->where($where);
        $del = $builder->delete();
        if ($del) {
            return true;
        } else {
            return false;
        }
    }
}
