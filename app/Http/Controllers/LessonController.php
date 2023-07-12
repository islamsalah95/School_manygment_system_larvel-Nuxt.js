<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Attachment;
use App\Helpers\FileHelper;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;

class LessonController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=  Lesson::all();

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
     * @param  \App\Http\Requests\StoreSubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLessonRequest $request)
    {

        // return $request->path;
        $lesson=  Lesson::create($request->all());

         if ($request->path) {
            for ($i=0; $i < count($request->path); $i++) {
              
                $fileUrl = FileHelper::storeFile($request->path[$i]);
                $attachment = new Attachment();
                $attachment->path = $fileUrl;
                $attachment->save();
                $lesson->attachment()->save($attachment);
            }
         }


        return response(['message'=>"update success",'data'=>$lesson], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        return response($lesson, 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectRequest  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $result= $lesson->update($request->all());

        return response(['message'=>"update success",'data'=>$result], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return response("delete success", 200);
    }
}
