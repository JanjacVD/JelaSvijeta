<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Meal;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Filter\Filter;
use App\Models\Filter\ObjectCreator;
use App\Models\Ingredient;
use App\Models\Lang;

class RequestController extends Controller
{
    public function fetchRequest(Request $request)
    {
        $request->validate([
            'per_page' => 'integer',
            'page' => 'integer',
            'category' => 'integer',
            'tags.*' => 'integer',
            'with' => 'array',
            'with.*' => 'string',
            'diff_time' => 'numeric',
        ]);
        //Check if Lang exists and get it if it does
        $rpp = $request->per_page; //Results per page
        $page = $request->page; //Page number
        $lang = Lang::where('lang', $request->lang)->firstOrFail();
        //Filter all the meals and create objects in the filter class
        $meals = new Filter();
        $response = $meals->filter($request->tags, $request->category, $request->with, $lang->id);
        //Paginate the response if needed
        if($rpp != null && $page !=null){
            $total = count($response); //Total avaliable items
            $totalPages = ceil($total / $rpp);
            $page = max($page, 1); //get 1 page when $page <=0
            $page = min($page, $totalPages); //get last page when $page > $totalPages
            $offset = ($page - 1) * $rpp;
            $response = array_slice($response, $offset, $rpp);
        }
            return $response;
    }
}
