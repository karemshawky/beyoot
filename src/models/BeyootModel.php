<?php
namespace Models;

class BeyootModel extends MainModel
{
    /**
     * To make new object from database
     *
     * @var string 
     */
    protected $dbt;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

                                                                    //****** Back - End  ******//

    /**
    * Admin login.
    * @return  void
    */  
    public function admin_login($name=null,$pass=null) 
    {
        if( $name && $pass ){

            $this->db->where('name',$name);
            $this->db->where('pass',$pass);
            return $this->db->getOne('admin');
        }
        return false;
    }

    /**
     * Retrive array data, can make pagination   
     *
     * @param mixed $table
     * @param mixed $where
     * @param array $select
     * @param int   $page
     * @param int   $limit
     * @param int   $orderBy
     * @return array|void
     */
    public function pagination($table = null, array $where = [], array $select = [], $page = null,$limit = null, array $orderBy = [])
    {
        if ($table) {
            if ($where){
                foreach ($where as $key=>$value) {
                    $this->db->where($key, $value);
                }
            }            
            if($orderBy){
                $this->db->orderBy($orderBy[0],$orderBy[1]);
            }
            $this->db->pageLimit = $limit;
            return $this->db->arraybuilder()->paginate($table, $page, $select);
        }
        return false;
    }

    /**
     * Search for housing with condition   
     *
     * @param int  $city
     * @param int  $type
     * @param int  $price_from
     * @param int  $price_to
     * @param int  $page
     * @param int  $limit
     * @return array|void
     */
    public function search($city = null,$type = null,$price_from = null,$price_to = null,$page = null,$limit = null)
    {
        if ($price_from && $price_to) 
        {
            if ($city != 0) {
                $this->db->where('city_id', $city);
            }
            if ($type != 0) {
                $this->db->where('type_id', $type);
            }
            $this->db->where('price', $price_from, '>=');
            $this->db->where('price', $price_to, '<=');
            $this->db->where('is_active', 1);
            $this->db->orderBy('created_date','desc');

            $this->db->pageLimit = $limit;
            return $this->db->arraybuilder()->paginate('housing', $page, ['id', 'title', 'price','lat','lang', 'type_id', 'address', 'pic']);
        }
        return false;
    }

   /**
    * Get all table data in array with conditions of operators like:
    * [ BETWEEN / NOT BETWEEN - IN / NOT IN - LIKE ]
    *
    * @param   string  $table 
    * @param   array   $whereKAndO
    * @param   array   $select
    * @param   array   $orderBy
    * @return  mixed
    */   
    public function get_whereOperator($table = null,array $whereKAndO = [],array $whereValue = [],array $select = [], $page = null, $limit = null,array $orderBy = [])
    {
        // $table         e.g. ('users')
        // $whereKAndO    e.g. ['id','IN']  // where key and operator
        // $whereValue    e.g. [ 1, 2, 3]
        // $operator      e.g. ['IN']
        // $select        e.g. ['id', 'title', 'details']
        // $orderBy       e.g. ['id', 'desc']

        if ($table) {
            if ($whereKAndO && $whereValue) {
                $this->db->where($whereKAndO[0], $whereValue, $whereKAndO[1]);
            }
            if ($orderBy) {
                $this->db->orderBy($orderBy[0],$orderBy[1]);
            }            
            $this->db->pageLimit = $limit;
            return $this->db->arraybuilder()->paginate($table, $page, $select);
        }
        return false;
    }

    /**
     * MySQL aggregate function COUNT with condition
     * @param string $tableName
     * @param string $fieldName
     */
    public function count_where($tableName, $fieldName, $where) 
    {
        if ($where){
            foreach ($where as $key=>$value) {
                $this->db->where($key, $value);
            }
        }
        $res = $this->db->getOne($tableName, "COUNT({$fieldName}) as cccount");
        return $res['cccount'];
    }   

   /**
    * Get all housing with images and housing type.
    * @return  array
    */   
    public function get_housing($limit=null)
    {
        $this->db->join("cities c", "h.city_id = c.id", "LEFT");            
        $this->db->join("housing_types t", "h.type_id = t.id", "LEFT");            
        $this->db->orderBy('created_date','desc');
        return $this->db->get('housing h', $limit, ['h.*', 'c.name as cty' , 't.name as tpy']);
    }

    /**
    * Get all housing additions by house id.
    * @return  array
    */   
    public function get_housing_additions($id=null)
    {
        $this->db->where('housing_id', $id);
        $this->db->join("housing_additions_type t", "h.type = t.id", "LEFT");
        $this->db->orderBy('type_id','desc');            
        return $this->db->get('housing_additions h', null, ['h.value', 'h.type_id', 'h.type', 't.type as tpy']);
    }

    /**
    * Insert new house with additions.
    * @return  void
    */  
    public function insert_housing($save=null,$additions=null) 
    {
        $this->db->startTransaction();
        $row = $this->db->insert('housing', $save);
        $this->insert_additions($additions,$row);
        if (!$row) {
            $this->db->rollback();
        } else {
            $this->db->commit();
        }
    }

    /**
    * Insert additions to house with additions.
    * @return  void
    */  
    public function insert_additions($additions=null,$id=null) 
    {
        foreach ( $additions as $type => $value ) 
        {
            $this->db->insert('housing_additions',[ 'housing_id'=> $id, 'type'=> $type, 'value'=> ($value) ? $value : 0, 
                                                    'type_id'=> $this->db->where('id',$type)->getValue('housing_additions_type', 'type_id') , 
                                                  ]);
        }
    }

                                                            //****** Front - End  ******//
   /**
    * Get all housing with images and housing type with paginate.
    * @return  array
    */   
    public function housing_paginate($limit=9,$page=1)
    {
        $this->db->join("cities c", "h.city_id = c.id", "LEFT");            
        $this->db->join("housing_types t", "h.type_id = t.id", "LEFT");            
        $this->db->orderBy('created_date','desc');

        $this->db->pageLimit = $limit;
        return $this->db->arraybuilder()->paginate('housing h', $page, ['h.*', 'c.name as cty' , 't.name as tpy']);
    }

 
    public function get_favfront($table = null, $id = null,array $whereKAndO = [],array $whereValue = [],array $select = [],array $orderBy = [])
    {
        // $table         e.g. ('users')
        // $whereKAndO    e.g. ['id','IN']  // where key and operator
        // $whereValue    e.g. [ 1, 2, 3]
        // $operator      e.g. ['IN']
        // $select        e.g. ['id', 'title', 'details']
        // $orderBy       e.g. ['id', 'desc']

        if ($table) {
            if ($id) {
                $this->db->where('type_id', $id);
            }
            if ($whereKAndO && $whereValue) {
                $this->db->where($whereKAndO[0], $whereValue, $whereKAndO[1]);
            }
            if ($orderBy) {
                $this->db->orderBy($orderBy[0],$orderBy[1]);
            }            
            return $this->db->get($table, null, $select);
        }
        return false;
    }
}