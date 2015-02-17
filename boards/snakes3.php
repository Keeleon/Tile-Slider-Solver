<?php

/*
$type       = $snake[$y][$x]->type;
$snakeOrder = $snake[$y][$x]->order;
$t          = $snake[$y][$x]->marker;
*/

// ['a-z'][Y][X] <-- IMPERATIVE (g is reserved for the snake we are trying to match to the goal)

// Type => head | body | tail
// Order => 1 (HEAD) | n (incrementing starting at 2 for body) | n+1 (TAIL)

$goalArray = array(

      array('x' => 0, 'y' => 0)
    , array('x' => 1, 'y' => 0)

);

$snakeMarkerArray = array('g');

$snake_coords_with_type['g'][4][0] = (object)array('type' => 'head', 'order' =>  1, 'marker' => 'g');
$snake_coords_with_type['g'][5][0] = (object)array('type' => 'tail', 'order' =>  2, 'marker' => 'g');
?>