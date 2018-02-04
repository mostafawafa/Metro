<?php
/**
 * Created by PhpStorm.
 * User: ub
 * Date: 03/02/18
 * Time: 12:25 م
 */

namespace App\DataStructure;


class LinkedList
{
    public $head = null;
    public $tail = null;

    public function __construct($nodes = []){

        foreach($nodes as $node){
            $this->addToLast($node);
        }
    }

    public function addToLast(Node $node){

        if(is_null($this->head)){
            $this->head = $node;
            $this->tail = $node;
        }
        else{
            $this->tail->next = $node;
            $this->tail = $node;

        }

    }

    public function removeFromStart(){
        $start = $this->head;
        $this->head = $this->head->next;
        return $start;

    }



    public function print(){
        $travers = $this->head;
        while(! is_null($travers)){
            echo '->' . ($travers->value);
            $travers = $travers->next;

        }
    }

}