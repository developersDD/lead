<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Base_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * [customSelectQuery common function for custom select query]
     * @param  string  $select   [select string]
     * @param  string  $from     [from table]
     * @param  string  $where    [where condition string]
     * @param  integer $records  [1-single record, 2-multiple record]
     * @param  string  $join     [join string]
     * @param  string  $groupby  [group by string]
     * @param  string  $ordercol [order column name]
     * @param  string  $orderby  [order by ASC/DESC]
     * @param  string  $limitto  [record limit to]
     * @return object            [result array]
     */
    public function customSelectQuery($select='*', $from='', $where='', $records=2, $join='', $groupby='', $ordercol = 'id', $orderby='DESC', $limitto=''){

        if($join!=''){
            $join = 'JOIN '.$join;
        }
        if($groupby!=''){
            $groupby = 'GROUP BY '.$groupby;
        }
        
        if($limitto!=''){
            $limitto = 'LIMIT '.$limitto;
        }


        if($records<2){
            $result = $this->db->query("SELECT {$select} FROM {$from} {$join} WHERE {$where} {$groupby} ORDER BY {$ordercol} {$orderby} {$limitto}")->row();
        }else{
            $result = $this->db->query("SELECT {$select} FROM {$from} {$join} WHERE {$where} {$groupby} ORDER BY {$ordercol} {$orderby} {$limitto}")->result();
        }

        return $result;
    }

    /**
     * [saveCommon common function to save data]
     * @param  string $table      [table name to save data in]
     * @param  array  $insertData [insert data array]
     * @return [boolean or integer]             [false on failure or last insert id on success]
     */
    public function saveCommon($table="", $insertData = array()){
        $result = $this->db->insert($table, $insertData);
        if($result){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }


    /**
     * [updateCommon common function to update record]
     * @param  string $table      [table name to update record]
     * @param  array  $updateData [update data array]
     * @param  array  $whereData  [where condition in array]
     * @return [boolean]             [true]
     */
    public function updateCommon($table = "", $updateData = array(), $whereData = array()){
        $this->db->where($whereData);
        $this->db->update($table, $updateData); 
        return true;
    }
    
    /**
     * [getCommon common function to get records]
     * @param  string  $table        [table name to fetch records from]
     * @param  array   $where        [where condition array]
     * @param  string  $selectVal    [select string]
     * @param  integer $records      [1-single record, 2-multiple record]
     * @param  [string]  $orderbyColum [order column name]
     * @param  string  $byto         [order by DESC/ASC]
     * @param  [integer]  $limit        [record limit]
     * @return [object]                [result object]
     */
    public function getCommon($table = '', $where = array(), $selectVal = '*', $records = 1, $orderbyColum = 'id', $byto = 'DESC', $limit = null){
        $this->db->select($selectVal);
        $this->db->from($table);
        
        if($where){ 
            $this->db->where($where);
        }
        if($orderbyColum){ 
            $this->db->order_by($orderbyColum, $byto);  
        }
        if($limit){
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            if($records == 1){
                return $query->row();
            }else{
                return $query->result();
            }
        } else {
            return FALSE;
        }
    }

  }//end class