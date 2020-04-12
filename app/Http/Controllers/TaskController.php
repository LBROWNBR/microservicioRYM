<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = Task::all();
        return $task;
        //Esta función nos devolvera todas las tareas que tenemos en nuestra BD
   
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->content = $request->content;

        $task->save();
        //Esta función guardará las tareas que enviaremos mediante vuejs
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $task = Task::findOrFail($request->id);
        return $task;
        //Esta función devolverá los datos de una tarea que hayamos seleccionado para cargar el formulario con sus datos
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task = Task::findOrFail($request->id);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->content = $request->content;

        $task->save();

        return $task;
        //Esta función actualizará la tarea que hayamos seleccionado
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task = Task::destroy($request->id);
        return $task;
        //Esta función obtendra el id de la tarea que hayamos seleccionado y la borrará de nuestra BD
   
    }
}
