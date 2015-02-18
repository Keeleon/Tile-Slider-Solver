<style type="text/css">

.board{
    width: 250px;
    height: 250px;

    font-family: arial;
    
    display: inline-block;

    /*border: 1px solid #8F8F8F;*/
}

.row{
    display: block;
    color: white;
}

.tile{
    width:  30px;
    height: 30px;
}

.space{
    display: inline-block;
    border: 1px solid #8F8F8F;
    background-color: #CCCCCC;
}

.nonSpace{
    display: inline-block;
    border: 1px solid #000000;
    background-color: #000000;
}

.goal{
    border: 1px solid #66FF66;
}

.snake{
    
}

.snakeG{
    background-color: #335C33 !important;
}

.snakeP{
    background-color: #6600FF !important;
}

.snakeY{
    background-color: #E6E600 !important;
}

.snakeB{
    background-color: #0033CC !important;
}
</style>

<title>Machinarium Ball Slider Solver</title>

<?php

set_time_limit(0);

$dir = realpath(dirname(__FILE__));

include($dir . '/Class.Puzzle.php');
include($dir . '/Class.Board.php');
include($dir . '/Class.Tile.php');

// Change this based on the files in /boards
$boardNumber = 1;

$board_text = file_get_contents($dir . '/boards/board' . $boardNumber . '.txt');
                        include($dir . '/boards/snakes' . $boardNumber . '.php');

$puzzle = new Puzzle($board_text, $snakeMarkerArray, $snake_coords_with_type, $goalArray);

//$puzzle->displayStartingState();

$puzzle->solve();

?>