<?php

function combotgl($awal, $akhir, $var, $terpilih)
{
    echo "<select name=$var>";
    for ($i = $awal; $i <= $akhir; $i++)
    {
        $lebar = strlen($i);
        switch ($lebar)
        {
            case 1:
                {
                    $g = "0" . $i;
                    break;
                }
            case 2:
                {
                    $g = $i;
                    break;
                }
        }
        if ($i == $terpilih)
            echo "<option value=$g selected>$g</option>";
        else
            echo "<option value=$g>$g</option>";
    }
    echo "</select> ";
}

function combobln($awal, $akhir, $var, $terpilih)
{
    echo "<select name=$var>";
    for ($bln = $awal; $bln <= $akhir; $bln++)
    {
        $lebar = strlen($bln);
        switch ($lebar)
        {
            case 1:
                {
                    $b = "0" . $bln;
                    break;
                }
            case 2:
                {
                    $b = $bln;
                    break;
                }
        }
        if ($bln == $terpilih)
            echo "<option value=$b selected>$b</option>";
        else
            echo "<option value=$b>$b</option>";
    }
    echo "</select> ";
}

function combothn($awal, $akhir, $var, $terpilih)
{
    echo "<select name=$var>";
    for ($i = $awal; $i <= $akhir; $i++)
    {
        if ($i == $terpilih)
            echo "<option value=$i selected>$i</option>";
        else
            echo "<option value=$i>$i</option>";
    }
    echo "</select> ";
}

function combonamabln($awal, $akhir, $var, $terpilih)
{
    $nama_bln = array(
        1 => "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember");
    echo "<select name=$var>";
    for ($bln = $awal; $bln <= $akhir; $bln++)
    {
        if ($bln == $terpilih)
            echo "<option value=$bln selected>$nama_bln[$bln]</option>";
        else
            echo "<option value=$bln>$nama_bln[$bln]</option>";
    }
    echo "</select> ";
}
function combo($label, $name, $id, $class, $x, $tabel, $n, $i)
{
    echo "<p>
            <label>$label :</label>
          <select name='$name' id='$id' class='$class' $x>";
    $sql = mysql_query("select * from $tabel");
    while ($r = mysql_fetch_array($sql))
    {
        echo "<option value=$r[$n]>$r[$i]</option>";
    }
    echo "</select>
         </p>";
}
function combo3($tabel,$n,$i)
{
			$sql = mysql_query("select * from $tabel");
				while ($r=mysql_fetch_array ($sql))
				{
				echo "<option value=$r[$n]>$r[$i]</option>";
				}
}

function combo2($label, $name, $id, $class, $x, $awal, $tabel, $n, $i)
{
    echo "<p>
            <label>$label :</label>
          <select name='$name' id='$id' class='$class' $x>";
    echo "<option value='0' selected='selected'> $awal </option> ";
    $sql = mysql_query("select * from $tabel");
    while ($r = mysql_fetch_array($sql))
    {
        echo "<option value=$r[$n]>$r[$i]</option>";
    }
    echo "</select>
         </p>";
}

function combo4($label, $name, $id, $class, $x, $tabel, $n, $i)
{
    echo "<p>
            <label>$label :</label>
          <select name='$name' id='$id' class='$class' $x>";
    $sql = mysql_query("select * from $tabel");
    while ($r = mysql_fetch_array($sql))
    {
        echo "<option value=$r[$n]>$r[$i]</option>";
    }
    echo "</select>
         </p>";
}

function combotgldisabled($awal, $akhir, $var, $terpilih)
{
    echo "<select name='$var' disabled='disabled'>";
    for ($i = $awal; $i <= $akhir; $i++)
    {
        $lebar = strlen($i);
        switch ($lebar)
        {
            case 1:
                {
                    $g = "0" . $i;
                    break;
                }
            case 2:
                {
                    $g = $i;
                    break;
                }
        }
        if ($i == $terpilih)
            echo "<option value=$g selected>$g</option>";
        else
            echo "<option value=$g>$g</option>";
    }
    echo "</select> ";
}

function comboblndisabled($awal, $akhir, $var, $terpilih)
{
    echo "<select name='$var' disabled='disabled'>";
    for ($bln = $awal; $bln <= $akhir; $bln++)
    {
        $lebar = strlen($bln);
        switch ($lebar)
        {
            case 1:
                {
                    $b = "0" . $bln;
                    break;
                }
            case 2:
                {
                    $b = $bln;
                    break;
                }
        }
        if ($bln == $terpilih)
            echo "<option value=$b selected>$b</option>";
        else
            echo "<option value=$b>$b</option>";
    }
    echo "</select> ";
}

function combothndisabled($awal, $akhir, $var, $terpilih)
{
    echo "<select name='$var' disabled='disabled'>";
    for ($i = $awal; $i <= $akhir; $i++)
    {
        if ($i == $terpilih)
            echo "<option value=$i selected>$i</option>";
        else
            echo "<option value=$i>$i</option>";
    }
    echo "</select> ";
}
function combonamablndisabled($awal, $akhir, $var, $terpilih)
{
    $nama_bln = array(
        1 => "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember");
    echo "<select name=$var disabled='disabled'>";
    for ($bln = $awal; $bln <= $akhir; $bln++)
    {
        if ($bln == $terpilih)
            echo "<option value=$bln selected>$nama_bln[$bln]</option>";
        else
            echo "<option value=$bln>$nama_bln[$bln]</option>";
    }
    echo "</select> ";
}

function enumComboAdd($table_name, $column_name, $echo = false)
{
   $selectDropdown = "<select name=\"$column_name\">";
   $result = mysql_query("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_NAME = '$table_name' AND COLUMN_NAME = '$column_name'")
   or die (mysql_error());

    $row = mysql_fetch_array($result);
    $enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));

    foreach($enumList as $value)
         $selectDropdown .= "<option value=\"$value\">$value</option>";

    $selectDropdown .= "</select>";

    if ($echo)
        echo $selectDropdown;

    return $selectDropdown;
}
function enumComboEdit($table_name, $column_name, $id_name, $echo = false)
{
   $selectDropdown = "<select name=\"$column_name\">";
   $result = mysql_query("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_NAME = '$table_name' AND COLUMN_NAME = '$column_name'")
   or die (mysql_error());
   // $result2 = mysql_query("SELECT $column_name FROM $table_name") or die (mysql_error()); 
    
    $row = mysql_fetch_array($result);
    $enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
    
    foreach($enumList as $value)
        if($value == $id_name){
            $selectDropdown .= "<option value=\"$value\" selected>$value</option>";
         }
         else {
            $selectDropdown .= "<option value=\"$value\">$value</option>";
         }

    $selectDropdown .= "</select>";

    if ($echo)
       echo $selectDropdown;

    return $selectDropdown;
}
?>


