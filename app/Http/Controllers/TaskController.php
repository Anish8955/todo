<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Auth;
class TaskController extends Controller
{
    public function store(Request $request){
      
      
        $request->validate([
        
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'duedate'=>'required',
        ]);
        
        Task::create([

            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'user_id' => Auth::user()->id,
            'category_id' =>$request->categoryid,
            'due_date'  => $request->duedate,
        ]);

        return redirect()->route('mainpage')->with('success', 'Task added successfully!');
    
   }

   public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'priority' => 'required|in:low,medium,high',
        'due_date' => 'required|date',
        'categoryid' => 'required|exists:category,id',
    ]);

    $Task = Task::findOrFail($id);

    $Task->title = $validatedData['title'];
    $Task->description = $validatedData['description'];
    $Task->priority = $validatedData['priority'];
    $Task->due_date = $validatedData['due_date'];
    $Task->category_id = $validatedData['categoryid'];

    $Task->save();

    return redirect()->back()->with('success', 'Task updated successfully!');
}

   public function destroy($id){
     $Task=Task::findOrFail($id);
     
     $Task->delete();

     return redirect()->back()->with('success', 'Task deleted successfully!');
   }

}
