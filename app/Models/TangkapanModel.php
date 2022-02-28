<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TangkapanModel extends Model
{
    public function allData()
    {
       return DB::table('tangkapan')->get();
    }

    public function addData($data)
    {
        DB::table('tangkapan')->insert($data);
    }

    public function editData($id , $data)
    {
        DB::table('tangkapan')
            ->where('id',$id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('tangkapan')
            ->where('id',$id)
            ->delete();
    }
    protected $table = 'tangkapan';
    protected $fillable = ['source_id','date','hasil_tangkapan'];
}
