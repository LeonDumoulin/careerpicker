<?php
namespace App\Http\Controllers\Api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
Use App\Models\Faculty;
Use App\Models\Technological;
class FrontController extends Controller
{

    public $helper;
    public $model;
    public $guard ;
    public function __construct()
    {
        $this->guard = 'api';
        $this->helper = new Helper();
        $this->model = new Faculty();
    }
			public function index(Request $request)

    {
     		$fac = Faculty::all()->random(1);
     		$course = Course::all()->random(1);
     		$tech = Technological::all()->random(1);
        return $this->helper->responseJson(1,'تمت العمليه بنجاح',[
			'fac' => $fac ,
			'course' => $course ,
			'tech' => $tech ,

]);

    }
}