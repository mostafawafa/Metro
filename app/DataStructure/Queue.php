<?php
/**
 * Created by PhpStorm.
 * User: ub
 * Date: 03/02/18
 * Time: 12:26 م
 */

namespace App\DataStructure;


class Queue
{
    public $container;
    public $length;

    public function __construct(LinkedList $container){
        $this->container = $container;
    }

    public function enqueue(Node $node){
        $this->container->addToLast($node);
        $this->length++;
    }

    public function dequeue(){
        return $this->container->removeFromStart();
        $this->length--;

    }

    public function isEmpty(){
        return ($this->length == 0 );
    }


}