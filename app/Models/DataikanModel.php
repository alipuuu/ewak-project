<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataikanModel extends Model
{
     public function allData()
    {
       return DB::table('dataikan')->get();
    }

    public function addData($data)
    {
        DB::table('dataikan')->insert($data);
    }

    public function editData($id , $data)
    {
        DB::table('dataikan')
            ->where('id',$id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('dataikan')
            ->where('id',$id)
            ->delete();
    }
    protected $table = 'dataikan';
    protected $guarded = [];
}
