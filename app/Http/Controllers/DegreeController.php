<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Degree;
use App\Models\Question;
use App\Models\Finesh_exam;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDegreeRequest;
use App\Http\Requests\UpdateDegreeRequest;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $results = Degree::where('studentinfo_id', auth()->user()->id)->get();

        return response($results, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDegreeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDegreeRequest $request)
    {
        $question = Question::findOrFail($request->question_id)->first();
        $myExam = Finesh_exam::where('exam_id', $question->exam->id)->first();
        $date = Carbon::parse($myExam->end_exam);
        $now = Carbon::now();

        if ($date->isFuture()) {
            $myscor = 0;

            $myQuestion = Degree::where('question_id', $request->question_id)->where('studentinfo_id', auth()->user()->id)->first();
            if ($question) {
                if ($question->correct == $request->answer) {
                    $myscor = $question->score;
                }
            }

            if ($myQuestion) {
                $result = Degree::where('id',$myQuestion->id)->update([
                    'answer' => $request->answer,
                    'score' => $myscor,
                    'studentinfo_id' => auth()->user()->id,
                    'question_id' => $request->question_id,
                    'exam_id' => $question->exam->id,
                ]);

                return response()->json(['data' => $result], 200);

            } 
            else {
                $result = Degree::create([
                    'answer' => $request->answer,
                    'score' => $myscor,
                    'studentinfo_id' => auth()->user()->id,
                    'question_id' => $request->question_id,
                    'exam_id' => $question->exam->id,
                ]);

                return response()->json(['data' => $result], 200);

            }

        }

        return response()->json(['exam test finesh in' . $myExam->end_exam], 400);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function show($degree)
    {
        $degree=Degree::where('question_id',$degree)->first();
        return response(['data' => $degree], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function endExam(Request $request)
    {
        $question = Question::findOrFail($request->question_id)->first();
        $myExam = Finesh_exam::where('exam_id', $question->exam->id)->first();
         $myExam->update(['end_exam'=>Carbon::now()->format('Y-m-d H:i:s')]);
        return response()->json(['data' => $myExam], 200);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDegreeRequest  $request
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDegreeRequest $request, Degree $degree)
    {
        $degree->update($request->all());

        return response(['message' => "update success", 'data' => $degree], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Degree $degree)
    {
        $degree->delete();

        return response(['message' => "delete success", 'data' => $degree], 200);
    }
}
