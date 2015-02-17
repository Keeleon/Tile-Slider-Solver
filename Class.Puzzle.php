<?php

class Puzzle
{
    private
          $snake_markers
        , $goalTiles  = array();

    /** CONSTRUCTOR **/
    function __construct( $board_text, $snake_markers, $snake_coords_with_type, $goalTiles )
    {
        $this->snake_markers = $snake_markers;
        
        $this->goalTiles = $goalTiles;
        
        $board_tiles = $this->assignTiles($board_text, $snake_coords_with_type);
        
        Board::$boards[0] = new Board($board_tiles, $snake_markers, 0);
    }
    
    private function assignTiles( $board_text, $snake_coords_with_types )
    {       
        $board_text = str_replace( array( "\r\n" ), '|', $board_text );

        $board_text_array = str_split( $board_text );
        
        $tiles = array();

        $x = 0;
        $y = 0;

        $this->tiles[$y] = array();

        $snake = ( object )array( 'foundHead' => false, 'foundTail' => false );
        $snakes = array();
        
        foreach ( $board_text_array as $t )
        {
            $foundHead  = false;
            $foundBody  = false;
            $foundTail  = false;
            $snakeOrder = 0; // 0 for no snake
            
            if($t == '|'){
                $y++;
                $x = 0;
                continue;
            }
            
            
            
            foreach($snake_coords_with_types as $snake){
                if(isset($snake[$y][$x])){
                    $type       = $snake[$y][$x]->type;
                    $snakeOrder = $snake[$y][$x]->order;
                    $t          = $snake[$y][$x]->marker;

                    switch($type)
                    {
                        case('head'):
                            $foundHead  = true;
                        break;
                        
                        case('body'):
                            $foundBody  = true;
                        break;

                        case('tail'):
                            $foundTail = true;
                        break;
                    }

                    break;
                }
            }

            if($t == '!'){
                //$this->goalTiles[] = array('x' => $x, 'y' => $y);
                $t = '0'; 
            }
            
            $tiles[$y][$x] = new Tile( $t, $foundHead, $foundTail, $foundBody, $snakeOrder );

            $x++;
        }
        
        return $tiles;
    }

    /** CONSTRUCTOR **/

    public function solve(){
        
        $this->makeEveryMovePossible();
        
    }
    
    
    private function makeEveryMovePossible(){

        $bCount = 0;

        do{

            $board = Board::$boards[$bCount];
           
            //echo '<h1>UP</h2>';
            $board->makeMove('UP');

            //echo '<h1>DOWN</h2>';
            $board->makeMove('DOWN');

            //echo '<h1>LEFT</h2>';
            $board->makeMove('LEFT');

            //echo '<h1>RIGHT</h2>';
            $board->makeMove('RIGHT');

            $bCount++;
        }while(!$this->solutionFound($board)); // && $bCount < 20
        
        // if we get here a solution was found because we broke from the loop!
        $this->displaySolution($board);
    }


    
    public function displayStartingState(){
        Board::$boards[0]->display();
    }
    
    
    private function solutionFound($boardToCheck){

        foreach($this->goalTiles as $gt){

            $tileToCheck = $boardToCheck->getTile($gt['x'], $gt['y']); 

            if(strtolower($tileToCheck->getContents()) == 'g'){
                continue; // to look to see if the rest of the goal tiles are a match!
            }else{
                return false;
            }

        }
   
        return true;
    }
    
    private function displaySolution($winningBoard){
        echo '<h1>Board ID: ' . $winningBoard->getBoardId() . ' has found a solution. And here it is!</h1>';
        $moveCount = 0;
        Board::displayMoveTrace($winningBoard->getBoardId(), $moveCount);
    }
}
?>