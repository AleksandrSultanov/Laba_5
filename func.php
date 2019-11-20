<?php
require 'connect.php';

function add ($object, $db_name)
{
    $row = 'NULL,';
    foreach ($object as $name => $value)
    {
        $row .= ':';
        $row .= $name;
        $row .= ',';
    }
    $row = substr($row, 0, -1);

    try
    {
        $connect = connect ();
        $query = 'INSERT INTO '.$db_name.' VALUES ('.$row .')';
        $salons = $connect->prepare($query);
        $salons->execute($object);
    }
    catch (PDOException $e)
    {
        print "Error! : " . $e->getMessage() . "<br/>";
        die();
    }
}

function show ($db_name, $size)
{
    $count = 0;
    try {
        $connect = connect ();
        echo '<table class="table">';

        foreach ($connect->query('SELECT * from '.$db_name.' ') as $row)
        {
            echo '<tr scope="row">';
            echo '<td>' . ++$count . '</td>';
            for ($i = 1; $i < $size; $i++)
                if (isset($row[$i]))
                echo '<td>' . $row[$i] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        $connect = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}