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
            'tags' => 'string',
            'with' => 'string',
            'diff_time' => 'numeric',
        ]);
        $currentUrl = url()->full();

        $with = null;
        $tags = null;
        $rpp = $request->per_page;
        if ($request->tags != null) {
            $tags = explode(",", $request->tags);
        }
        if ($request->with != null) {
            $with = explode(",", $request->with);
        }
        //Check if Lang exists and get it if it does
        $timestamp = $request->diff_time;
        $trashed = false;
        if ($timestamp != null) {
            $trashed = true;
            $timestamp = Carbon::createFromTimestamp($request->diff_time)->format('Y-m-d H:i:s');
        }
        $rpp = $request->per_page; //Results per page
        $lang = Lang::where('lang', $request->lang)->firstOrFail();
        //Filter all the meals and create objects in the filter class
        $meals = new Filter();
        $response = $meals->filter($tags, $request->category, $with, $lang->id, $trashed, $timestamp, $rpp);
        if (isset($timestamp)) {
            $total = Meal::withTrashed()->where('deleted_at', '>', $timestamp)->orWhere('deleted_at', null)->count();
        } else {
            $total = Meal::all()->count();
        }
        if (isset($rpp)) {
            $pagesResidue = $total % $rpp;
            if ($pagesResidue > 0) {
                $totalPages = round(($total / $rpp) + 1);
            } else {
                $totalPages = $total / $rpp;
            }
            if (isset($request->page)) {
                $currentPage = $request->page;
                if ($request->page >= $totalPages) {
                    $nextUrl = null;
                } else {
                    $nextUrl = str_replace('page=' . $request->page, 'page=' . ($request->page + 1), $currentUrl);
                }
                if ($request->page > 1) {
                    $prevUrl = str_replace('page=' . $request->page, 'page=' . ($request->page - 1), $currentUrl);
                } else {
                    $prevUrl = null;
                }
            } else {
                $currentPage = 1;
                $prevUrl = null;
                $nextUrl = $currentUrl.'&page=2';
            }
            $meta = ['currentPage' => $currentPage, 'totalItems' => $meals->totalCount, 'itemsPerPage' => $rpp, 'totalPages' => $totalPages];
            $links = ['prev' => $prevUrl, 'next' => $nextUrl, 'self' => $currentUrl];
        } else {
            $meta = ['totalItems' => $meals->totalCount];
            $links = ['self' => $currentUrl];
        }
        return response()->json([
            'meta' => $meta,
            'data' => $response,
            'links' => $links
        ]);
    }
}
