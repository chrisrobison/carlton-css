#!/usr/bin/php
<?php
    $lines = file("images.json");
    
    $rows = 52;
    $cols = 40;

    $cnt = count($lines);
    $all = array();
    for ($i=0; $i<$cnt; $i++) {
        $line = preg_replace("/^\s*box-shadow:\s*/",'', preg_replace("/;/", "", $lines[$i]));
        $parts = preg_split("/\,\s*/", $line);
        $out = array();
        
        $x = 0; $y = 0;
        $row = array();
        for ($c=0; $c<2200; $c++) {
            $tmp = preg_split("/\s/", $parts[$c]);
            $x = intval(preg_replace("/0px/", '', $tmp[0]));
            $y = intval(preg_replace("/0px/", '', $tmp[1]));
            $color = preg_replace("/transparent/", '', $tmp[2]);
            
            $row[] = $color;

            if ($x == 40) {
                $out[] = $row;
                $row = array();
            }
            // $out[$y][] = $color;
//            ++$x;
//            if ($x > $cols) {
//                $x = 0;
//                $y++;
//            }
        }
        $all[] = $out;
    }
    print json_encode($all);
    //print_r($all);
?>
