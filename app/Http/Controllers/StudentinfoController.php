<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Studentinfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\PasswortStudents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\showSubjectStudent;
use App\Http\Resources\StudentinfoRsource;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\StoreStudentinfoRequest;
use App\Http\Requests\UpdateStudentinfoRequest;
use App\Http\Requests\PromotionStudentinfoRequest;


class StudentinfoController extends Controller
{


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $results=Studentinfo::paginate(5);
        // $results=StudentinfoRsource::collection($results);
        // return response($results, 200);

        $results = Studentinfo::paginate(20);
        $results = StudentinfoRsource::collection($results);
        return $results->additional([
            'pagination' => [
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'per_page' => $results->perPage(),
                'total' => $results->total(),
            ],
        ]);

                // return response($results, 200);


    }

    public function filterStudents($grade_id,$classroom_id,$section_id)
    {


        $results = Studentinfo::where([
            'grade_id'=> $grade_id,
            'classroom_id'=> $classroom_id,
            'section_id'=> $section_id,
        ])->paginate(20);
        $results = StudentinfoRsource::collection($results);
        return $results->additional([
            'pagination' => [
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'per_page' => $results->perPage(),
                'total' => $results->total(),
            ],
        ]);

    }


    public function filterStudentsName($name)
    {
        $results = User::where('name', 'like', '%' . $name . '%')->with('studentinfo')->get();

        $studentinfo = collect();
        foreach ($results as $result) {
            if ($result->studentinfo) {
                $studentinfo->push($result->studentinfo);
            }
                }

    $results = StudentinfoRsource::collection($studentinfo);

         return response($results, 200);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentinfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentinfoRequest $request)
    {

        $register=new AuthController();

        $userPass=Str::random(10);
        $userRequest = new Request([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $userPass,
            'type' => 'student'
        ]);

        $user=$register->register($userRequest);

        $parentPass=Str::random(10);
        $parentRequest = new Request([
            'name' => $request->parent_name,
            'email' => $request->parent_email,
            'password' => $parentPass,
            'type' => 'parent'
        ]);
        $parent=$register->register($parentRequest);


        $result= Studentinfo::create([
            'student_id'=>$user->id,
            'grade_id'=> $request->grade_id,
            'classroom_id'=> $request->classroom_id,
            'section_id'=> $request->section_id,
            'parent_id'=> $parent->id,
            'Nationality'=> $request->Nationality,
        ]);

  
        Mail::to($user)->send(new PasswortStudents($userPass));
        Mail::to($parent)->send(new PasswortStudents($parentPass));

        return response(['message'=>"create success",'data'=>$result], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Studentinfo  $Studentinfo
     * @return \Illuminate\Http\Response
     */
    public function show($Studentinfo)
    {

        $Studentinfo=Studentinfo::where('student_id',$Studentinfo)->first();

        return response($Studentinfo, 200);

    }


    public function showStudentInfo()
    {
        $id=auth()->user()->id;
        $user= Studentinfo::where('student_id',$id)->first();
        $results=new showSubjectStudent($user);

        return response(["results"=>$results], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Studentinfo  $Studentinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Studentinfo $Studentinfo)
    {

        return response(['message'=>"fitch success",'data'=>$Studentinfo], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentinfoRequest  $request
     * @param  \App\Models\Studentinfo  $Studentinfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentinfoRequest $request, $Studentinfo)
    {



        $Studentinfo=Studentinfo::where('student_id',$Studentinfo)->update($request->all());

       return response(['message'=>"update success",'data'=>$Studentinfo], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Studentinfo  $Studentinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($Studentinfo)
    {
        $Studentinfo= Studentinfo::where('student_id',$Studentinfo)->delete();

        return response(['message'=>"delete success",'data'=>$Studentinfo], 200);
    }

    public function promotion(PromotionStudentinfoRequest $request)
    {

        $Studentinfo=Studentinfo::where([
            'grade_id'=>$request->grade_id ,
            'classroom_id'=>$request->classroom_id  ,
            'section_id'=>$request->section_id  ,
            ])->update([
                    'grade_id'=>$request->grade_idto ,
                    'classroom_id'=>$request->classroom_idto  ,
                    'section_id'=>$request->section_idto  ,
                    ]);

       return response(['message'=>"update success",'data'=>$Studentinfo], 200);
    }

}
