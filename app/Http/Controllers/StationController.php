<?php

namespace App\Http\Controllers;

use App\Station;
use Illuminate\Http\Request;
use App\DataStructure\GraphNode;
use App\DataStructure\LinkedList;
use App\DataStructure\Graph;
use Cache;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $stations = Cache::remember('stations',10000,function(){
            return Station::all();

       });
        return view('index',compact('stations'));

    }


    public function getShortestPath(){
        $nodes = [];
        $collections = [];
        $stations = Station::with('stations')->get();
    
        foreach($stations as $station){{
            
            $listNodes = [];
            $nodes[$station->id] = new GraphNode($station->id);
            foreach ($station->stations as $st){
                $listNodes[] = new GraphNode($st->id);
            }
            $collections[$station->id] = new LinkedList($listNodes);
        }}

        $g = new Graph($nodes,$collections);

        return $g->shortestPathFrom(request('src'),request('dest'))->toJson();
    
    }

}
