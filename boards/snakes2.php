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
    , array('x' => 2, 'y' => 0)

);

$snakeMarkerArray = array('g', 'p', 'y', 'b');

$snake_coords_with_type['g'][4][1] = (object)array('type' => 'head', 'order' =>  1, 'marker' => 'g');
$snake_coords_with_type['g'][4][2] = (object)array('type' => 'body', 'order' =>  2, 'marker' => 'g');
$snake_coords_with_type['g'][4][3] = (object)array('type' => 'tail', 'order' =>  3, 'marker' => 'g');

$snake_coords_with_type['p'][0][4] = (object)array('type' => 'head', 'order' =>  1, 'marker' => 'p');
$snake_coords_with_type['p'][1][4] = (object)array('type' => 'body', 'order' =>  2, 'marker' => 'p');
$snake_coords_with_type['p'][2][4] = (object)array('type' => 'body', 'order' =>  3, 'marker' => 'p');
$snake_coords_with_type['p'][3][4] = (object)array('type' => 'body', 'order' =>  4, 'marker' => 'p');
$snake_coords_with_type['p'][4][4] = (object)array('type' => 'tail', 'order' =>  5, 'marker' => 'p');

$snake_coords_with_type['y'][4][0] = (object)array('type' => 'head', 'order' =>  1, 'marker' => 'y');
$snake_coords_with_type['y'][5][0] = (object)array('type' => 'tail', 'order' =>  2, 'marker' => 'y');

$snake_coords_with_type['b'][2][0] = (object)array('type' => 'head', 'order' =>  1, 'marker' => 'b');
$snake_coords_with_type['b'][2][1] = (object)array('type' => 'body', 'order' =>  2, 'marker' => 'b');
$snake_coords_with_type['b'][2][2] = (object)array('type' => 'body', 'order' =>  3, 'marker' => 'b');
$snake_coords_with_type['b'][2][3] = (object)array('type' => 'tail', 'order' =>  4, 'marker' => 'b');
?>