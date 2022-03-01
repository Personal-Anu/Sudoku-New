<?php
// Composer
$composerPath = __DIR__ . '/vendor/autoload.php';
require $composerPath;

//used default php skeleton
class Sudoku
{
    var $sudoku = [];

    public function __construct(array $input)
    {
        $this->sudoku = $input;
    }

    /**
    * Validate a Sudoku.
    *
    * @param int[][] $sudoku
    *
    * A 9x9 matrix of integers from 1-9 (inclusive).
    *
    * @return bool
    *
    * TRUE if the sudoku is a valid, complete solution,
    * otherwise FALSE.
    */

    public function is_sudoku(): bool {

        if(count($this->sudoku) !== 9) return false; // if given matrix is not a 9*9

        $rows = $this->__validateRows(); // test rows
        $columns = $this->__validateColumns(); // test columns
        $blocks = $this->__validateBlocks(); // test 3*3 block

        // if input sudoku passed for all rows, columns and blocks is valid, then Sudoku is valid
        if($rows && $columns && $blocks) 
            return true;
        else
            return false;
    }

    /**
    * Tell whether all members of $array are integers.
    */
    function __is_int(array $array) {
        return array_filter($array, 'is_int') === $array;
    }

    /**
    * Tell whether all members of $array are unique.
    */
    public function __checkForDuplicate(array $array) {
        //array_flip will makes values as keys
        //duplicate ones will get removed as keys are always unique, 
        //also checking datatype as keys coud only be int or string
        //If input count is not same, i.e. there is a duplicate number
        return count($array) === count(array_flip($array));
    }

    /**
    * Tell whether all members of $array are are between 0 to 9 and there is no empty value.
    */
    function __isbetween1to9(array $array) {
        $range      = range(1, 9);
        $isInRange  = (min($array)>=min($range) and max($array)<=max($range)) ? true : false;
        return $isInRange && count($array) === 9;
    }

    public function __validateRows() {         
        // check all rows for duplicate values
        // any duplicate value in any row will fail validation
        $temp = false;
        for($row = 0 ; $row < 9 ; $row++) {
            
           // if(!$this->__is_int($this->sudoku[$row])) return false;
            if(!$this->__checkForDuplicate($this->sudoku[$row])) return false;
            if(!$this->__isbetween1to9($this->sudoku[$row])) return false;
            $temp = true;
        }  
        return $temp;     
    }

    public function __validateColumns() {
        
        // check all columns for duplicate values
        // any duplicate value in any column will fail validation
        $temp = false;
        for($col = 0 ; $col <9 ; $col++){
            $column = [];
            for($row = 0 ; $row <9 ; $row++){
                $column[] = $this->sudoku[$row][$col];

            }

            if(!$this->__is_int($column)) return false;
            if(!$this->__checkForDuplicate($column)) return false;
            if(!$this->__isbetween1to9($column)) return false;
            $temp = true;
        }
        return $temp;

    }

    public function __validateBlocks() {
        $xStart = 0;
        $yStart = 0;
        $temp = false;
        // check for 9 blocks containing 3 rows and 3 columns
        // any duplicate value in any block will fail validation
        for($b = 0 ; $b < 9 ; $b++){
             
            // set start x index and y index for every block according to block number
            $xStart = floor($b /3) * 3;
            $yStart = ($b % 3) * 3;
            $block = [];            
             
            // loop through all rows in the block
            for($x = $xStart ; $x < $xStart + 3 ; $x++){
                // traverse through all columns in the block
                for($y = $yStart ; $y < $yStart + 3 ; $y++){ 
                    $block[] = $this->sudoku[$x][$y];
                }  
            }
            if(!$this->__is_int($block)) return false;
            if(!$this->__checkForDuplicate($block)) return false;
            if(!$this->__isbetween1to9($block)) return false;
            $temp = true;
        }
        return $temp;
    }
}

// All other test matrix is inside public/inputMatrixSample.txt
//Copy different matrix for testing
$testSudoku = [
    [1, 3, 2, 5, 4, 6, 9, 8, 7],
    [4, 6, 5, 8, 7, 9, 3, 2, 1],
    [7, 9, 8, 2, 1, 3, 6, 5, 4],
    [9, 2, 1, 4, 3, 5, 8, 7, 6],
    [3, 5, 4, 7, 6, 8, 2, 1, 9],
    [6, 8, 7, 1, 9, 2, 5, 4, 3],
    [5, 7, 6, 9, 8, 1, 4, 3, 2],
    [2, 4, 3, 6, 5, 7, 1, 9, 8],
    [8, 1, 9, 3, 2, 4, 7, 6, 5]
];
$sudoku = new Sudoku($testSudoku);
$is_valid = $sudoku->is_sudoku();

echo "Given Sudoku <strong>". ($is_valid ? " is a" : " is not a"). "</strong> valid Sudoku" ;


