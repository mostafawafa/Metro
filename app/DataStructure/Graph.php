<?php
/**
 * Created by PhpStorm.
 * User: ub
 * Date: 03/02/18
 * Time: 12:25 م
 */

namespace App\DataStructure;


use App\Station;
use Illuminate\Support\Collection;

class Graph
{

    public $nodes;
    public $container ;

    public function __construct($nodes , $container){

        $this->nodes = $nodes;
        $this->container = $container;
    }

    public function bfs($s){
        $q = new \SplQueue();

        // die(var_dump($node));


        $v = [];
        $q->enqueue($s);
        $this->nodes[$s]->visited = true;
        $v[] = $s;

        while(! $q->isEmpty()){
            // for($i=0;$i<2;$i++){

            $list = $this->container[$q->dequeue()];
            $node = $list->head;
            while(! is_null($node) ){
                // for($i=0;$i<2;$i++){
                if($this->nodes[$node->value]->visited == false){
                    $q->enqueue($node->value  );
                    $this->nodes[$node->value]->visited = true;
                    $v[] = ($node->value);
                }
                $node= $node->next;

            }

        }

        return $v;

    }


    public function shortestPathFrom($s,$d){
        $previous = [];
        $q = new \SplQueue();

        // die(var_dump($node));


        $v = [];
        $q->enqueue($s);
        $this->nodes[$s]->visited = true;
        $v[] = $s;
        $previous[$s] = null;
        while(! ( $q->isEmpty())  ){
            // for($i=0;$i<2;$i++){
            $parent =$q->dequeue();
            $list = $this->container[$parent];
            $node = $list->head;
            while(! is_null($node) ){
                // for($i=0;$i<2;$i++){
                if($this->nodes[$node->value]->visited == false){
                    $q->enqueue($node->value  );
                    $this->nodes[$node->value]->visited = true;
                    $previous[$node->value] = $parent;
                    $v[] = ($node->value);
                }
                $node= $node->next;

            }

        }
        $path = [$d];
        $prev = $previous[$d];
        while(! is_null($prev)){
            array_unshift($path,$prev);
            $prev = $previous[$prev];

        }
        $path = array_map(function($v){
            return Station::find($v);
        },$path);
        $stations = collect($path)->pluck('name');
        return $stations;

    }




}