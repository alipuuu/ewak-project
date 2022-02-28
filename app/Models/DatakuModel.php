<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatakuModel extends Model
{
     public function allData()
    {
       return DB::table('dataku')->get();
    }

    public function addData($data)
    {
        DB::table('dataku')->insert($data);
    }

    public function editData($id , $data)
    {
        DB::table('dataku')
            ->where('id',$id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('dataku')
            ->where('id',$id)
            ->delete();
    }
    protected $table = 'dataku';
    protected $guarded = [];
}
