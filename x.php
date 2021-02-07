#!/usr/bin/php
<?php
    $lines = file("images.json");
    
    $rows = 52;
    $cols = 40;

    $cnt = count($lines);
    $all = array();
    for ($i=0; $i<$cnt; $i++) {
        $line = preg_replace("/^\s*box-shadow:\s*/",'', $lines[$i]);
        $parts = preg_split("/\,\s*/", $line);
        $out = array();
        
        $x = 0; $y = 0;

        for ($c=0; $c<2200; $c++) {
            $tmp = preg_split("/\s/", $parts[$c]);
//            $x = preg_replace("/0px/", '', $tmp[0]);
//            $y = preg_replace("/0px/", '', $tmp[1]);
            $color = preg_replace("/transparent/", '', $tmp[2]);
            
            if (!isset($out[$y])) {
                $out[$y] = array();
            }
            $out[$y][] = $color;
            ++$x;
            if ($x > $cols) {
                $x = 0;
                $y++;
            }
        }
        $all[] = $out;
    }
    print json_encode($all);
    print_r($all);
?>
