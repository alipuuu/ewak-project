<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SaldoModel extends Model
{
    public function allData()
    {
       return DB::table('saldo')->get();
    }

    public function addData($data)
    {
        DB::table('saldo')->insert($data);
    }

    public function editData($id , $data)
    {
        DB::table('saldo')
            ->where('id',$id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('saldo')
            ->where('id',$id)
            ->delete();
    }
    protected $table = 'saldo';
    protected $fillable = ['pengguna','rekening','saldo'];
}
