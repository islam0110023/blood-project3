<?php
interface DbContract
{
    public function insert($data);
    public function select($columns = "*");
    public function update($data);
    public function delete();
    public function excute();
    public function show();
    public function get();
    public function where($column, $operator = null, $value = null);
    public function andwhere($column, $operator = null, $value = null);
    public function orwhere($column, $operator = null, $value = null);
    public function join($table, $firstColumn, $operator, $secondColumn);
    public function beginTransaction();
    public function commit();
    public function rollback();

}
class db implements DbContract
{
    private static $instance = null;
    private $table;
    private $sql;
    private $connect;
    private $params = [];


    private function __construct($host, $user, $passwd, $db, $table)
    {
        $this->connect = mysqli_connect($host, $user, $passwd, $db);
        if (mysqli_connect_errno()) {
            die(" ");
        }
        $this->table = $table;
    }
    public static function getInstance($host, $user, $passwd, $db, $table)
    {
        if (self::$instance === null) {
            self::$instance = new db($host, $user, $passwd, $db, $table);
        }
        return self::$instance;
    }
    public function getConnection()
    {
        return $this->connect;
    }

    public function setTable($table)
    {
        $this->table = $table;
    }


    /* ok */
    public function delete()
    {
        $this->sql = "DELETE from $this->table";
        return $this;
    }


    public function insert($data)
    {
        $columns = "";
        $placeholders = "";
        //$values = "";
        foreach ($data as $column => $value) {
            $columns .= "`$column`,";
            $placeholders .= "?,";
            $this->params[] = $value;
            //$values .= "'$value',";
        }
        $columns = rtrim($columns, ",");
        $placeholders = rtrim($placeholders, ",");
        $this->sql = "INSERT into $this->table ($columns) values ($placeholders)";
        return $this;

    }


    /* ok */
    public function select($columns = '*')
    {
        $this->sql = "SELECT $columns from $this->table ";
        return $this;
    }

    public function update($data)
    {
        $rows = "";
        foreach ($data as $column => $value) {
            $rows .= " `$column` = ? ,";
            $this->params[] = $value;
        }
        $rows = rtrim($rows, ",");

        $this->sql = "UPDATE $this->table set $rows ";
        return $this;
    }

    public function excute()
    {
        // $query = mysqli_query($this->connect, $this->sql);
        $stmt = mysqli_prepare($this->connect, $this->sql);
        if (!empty($this->params)) {
            $type = str_repeat('s', count($this->params));
            $stmt->bind_param($type, ...$this->params);
        }

        $stmt->execute();
        $rows = $stmt->affected_rows;

        $this->sql = "";
        $this->params = [];

        return $rows;
    }

    public function show()
    {
        // $query = mysqli_query($this->connect, $this->sql);
        $stmt = mysqli_prepare($this->connect, $this->sql);

        if (!empty($this->params)) {
            $types = '';
            foreach ($this->params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } else {
                    $types .= 's';
                }
            }
            // $types = str_repeat('s', count($this->params));
            $stmt->bind_param($types, ...$this->params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $this->sql = "";
        $this->params = [];

        return $data;
    }
    public function get()
    {
        // $query = mysqli_query($this->connect, $this->sql);
        $stmt = mysqli_prepare($this->connect, $this->sql);
        if (!empty($this->params)) {
            $types = str_repeat('s', count($this->params));
            $stmt->bind_param($types, ...$this->params);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        $data = mysqli_fetch_assoc($result);
        $this->sql = "";
        $this->params = [];

        return $data;
    }
    public function where($column, $operator = "=", $value = null)
    {
        $this->sql .= " WHERE $column $operator ?";
        $this->params[] = $value;
        return $this;
    }
    public function andwhere($column, $operator = null, $value = null)
    {
        $this->sql .= " AND $column $operator ?";
        $this->params[] = $value;
        return $this;
    }
    public function orwhere($column, $operator = null, $value = null)
    {
        $this->sql .= " OR $column $operator ?";
        $this->params[] = $value;
        return $this;
    }
    public function join($table, $firstColumn, $operator, $secondColumn)
    {

        $this->sql .= " JOIN $table ON $firstColumn $operator $secondColumn";
        return $this;
    }
    public function beginTransaction()
    {
        $this->connect->begin_transaction();
    }

    public function commit()
    {
        $this->connect->commit();
    }

    public function rollback()
    {
        $this->connect->rollback();
    }

}