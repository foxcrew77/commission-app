<?php
// $conn = mysqli_connect("localhost", "ccareco1", "CWLD#sur6Ni9", "ccareco1_it");
$conn = mysqli_connect('localhost', 'ccareco1', 'CWLD#sur6Ni9', 'ccareco1_it');

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    if (is_bool($result)) { //remove this row to troubleshoot query
        return 0; //if no data returned, this row is to remove warning
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
function queryProc($query)
{
    global $conn;
    $rows = [];
    // Execute multi query
    if (mysqli_multi_query($conn, $query)) {
        do {
            // Store first result set
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                    // var_dump($row);
                    // echo '<br>';
                }
                mysqli_free_result($result);
            }

            // if there are more result-sets, the print a divider
            if (mysqli_more_results($conn)) {
                // printf("------more results-------\n");
                // echo '<br>';
            }
            //Prepare next result set
        } while (mysqli_next_result($conn));
    }
    return $rows;
}
function getDatafromMonth($month)
{
    query("SET SESSION group_concat_max_len = 1000000");
    return queryProc("call attendanceUserInsertMonth2('$month')");
}
$dataInside = query('select sname from data2 limit 1');

if (isset($_POST["import"])) {
    function importCSVFile($yearMonth,$month)
    {
        -- global $dataInside;
        -- global $conn;
        -- if (!$dataInside) {
        --     echo '';
        -- } else {
        --     query("delete from data2");
        -- }
        -- $filename = $_FILES["file"]["tmp_name"];
        
        if ($_FILES["file"]["size"] > 0) {
            $file = fopen($filename, "r");
            
            while (($column = fgetcsv($file, 1000, ",")) !== FALSE) {
                
                dd($column);
                echo '<br>';
                // if (($column[0] !== "sName") && ($column[0] !== "'NULL") && ($column[0] !== "'Admin")) {
                //     $x = substr($column[3],-4)."-".substr($column[3],-7,-5);
                  
                //     if (substr($column[3], 0, 7) == $yearMonth || $x == $yearMonth) {

                //         $column[0] = (substr($column[0], 0, 1) == "'") ? substr($column[0], 1) : $column[0];
                //         $column[1] = (substr($column[1], 0, 1) == "'") ? substr($column[1], 1) : $column[1];

                //         $sqlInsert = "Insert into data2 (sName, sJobNo, Date, Time, SerialNo) values ('" . $column[0] . "', '" . $column[1] . "', '" . $column[3] . "', '" . $column[4] . "', '" . $column[10] . "')";

                //         $result = mysqli_query($conn, $sqlInsert);
                //         if (!empty($result)) {
                            
                //             echo "CSV Data Imported into the database";
                //         } else {
                //             echo "Problem in importing CSV";
                //         }
                //     }
                // }
            }
            
            echo '<div class="hideprint">CSV Data successfully imported.</div>';
           
            return getDatafromMonth($month);
            
        }
    }
    
}

