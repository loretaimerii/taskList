<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //qe me mujt me perdor factory duhet me pas qeta
    use HasFactory;

    protected $fillable = ['title','description','long_description'];

    // protected $guarded =['secret'];

    public function toggleComplete(){
         $this->completed = !$this->completed;
         $this->save();
    }

}
