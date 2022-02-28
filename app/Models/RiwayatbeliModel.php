<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RiwayatbeliModel extends Model
{
     public function allData()
    {
       return DB::table('riwayatbeli')->get();
    }

    public function addData($data)
    {
        DB::table('riwayatbeli')->insert($data);
    }

    public function editData($id , $data)
    {
        DB::table('riwayatbeli')
            ->where('id',$id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('riwayatbeli')
            ->where('id',$id)
            ->delete();
    }
    protected $table = 'riwayatbeli';
    protected $guarded = [];
}
