<?php

namespace App\Http\Controllers;

use App\Company;
use App\StudentDetail;
use App\StudentMark;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $students=StudentMark::where('id','!=',0)->orderBy('total', 'DESC')->take(100)->get();
        return view('page',[
            'students'=>$students
        ]);
    }
    public function save(Request $request){
        $studentname=$request->student_name;
        $mark_one=$request->mark_one;
        $mark_two=$request->mark_two;
        $mark_three=$request->mark_three;
        $total=$request->total;
        $rank=$request->rank;
        foreach ($studentname as $key => $val) {

            $checkstudent=StudentDetail::where('student_name',$val)->first();

            if (!$checkstudent){
                $this->validate($request, [
                    'student_name.*' => 'required',
                    'mark_one.*' => 'required',
                    'mark_two.*' => 'required',
                    'mark_three.*' => 'required',
                    'total.*' => 'required',
                    'rank.*' => 'required',
                ]);
                $student_details=new StudentDetail();
                $student_details->student_name=$val;
                $student_details->save();

                $student_marks=new StudentMark();
                $student_marks->student_id=$student_details->id;
                $student_marks->mark_1=$mark_one[$key];
                $student_marks->mark_2=$mark_two[$key];
                $student_marks->mark_3=$mark_three[$key];
                $student_marks->total=$total[$key];
                $student_marks->save();

            }


        }

    }
}
