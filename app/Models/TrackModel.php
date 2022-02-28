<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrackModel extends Model
{
    public function allData()
    {
       return DB::table('track')->get();
    }

    public function addData($data)
    {
        DB::table('track')->insert($data);
    }

    public function editData($id , $data)
    {
        DB::table('track')
            ->where('id',$id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('track')
            ->where('id',$id)
            ->delete();
    }
    protected $table = 'track';
    protected $fillable = ['source_id','dest_id','crew','lat','longitude','received','message'];
}
