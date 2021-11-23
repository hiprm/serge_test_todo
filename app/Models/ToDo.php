<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ToDo extends Model
{
    protected $table = 'todo_table';

    protected $primaryKey = 'id';
    //public $timestamps = false;
    protected $fillable = ['id', 'user_id', 'todo', 'status', 'created_at', 'updated_at'];

    public static $rules = array
    (
        'todo' => 'required|unique:todo_table'
    );


}
