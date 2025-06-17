<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;

//routes
Route::get('/', function (){
    return redirect()->route('tasks.index');
})->name(name: 'tasks.index');

Route::get('/tasks', function ()  {
    return view('index',[
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

Route::view('/tasks/create','create')->name('tasks.create');

//to edit a task
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit',['task'=>$task]);

})->name('tasks.edit');

//me display one single task
Route::get('/tasks/{task}', function (Task $task) {
    return view('show',['task'=>$task]);
})->name('tasks.show');

Route::post('/tasks',function(TaskRequest $request) {
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show',['task'=>$task->id])
    ->with('success','Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}',function(Task $task, TaskRequest $request) {
    $task->update($request->validated());

    return redirect()->route('tasks.show',['task'=>$task->id])
    ->with('success','Task updated successfully!');
})->name('tasks.update');

//to delete a task
Route::delete('/tasks/{task}',function(Task $task){
    $task->delete();
    return redirect()->route('tasks.index')
    ->with('success','Task deleted successfully!');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete',function(Task $task){
    $task->toggleComplete();
    return redirect()->back()->with('success','Task updated successfully!');
})->name('tasks.toggle-complete');


// --------------

// Route::get('/tasks', function ()  {
//     return view('index',[
//         // mujm dmhth me ndertu query qeshtut po gjithe ne fund duhet get me pas
//         'tasks' => Task::latest()->where('completed',true)->get()

//     ]);
// })->name('tasks.index');

// Route::view('/tasks/create','create')->name('tasks.create');

// //to edit a task
// Route::get('/tasks/{id}/edit', function ($id) {
//     return view('edit',['task'=>Task::findOrFail($id)]);
// })->name('tasks.edit');

// //me display one single task
// Route::get('/tasks/{id}', function ($id) {
//     return view('show',['task'=>Task::findOrFail($id)]);
// })->name('tasks.show');

// Route::post('/tasks',function(Request $request) {
//     $data = $request->validate([
//         'title' => 'required|max:255',
//         'description' => 'required',
//         'long_description' => 'required'
//     ]);
//     $data = $request->validated();
//     $task = new Task;
//     $task->title = $data['title'];
//     $task->description = $data['description'];
//     $task->long_description = $data['long_description'];
//     $task->save();
//     return redirect()->route('tasks.show',['id'=>$task->id])
//     ->with('success','Task created successfully!');
// })->name('tasks.store');

// Route::put('/tasks/{id}',function($id, TaskRequest $request) {
//     $data = $request->validate([
//         'title' => 'required|max:255',
//         'description' => 'required',
//         'long_description' => 'required'
//     ]);
//     $task = Task::findOrFail($id);
//     $data = $request->validated();
//     $task->title = $data['title'];
//     $task->description = $data['description'];
//     $task->long_description = $data['long_description'];
//     $task->save();
//     return redirect()->route('tasks.show',['id'=>$task->id])
//     ->with('success','Task updated successfully!');
// })->name('tasks.update');

// ----------------------------------------------------------------------------------------
//the task class
// class Task
// {
//     public function __construct(
//         public int $id,
//         public string $title,
//         public string $description,
//         public ?string $long_description,
//         public bool $completed,
//         public string $created_at,
//         public string $updated_at
//     ) {
//     }
// }

// $tasks = [
//     new Task(
//         1,
//         'Buy groceries',
//         'Task 1 description',
//         'Task 1 long description',
//         false,
//         '2023-03-01 12:00:00',
//         '2023-03-01 12:00:00'
//     ),
//     new Task(
//         2,
//         'Sell old stuff',
//         'Task 2 description',
//         null,
//         false,
//         '2023-03-02 12:00:00',
//         '2023-03-02 12:00:00'
//     ),
//     new Task(
//         3,
//         'Learn programming',
//         'Task 3 description',
//         'Task 3 long description',
//         true,
//         '2023-03-03 12:00:00',
//         '2023-03-03 12:00:00'
//     ),
//     new Task(
//         4,
//         'Take dogs for a walk',
//         'Task 4 description',
//         null,
//         false,
//         '2023-03-04 12:00:00',
//         '2023-03-04 12:00:00'
//     ),
// ];

// Route::get('/', function (){
//     // return 'Main Page';
//     // return view('index');
//     //mujna me pass data te qajo blade specifike psh qeshtut
//     // return view('index',[
//     //     // 'name'=>'loreta'
//     // ]);
//     return redirect()->route('tasks.index');
// })->name(name: 'tasks.index');

// Route::get('/tasks', function () use ($tasks) {
//     return view('index',[
//         'tasks' => $tasks
//     ]);
// })->name('tasks.index');

// //me display one single task me kto tdhanat qwtu qe jan ma nalt qajo array
// Route::get('/tasks/{id}', function ($id) use ($tasks){
//     //qekjo collect e kthen array ne nje collection, qe me mujt me ja perdor metodat tani
//     //me kerku psh a ekziston qaj task me qat id, me shtu e etc
//     $task = collect($tasks)->firstWhere('id', $id);

//     if(!$task){
//         abort(Response::HTTP_NOT_FOUND);
//     }
//     return view('show',['task'=>$task]);
// })->name('tasks.show');



// ---------------------------------
// first exercises
// Route::get('/xxxx', function(){
//     return 'Hello';
// })->name('hello');

// // nje route me parametra, edhe based on these parametres me return different personalzied response
// Route::get('/greet/{name}', function($name){
//     return 'Hello '. $name.'!';
// });

// //to redirect from one route to another, for example from and old one to go to the new one
// Route::get('/hallo', function(){
//     //qeshtut me ba redirect nese ska name qaj route
//    // return redirect('/hello');
//     //otherwise e ban qeshtut
//     return redirect()->route('hello');
// });

//fallback route, a route that will be called when no other route is matched
Route::fallback(function(){
    return 'Still got somewhere.';
});
