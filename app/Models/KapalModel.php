<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KapalModel extends Model
{
     public function allData()
    {
       return DB::table('kapal')->get();
    }

    public function addData($data)
    {
        DB::table('kapal')->insert($data);
    }

    public function editData($id , $data)
    {
        DB::table('kapal')
            ->where('id',$id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('kapal')
            ->where('id',$id)
            ->delete();
    }
    protected $table = 'kapal';
    protected $guarded = [];
    protected $fillable = ['source_id','pemilik_kapal','foto_kapal','crew','contact'];
}
