<?php

class Database
{
    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $result = array();
    public $mysqli = '';

    public function __construct()
    {
        date_default_timezone_set('Asia/Makassar');

        $sekarang = new DateTime();
        $menit = $sekarang->getOffset() / 60;

        $tanda = ($menit < 0 ? -1 : 1);
        $menit = abs($menit);
        $jam = floor($menit / 60);
        $menit -= $jam * 60;

        $offset = sprintf('%+d:%02d', $tanda * $jam, $menit);

        $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        $this->mysqli->query("SET time_zone = '$offset'");
    }

    public function insert($table, $param = array())
    {
        $args = array();
        $table_columns = implode(', ', array_keys($param));

        foreach ($param as $value) {
            $args[] = ($value == '' ? "NULL" : "'$value'");
        }

        $table_value = implode(', ', mysqli_real_escape_string($this->mysqli, $args));
        $sql = "INSERT INTO $table ($table_columns) VALUES($table_value)";

        $this->result = $this->mysqli->query($sql);
    }

    public function update($table, $param = array(), $id)
    {
        $args = array();
        foreach ($param as $key => $value) {
            $args[] = $key . '=' . ($value == '' ? "NULL" : "'$value'");
        }

        $sql = "UPDATE $table SET " . implode(', ', mysqli_real_escape_string($this->mysqli, $args));
        $sql .= " WHERE $id";

        $this->result = $this->mysqli->query($sql);
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table";
        $sql .= " WHERE $id ";
        $sql;

        $this->result = $this->mysqli->query($sql);
    }

    public $sql;
    public function select($table, $rows = "*", $where = null)
    {
        if ($where != null) {
            $sql = "SELECT $rows FROM $table WHERE $where";
        } else {
            $sql = "SELECT $rows FROM $table";
        }

        $this->sql = $this->result = $this->mysqli->query($sql);
    }

    public function select_custom($table, $rows = "*", $query = null)
    {
        if ($query != null) {
            $sql = "SELECT $rows FROM $table $query";
        } else {
            $sql = "SELECT $rows FROM $table";
        }

        $this->sql = $this->result = $this->mysqli->query($sql);
    }

    public function __destruct()
    {
        $this->mysqli->close();
    }
}