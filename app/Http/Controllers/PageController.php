<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function view($request, $route, $link)
    {
        $page = Page::where('slug', $link)->where('act',1)->first();
        if (!isset($page)) {
            abort(404);
        }
        return view('pages.'.$page->layout_show, compact('page'));
    }
}
