<?php
namespace App\Http\Controllers;
use \App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $listTopWitdraw = \Cache::remember('listTopWitdrawHome', 120, function () {
            $ret = [];
            for ($i=0; $i < 16; $i++) { 
                $dataAdd = [];
                $dataAdd['name'] = 'Member'.strtoupper(\Str::random(8));
                $dataAdd['money'] = rand(5,1000)*10000;
                $dataAdd['time'] = now()->subMinutes(rand(1,2))->format('h:i');
                array_push($ret,$dataAdd);
            }
            return $ret;
        });
        $listSlider = Slider::act()->get();
        return view('home',compact('listSlider','listTopWitdraw'));
    }
    public function direction(Request $request, $link)
    {
        $lang = \App::getLocale();
        $link = \FCHelper::getSegment($request, 1);
        $route = \DB::table('v_routes')->select('*')->where($lang.'_link', $link)->first();
        if ($route == null) {
            abort(404);
        }
        $controllers = explode('@', $route->controller);
        $controller = $controllers[0];
        $method = $controllers[1];
        return (new $controller)->$method($request, $route, $link);
    }
}
