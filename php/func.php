<?php
require 'php/connect.php';

function add_salon ($object, $db_name)
{
    $connect = connect();
    $row = 'NULL,';
    foreach ($object as $name => $value)
        $row .= ":$name,";
    $row = substr($row, 0, -1);

    $query = "INSERT INTO $db_name VALUES ($row)";
    $connect->prepare($query)->execute($object);
    $last_id = $connect->lastInsertId();
    $connect = null;
    return $last_id;
}

function add_car ($object, $db_name, $id_salon)
{
    $connect = connect();

    $query = "SELECT * FROM salon WHERE id_salon=$id_salon";
    var_dump($query);
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $check = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$check)
        return -1;

    $row = 'NULL,';
    foreach ($object as $name => $value)
        $row .= ":$name,";
    $row = substr($row, 0, -1);

    $query = "INSERT INTO $db_name VALUES ($row)";
    $rez1 = $connect->prepare($query)->execute($object);
    $id_car = $connect->lastInsertId();

    $query = "INSERT INTO relation (id_salon, id_car) VALUES ($id_salon, $id_car)";
    $rez2 = $connect->prepare($query)->execute();
    $connect = null;
    if (!$rez1 or !$rez2)
        return -1;
    return 1;
}


function save($object, $db_name, $id)
{
    $connect = connect();

    $row = '';
    foreach ($object as $key => $value)
        $row .= "$key=:$key, ";
    $row = substr($row, 0, -2);

    $query = "UPDATE $db_name SET $row WHERE id_$db_name=$id";
    $connect->prepare($query)->execute($object);
    $connect = null;
}

function delete_car($id)
{
    $id = htmlspecialchars($id);
    $connect = connect();

    $query = "DELETE FROM car WHERE id_car=$id";
    $rez1 = $connect->prepare($query)->execute();

    $query = "DELETE FROM relation WHERE id_car=$id";
    $rez2 = $connect->prepare($query)->execute();

    $connect = null;
    if (!$rez1 or !$rez2)
        return -1;
    return 1;
}

function delete_salon($id)
{
    $id = htmlspecialchars($id);
    $connect = connect();

    $query = "SELECT * FROM relation WHERE id_salon=$id";
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $check = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$check)
    {
        $query = "DELETE FROM salon WHERE id_salon=$id";
        $connect->prepare($query)->execute();
        $connect = null;
        return 1;
    }

    if ($check)
    {
        $connect = null;
        return -1;
    }

    $connect = null;
    return -1;
}

function table ($db_name)
{
    $data = array();
    $connect = connect ();
    foreach ($connect->query("SELECT * FROM $db_name") as $row)
        $data[$row["id_$db_name"]] = $row;
    $connect = null;
    return $data;
}

function table_for_cars ($id_salon)
{
    $connect = connect();
    $query = "SELECT * FROM relation WHERE id_salon=$id_salon";
    foreach ($connect->query($query) as $row)
    {
        $query2 = "SELECT * FROM car WHERE id_car=$row[2]";
        foreach ($connect->query($query2) as $row2)
            $data[$row2[0]] = $row2;
    }
    $connect = null;
    if (isset($data))
        return $data;
}

function row($db_name, $id)
{
    $connect = connect();
    $query = "SELECT * FROM $db_name WHERE id_$db_name=$id";
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $edit = $stmt->fetch(PDO::FETCH_ASSOC);
    $connect = null;
    return $edit;
}

function salon_array($POST)
{
    $salon = array();
    $salon['mark']   = htmlspecialchars($POST['mark']);
    $salon['number'] = htmlspecialchars($POST['tel']);
    $salon['email']  = htmlspecialchars($POST['email']);
    return $salon;
}

function car_array($POST, $mark)
{
    $car = array();
    $car['mark']            = $mark;
    $car['model']           = htmlspecialchars($POST['model']);
    $car['production_year'] = htmlspecialchars($POST['year']);
    $car['cost']            = htmlspecialchars($POST['cost']);
    $car['mileage']         = htmlspecialchars($POST['mileage']);
    return $car;
}

function id_salon($mark)
{
    $connect = connect();
    $query = "SELECT * FROM salon WHERE mark = '$mark'";
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $edit = $stmt->fetch(PDO::FETCH_ASSOC);
    $connect = null;
    return $edit["id_salon"];
}

function edit_check ($id, $db_name)
{
    $connect = connect ();
    foreach ($connect->query("SELECT * FROM $db_name") as $row)
        if ($row["id_$db_name"] == $id)
            return 1;
    return -1;
}
