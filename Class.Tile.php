<?php

class Tile
{
    private
          $x
        , $y
        , $contents
        , $goalMarker      = '!'
        , $nonSpaceMarker  = '#'
        , $openSpaceMarker = '0'
        , $validSpace
        , $isGoal
        , $isSnakeTail
        , $isSnakeHead
        , $isSnakeBody
        , $snakeBodyOrder;

    /** CONSTRUCTOR **/
    function __construct( $contents, $isSnakeHead, $isSnakeTail, $isSnakeBody, $snakeBodyOrder )
    {
        $this->snakeBodyOrder = $snakeBodyOrder;
        
        $this->validSpace = $contents != $this->nonSpaceMarker;
   
        $this->isGoal = $contents == $this->goalMarker;
        
        $this->isSnakeHead = $isSnakeHead;
        $this->isSnakeBody = $isSnakeBody;
        $this->isSnakeTail = $isSnakeTail;

        if($this->isGoal()){
            $this->contents = $this->openSpaceMarker;
        }else{
            $this->contents = $contents;
        }
    }
    /** CONSTRUCTOR **/

    public function getContents(){
        return $this->contents;
    }

    public function setContents($newContents){
        $this->contents = $newContents;
    }

    public function isGoal(){
        return $this->isGoal;
    }

    public function isOpenSpace(){
        return $this->contents == $this->openSpaceMarker;
    }

    public function isValidSpace(){
        return $this->validSpace;
    }
    
    public function getSnakeOrder(){
        return $this->snakeBodyOrder;
    }
    
    public function isHead($snake_marker = null){
        if($snake_marker != null){
            if($this->contents == $snake_marker){
                return $this->isSnakeHead;
            }else{
                return false;
            }
        }else{
            return $this->isSnakeHead;   
        }
    }
    
    public function isBody($snake_marker = null){
        if($snake_marker != null){
            if($this->contents == $snake_marker){
                return $this->isSnakeBody;
            }else{
                return false;
            }
        }else{
            return $this->isSnakeBody;   
        }
    }
    
    public function isTail($snake_marker = null){
        if($snake_marker != null){
            if($this->contents == $snake_marker){
                return $this->isSnakeTail;
            }else{
                return false;
            }
        }else{
            return $this->isSnakeHead;   
        }
    }


    public function display($x, $y){
        //echo '<td>X: ' . $this->x . ' Y: ' . $this->y . ' CONTENTS: ' . $this->contents . '</td>';

        $class = 'tile ';
        $displayContent = true;

        if($this->isGoal())
        {
            $class .= 'goal space';
            //$class = 'space';
        }
        elseif(!$this->isValidSpace())
        {
            $class .= 'nonSpace';
        }
        elseif($this->isOpenSpace())
        {
            $class .= 'space';   
        }
        else
        {
            //$displayContent = true;
            $class .= 'space snake snake' . strtoupper($this->contents);
        }

        echo '<div class="' . $class . '">' . ($displayContent ? ($x . ', ' . $y) : ' ') . '</div>';
    }
    
    public function tilesAreEqual($tile1, $tile2){
        return strtolower($tile1->getContents()) == strtolower($tile2->getContents());
    }
    
}
?>