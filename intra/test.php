<?php

function html_table($data = array())
{
    $rows = array();
    foreach ($data as $row) {
        $cells = array();
        foreach ($row as $cell) {
            $cells[] = "<td>{$cell}</td>";
        }
        $rows[] = "<tr>" . implode('', $cells) . "</tr>";
    }
    return "<table class='hci-table'>" . implode('', $rows) . "</table>";
}

$data = array(
    array('1' => '1', '2' => '2'),
    array('1' => '111', '2' => '222'),
    array('1' => '111111', '2' => '222222'),
    );

echo html_table($data);