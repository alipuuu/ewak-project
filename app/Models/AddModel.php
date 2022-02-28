<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class AddModel extends Model
{
    public function allData()
    {
       return DB::table('ewaks')->get();
    }

    public function addData($id)
    {
        return DB::table('ewaks')->where('invoice', '$invoice')->first();
    }
    protected $table = 'ewaks';
}

