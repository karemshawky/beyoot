<?php

namespace Models;

class MainModel
{
    public $db;

    public function __construct()
    {
        $this->db = new \MysqliDb('localhost', 'root', '', 'beyoot');
    }

    /**
      * Get all table data in array with conditions.
      *
      * @param   string  $table
      * @param   array   $where
      * @param   array   $select
      * @param   array   $orderBy
      * @return  mixed
      */
    public function get_table($table = null, array $where = [], array $select = [], array $orderBy = [], $limit = null)
    {
        // $table           e.g. ('users')
        // $where           e.g. ['id'=> $id, 'title'=> $title]
        // $select          e.g. ('id', 'title', 'details')

        if ($table) {
            if ($where) {
                foreach ($where as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            if ($orderBy) {
                $this->db->orderBy($orderBy[0], $orderBy[1]);
            }
            return $this->db->get($table, $limit, $select);
        }
        return false;
    }

    /**
      * Get one row or specific one coloumn of row with conditions.
      *
      * @param   string  $table
      * @param   array   $where
      * @param   string  $coloumn
      * @return  mixed
      */
    public function get_one($table = null, array $where = [], $coloumn = null)
    {
        // $table      e.g. ('users')
        // $where      e.g. ['id'=> $id, 'title'=> $title]
        // $coloumn    e.g. ('id')

        if ($table) {
            if ($where) {
                foreach ($where as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            if ($coloumn) {
                return $this->db->getValue($table, $coloumn);
            } else {
                return $this->db->getOne($table);
            }
        }
        return false;
    }

    /**
      * Insert data to table, can get the last insert id.
      *
      * @param   string  $table
      * @param   array   $data
      * @param   string  $lastInsertId
      * @return  mixed
      */
    public function insert_this($table = null, array $data = null, $lastInsertId = null)
    {
        // $table           e.g. ('users')
        // $data            e.g. ['id'=> $id, 'title'=> $title]
        // $lastInsertId    e.g. ('id')

        if ($table) {
            if ($data) {
                $id = $this->db->insert($table, $data);
                if ($lastInsertId == 'id') {
                    return $id;
                } elseif (!$id) {
                    echo 'insert failed: ' . $this->db->getLastError();
                }
            }
        }
    }

    /**
      * Update data in table with conditions.
      *
      * @param   string  $table
      * @param   array   $set
      * @param   array   $where
      * @return  void
      */
    public function update_this($table = null, array $set = [], array $where = [])
    {
        // $table    e.g. ('users')
        // $set      e.g. ['id'=> $id, 'title'=> $title]
        // $where    e.g. ['id'=> $id, 'title'=> $title]

        if ($table) {
            if ($where) {
                foreach ($where as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $update = $this->db->update($table, $set);
            if (!$update) {
                echo 'update failed: ' . $this->db->getLastError();
            }
        }
    }

    /**
     * Delete data in table with conditions.
     *
     * @param   string  $table
     * @param   array   $set
     * @param   array   $where
     * @return  void
     */
    public function delete_this($table = null, array $where = [])
    {
        // $table    e.g. ('users')
        // $set      e.g. ['id'=> $id, 'title'=> $title]
        // $where    e.g. ['id'=> $id, 'title'=> $title]

        if ($table) {
            if ($where) {
                foreach ($where as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $delete = $this->db->delete($table);
            if (!$delete) {
                echo 'delete failed: ' . $this->db->getLastError();
            }
        }
    }

    /**
     * MySQL aggregate function AVERAGE
     * @param string $tableName
     * @param string $fieldName
     */
    public function average($tableName, $fieldName)
    {
        $res = $this->db->getOne($tableName, "AVG({$fieldName}) as aaavg");
        return $res['aaavg'];
    }

    /**
     * MySQL aggregate function COUNT
     * @param string $tableName
     * @param string $fieldName
     */
    public function count($tableName, $fieldName)
    {
        $res = $this->db->getOne($tableName, "COUNT({$fieldName}) as cccount");
        return $res['cccount'];
    }

    /**
     * MySQL aggregate function DISTINCT
     * @param string $tableName
     * @param string $fieldName
     */
    public function distinct($tableName, $fieldName)
    {
        $res = $this->db->get($tableName, null, "DISTINCT({$fieldName})");
        return $res;
    }

    /**
     * MySQL aggregate function MAX
     * @param string $tableName
     * @param string $fieldName
     */
    public function max($tableName, $fieldName)
    {
        $res = $this->db->getOne($tableName, "MAX({$fieldName}) as mmmax");
        return $res['mmmax'];
    }

    /**
     * MySQL aggregate function MIN
     * @param string $tableName
     * @param string $fieldName
     */
    public function min($tableName, $fieldName)
    {
        $res = $this->db->getOne($tableName, "MIN({$fieldName}) as mmmin");
        return $res['mmmin'];
    }

    /**
     * MySQL aggregate function SUM
     * @param string $tableName
     * @param string $fieldName
     */
    public function sum($tableName, $fieldName)
    {
        $res = $this->db->getOne($tableName, "SUM({$fieldName}) as sssum");
        return $res['sssum'];
    }
}
