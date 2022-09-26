<?php

require_once 'config.php';
require_once 'helpers.php';

class Database
{
    public mysqli|string $mysqli = '';
    public $result;
    private string $sql;
    private string $host = DB_HOST;
    private string $dbname = DB_NAME;
    private string $username = DB_USER;
    private string $password = DB_PASS;

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

    public function insert($table, $param = array()): void
    {
        $args = array();
        $table_columns = implode(', ', array_keys($param));

        foreach ($param as $value) {
            $args[] = ($value == '' ? "NULL" : "'$value'");
        }

        $table_value = implode(', ', $args);
        $sql = "INSERT INTO $table ($table_columns) VALUES($table_value)";

        $this->result = $this->mysqli->query($sql);
    }

    public function update($table, $param = array(), $id): void
    {
        $args = array();
        foreach ($param as $key => $value) {
            $args[] = $key . '=' . ($value == '' ? "NULL" : "'$value'");
        }

        $sql = "UPDATE $table SET " . implode(', ', $args);
        $sql .= " WHERE $id";

        $this->result = $this->mysqli->query($sql);
    }

    public function delete($table, $id): void
    {
        $sql = "DELETE FROM $table";
        $sql .= " WHERE $id ";
        $sql;

        $this->result = $this->mysqli->query($sql);
    }

    public function select($table, $rows = "*", $where = null): void
    {
        if ($where != null) {
            $sql = "SELECT $rows FROM $table WHERE $where";
        } else {
            $sql = "SELECT $rows FROM $table";
        }

        $this->result = $this->mysqli->query($sql);
    }

    public function select_custom($table, $rows = "*", $query = null): void
    {
        if ($query != null) {
            $sql = "SELECT $rows FROM $table $query";
        } else {
            $sql = "SELECT $rows FROM $table";
        }
//        echo $sql;
        $this->result = $this->mysqli->query($sql);
    }

    public function __destruct()
    {
        $this->mysqli->close();
    }
}