<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Video;use Illuminate\Http\Request;

class PageController extends Controller
{
    public function view(Request $request, $route, $link)
    {
        $page = Page::where('slug', $link)->first();
        $data = file_get_contents(public_path($page->url));
        $data = json_decode($data, true);
        return view('pages.view', compact('data'));
        // return view()->render(); 
    }
}
