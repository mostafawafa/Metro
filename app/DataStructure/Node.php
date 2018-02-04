<?php
/**
 * Created by PhpStorm.
 * User: ub
 * Date: 03/02/18
 * Time: 12:24 م
 */

namespace App\DataStructure;


class Node
{

    public $value;
    public $next = null;

    public function __construct($value){
        $this->value = $value;
    }

}