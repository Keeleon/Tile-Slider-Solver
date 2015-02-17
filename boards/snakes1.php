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

      array('x' => 3, 'y' => 5)
    , array('x' => 4, 'y' => 5)
    , array('x' => 5, 'y' => 5)

);

$snakeMarkerArray = array('g', 'p', 'y');

$snake_coords_with_type['g'][1][0] = (object)array('type' => 'head', 'order' =>  1, 'marker' => 'g');
$snake_coords_with_type['g'][1][1] = (object)array('type' => 'body', 'order' =>  2, 'marker' => 'g');
$snake_coords_with_type['g'][1][2] = (object)array('type' => 'tail', 'order' =>  3, 'marker' => 'g');

$snake_coords_with_type['p'][0][2] = (object)array('type' => 'head', 'order' =>  1, 'marker' => 'p');
$snake_coords_with_type['p'][0][3] = (object)array('type' => 'body', 'order' =>  2, 'marker' => 'p');
$snake_coords_with_type['p'][0][4] = (object)array('type' => 'body', 'order' =>  3, 'marker' => 'p');
$snake_coords_with_type['p'][0][5] = (object)array('type' => 'body', 'order' =>  4, 'marker' => 'p');
$snake_coords_with_type['p'][1][5] = (object)array('type' => 'body', 'order' =>  5, 'marker' => 'p');
$snake_coords_with_type['p'][2][5] = (object)array('type' => 'body', 'order' =>  6, 'marker' => 'p');
$snake_coords_with_type['p'][3][5] = (object)array('type' => 'body', 'order' =>  7, 'marker' => 'p');
$snake_coords_with_type['p'][3][4] = (object)array('type' => 'body', 'order' =>  8, 'marker' => 'p');
$snake_coords_with_type['p'][3][3] = (object)array('type' => 'body', 'order' =>  9, 'marker' => 'p');
$snake_coords_with_type['p'][4][3] = (object)array('type' => 'body', 'order' => 10, 'marker' => 'p');
$snake_coords_with_type['p'][5][3] = (object)array('type' => 'body', 'order' => 11, 'marker' => 'p');
$snake_coords_with_type['p'][5][4] = (object)array('type' => 'tail', 'order' => 12, 'marker' => 'p');

$snake_coords_with_type['y'][3][0] = (object)array('type' => 'head', 'order' =>  1, 'marker' => 'y');
$snake_coords_with_type['y'][3][1] = (object)array('type' => 'body', 'order' =>  2, 'marker' => 'y');
$snake_coords_with_type['y'][4][1] = (object)array('type' => 'body', 'order' =>  3, 'marker' => 'y');
$snake_coords_with_type['y'][5][1] = (object)array('type' => 'body', 'order' =>  4, 'marker' => 'y');
$snake_coords_with_type['y'][5][0] = (object)array('type' => 'tail', 'order' =>  5, 'marker' => 'y');

?>