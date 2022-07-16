<?php

require("connect.php");


//dumping funcion
function dd($value)
{
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}


// DBから全レコードを取り出す関数
function selectAll($table, $conditions = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";

    //もしconditionsがなければ全データを取得する。
    if (empty($conditions)) {
        $records = $pdo->query($sql)->fetchObject();
        return $records;
    } else {
        // return records that match conditions...
        // $sql = "SELECT * FROM $table WHERE username='shincode' AND admin=1";

        $i = 0;
        foreach ($conditions as $key => $value) {
            // echo $key;
            // echo $value;
            if ($i === 0) {
                // $sql = $sql . " WHERE $key=$value";
                $sql = $sql . " WHERE $key=?";
                // echo $sql;
            } else {
                // $sql = $sql . " AND $key=$value";
                $sql = $sql . " AND $key=?";
                // echo $sql;
            }
            // echo $i;
            $i++;
        }
        // dd($sql);
        $records = $pdo->query($sql)->fetchObject();
        return $records;
    }
}

$conditions = [
    "admin" => 1,
    "username" => "shincode"
];


$users = selectAll("users", $conditions);
dd($users);
