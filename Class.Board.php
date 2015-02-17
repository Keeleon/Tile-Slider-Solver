<?php

class Board
{
    private $width, $height, $tiles, $snake_markers, $previousBoard, $boardId, $createdBy;

    public static $boards = array();
    public static $boardCount = 0;

    /** CONSTRUCTOR **/
    function __construct( $tiles, $snake_markers, $previousBoard, $createdBy = null )
    {
        $this->tiles         = $tiles;
        $this->snake_markers = $snake_markers;
        $this->previousBoard = $previousBoard;
        $this->createdBy     = $createdBy;
        $this->boardId       = Board::$boardCount;
    }

    /** CONSTRUCTOR **/

    


    /** MOVE FUNCTIONS **/
    
    public function getTiles()
    {
        return $this->tiles;
    }

    public function getTile( $x, $y )
    {

        if(isset($this->tiles[$y][$x])){
            return $this->tiles[$y][$x];
        }else{
            return new Tile( -1, -1, '#' );   
        }
    }

    public function getCreatedBy(){
        return $this->createdBy;
    }

    public function getSnakeMarkers()
    {
        return $this->snake_markers;
    }


    public function getBoardId()
    {
        return $this->boardId;
    }

    public function getPreviousBoardId(){
        return $this->previousBoard;
    }


    private function findCoordsOfSnakePart($entity, $snake_marker){
        
        $found = false;
        
        $bodyRet = array();
        
        foreach($this->tiles as $y => $row){
            foreach($row as $x => $t){
                
                switch($entity)
                {
                    //
                    case('head'):
                        if($t->isHead($snake_marker)){
                            $found = true;
                        }
                    break;
                    
                    //
                    case('tail'):
                        if($t->isTail($snake_marker)){
                            $found = true;
                        }
                    break;
                    
                    //
                    case('body'):
                        if($t->isHead($snake_marker) || $t->isBody($snake_marker) || $t->isTail($snake_marker)){                            
                            $bodyRet[] = array('x' => $x, 'y' => $y);
                        }
                    break;
                }

                if($found){
                    return array('x' => $x, 'y' => $y);
                }
            }
        }
        
        return $bodyRet;
    } 

    public function getCoordsOfSnakeHead($snake_marker){
        return $this->findCoordsOfSnakePart('head', $snake_marker);
    }

    public function getCoordsOfSnakeTail($snake_marker){
        return $this->findCoordsOfSnakePart('tail', $snake_marker);
    }

    public function getCoordsOfWholeSnake($snake_marker){
        return $this->findCoordsOfSnakePart('body', $snake_marker);
    }

    public function makeMove( $direction )
    {

        $head = true;
        $tail = false;

        foreach ( $this->snake_markers as $snake_marker )
        {
            $this->move($direction, $snake_marker, $head);
            $this->move($direction, $snake_marker, $tail);
        }
    }

    private function move($direction, $snake_marker, $head){
        
        if($head){
            $originCoords = $this->getCoordsOfSnakeHead($snake_marker);    
        }else{
            $originCoords = $this->getCoordsOfSnakeTail($snake_marker);
        }
        
        $oX = $originCoords['x'];
        $oY = $originCoords['y'];
        
        $origin = $this->tiles[$oY][$oX];
        
        $destinationX = $oX;
        $destinationY = $oY;
        
        
        
        switch($direction)
        {
            case('UP'):
                $destinationY--;
            break;
            
            case('DOWN'):
                $destinationY++;
            break;
            
            case('LEFT'):
                $destinationX--;
            break;
            
            case('RIGHT'):
                $destinationX++;
            break;
        }
        
        if(!isset($this->tiles[$destinationY][$destinationX]))
        {
            return false;
        }
        
        $destination = $this->tiles[$destinationY][$destinationX];
                
        if($destination->isOpenSpace()){            
            $creationText = 'Snake ' . $snake_marker . ($head ? ' HEAD' : ' TAIL') . ' ' . $direction;
            
            $this->slitherSnake($oX, $oY, $destinationX, $destinationY, $creationText);
        }else{
            return false;
        }
    }
    
    /** this function assumes origin and estination have already been checked in order to see:
     if they are really a head / tail and a valid open space **/
    private function slitherSnake($originX, $originY, $destinationX, $destinationY, $direction){

        $tempTiles    = $this->tiles;
        
        $tempOrigin      = $this->tiles[$originY][$originX];
        $tempDestination = $this->tiles[$destinationY][$destinationX];
        
        if($tempOrigin->isHead()){
            $movingByHead = true;
        }else{
            $movingByHead = false;
        }
        
        // swap the destination and origin
        $tempTiles[$originY][$originX]           = $tempDestination;
        $tempTiles[$destinationY][$destinationX] = $tempOrigin;
        
        $snake_marker = strtolower($tempOrigin->getContents());
        $snakeCoords  = $this->getCoordsOfWholeSnake($snake_marker);
        
        $snakeBody = array();
        foreach($snakeCoords as $sc){
            
            $tile = $this->tiles[$sc['y']][$sc['x']];
            
            $snakeBody[$tile->getSnakeOrder()] = (object)array('tile' => $tile, 'x' => $sc['x'], 'y' => $sc['y']);
        }
        
        $tailPosition = count($snakeBody);
        
        // catch up the rest of the snake body
        
        if($movingByHead){
            for($bodyCount = 2; $bodyCount <= $tailPosition; $bodyCount++){
            
                $takeTile = $snakeBody[$bodyCount - 1]->tile;
                $takeX    = $snakeBody[$bodyCount - 1]->x;
                $takeY    = $snakeBody[$bodyCount - 1]->y;
                
                $putTile  = $snakeBody[$bodyCount]->tile;
                $putX     = $snakeBody[$bodyCount]->x;
                $putY     = $snakeBody[$bodyCount]->y;
                
                
                $tempTake = $tempTiles[$takeY][$takeX];
                $tempPut  = $tempTiles[$putY][$putX];
                
                $tempTiles[$takeY][$takeX] = $tempPut;
                $tempTiles[$putY][$putX]   = $tempTake;
            }
        }else{
            for($bodyCount = $tailPosition - 1; $bodyCount >= 1; $bodyCount--){
            
                $takeTile = $snakeBody[$bodyCount + 1]->tile;
                $takeX    = $snakeBody[$bodyCount + 1]->x;
                $takeY    = $snakeBody[$bodyCount + 1]->y;
                
                $putTile  = $snakeBody[$bodyCount]->tile;
                $putX     = $snakeBody[$bodyCount]->x;
                $putY     = $snakeBody[$bodyCount]->y;
                
                
                $tempTake = $tempTiles[$takeY][$takeX];
                $tempPut  = $tempTiles[$putY][$putX];
                
                $tempTiles[$takeY][$takeX] = $tempPut;
                $tempTiles[$putY][$putX]   = $tempTake;
            }
        }
        
        if(!Board::tilePatternExists($tempTiles)){
            Board::$boardCount++;
            Board::$boards[Board::$boardCount] = new Board($tempTiles, $this->snake_markers, $this->boardId, $direction);    
        }/*else{
            echo "<h2>The board I tried making already exists =(</h2>";
        }*/
    }


    /** DISPLAY THE BOARD **/
    public function display()
    {

        echo '<div class="board">';

        echo '<h2>I AM BOARD: ' . $this->boardId . ' / PARENT BOARD: ' . $this->
            previousBoard . '</h2>';

        echo '<div class="row">';

        foreach ( $this->tiles as $y => $rows )
        {

            echo '<div class="row">';

            foreach ( $rows as $x => $tile )
            {
                $tile->display( $x, $y );
            }

            echo '</div>';
        }

        echo '</div>';

        echo $this->createdBy == null ? '' : 'Created by ' . $this->createdBy . ' move.';
    }
    
    public function tilePatternExists($tilesToCheck){

        $maxX = count($tilesToCheck[0]) - 1;
        $maxY = count($tilesToCheck)    - 1;

        $boardCount = count(Board::$boards) - 1;
        
        while($boardCount >= 0){
            $b = Board::$boards[$boardCount];
            $boardCount--;
            
            $tiles = $b->getTiles();

            $foundDifference = false;

            for($y = 0; $y <= $maxY; $y++){
                for($x = 0; $x <= $maxX; $x++){

                    $t1 = $tiles[$y][$x];
                    $t2 = $tilesToCheck[$y][$x];

                    if(!Tile::tilesAreEqual($t1, $t2)){
                        $foundDifference = true;
                        break 2;
                    }
                }
            }

            if($foundDifference){
                continue;
            }else{
                return true;
            }
        }
        
        /*
        foreach(Board::$boards as $b){
            
            $tiles = $b->getTiles();

            $foundDifference = false;

            for($y = 0; $y <= $maxY; $y++){
                for($x = 0; $x <= $maxX; $x++){

                    $t1 = $tiles[$y][$x];
                    $t2 = $tilesToCheck[$y][$x];

                    if(!Tile::tilesAreEqual($t1, $t2)){
                        $foundDifference = true;
                        break 2;
                    }
                }
            }

            if($foundDifference){
                continue;
            }else{
                return true;
            }
        }
        */
        
        return false;
    }    
    
    public function displayMoveTrace($board_id, &$moveCount){

        $thisBoard = Board::$boards[$board_id];

        if($board_id != 0){
            $parent_board_id = $thisBoard->getPreviousBoardId();
            Board::displayMoveTrace($parent_board_id, $moveCount);
        }
        
        $moveCount++;

        echo '<h1>MOVE: ' . $moveCount . '</h1>';
        $thisBoard->display();
    }
}

?>