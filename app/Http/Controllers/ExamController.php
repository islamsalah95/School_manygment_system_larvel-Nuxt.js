<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\Degree;
use App\Models\Finesh_exam;
use App\Models\Studentinfo;
use App\Http\Resources\ExamRsource;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Http\Resources\showQuestionsExamRsource;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=Exam::with('subjects')->get();

        $results = ExamRsource::collection($results);

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
     * @param  \App\Http\Requests\StoreExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamRequest $request)
    {

        $result = Exam::create($request->all());
        $result =new ExamRsource($result);
        return response()->json(['data' => $result], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        return response($exam, 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamRequest  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $exam->update($request->all());

       return response(['message'=>"update success",'data'=>$exam], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        return response(['message'=>"delete success",'data'=>$exam], 200);
    }


    public function showQuestionsExam($exam)
    {
        //retive student  classroom
        $authId=auth()->user()->id;
        $student=Studentinfo::where('student_id',$authId)->first();
        $studentClassroom=$student->classroom->id;
        //retive Exam classroom
        $myExam = Exam::findOrFail($exam);
        $examClassroom=$myExam->subjects->classroom->id ;

         //make sure student have access for this exam  
        if ( $studentClassroom==$examClassroom) {
           
            $isExamBefore=Finesh_exam::where('exam_id',$myExam->id)->where('studentinfo_id',$authId)->first();
            
            //if exam finesh return result
            if($isExamBefore){
                $date = Carbon::parse($isExamBefore->end_exam);
                $now = Carbon::now();
                if (!$date->isFuture()) {
            $examResult= Degree::where('studentinfo_id',auth()->user()->id)
                                ->where('exam_id',$myExam->id)
                                ->sum('score');
                $total =$myExam->questions->sum('score');
                
                    return response(['examResult' => ceil(($examResult / $total)*100)], 200);
                }
            }

         
            //make sure student dont start exam set exam start and end   
            if(!$isExamBefore){
            $formattedDateTime = Carbon::now()->format('Y-m-d H:i:s');
            $endDate = Carbon::parse($formattedDateTime);
            $endDate = $endDate->addMinutes($myExam ->minutes);
            $endDate = $endDate->format('Y-m-d H:i:s');
            Finesh_exam::create([
                'exam_id'=>$myExam->id,
                'studentinfo_id'=>$authId,
                'start_exam'=>$formattedDateTime,
                'end_exam'=>$endDate,
            ]);
         }

          $results = $myExam->questions()->paginate(1); 
          return response(['results' => $results], 200);
         }

         return response(['Errors' => "not auth access this exam"], 400);

    }
}