<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OlahanModel;
use App\Models\Ewak;

class AddController extends Controller
{
    public function __construct()
    {
        $this->OlahanModel = new OlahanModel();
    }

    public function index()
    {
        $olahan = Ewak::all();
        return view('v_kategori_olahan', compact('olahan'));
    }

    public function detail($id)
    {
        $olahan = Ewak::findOrFail($id);
        return view('v_detail', compact('olahan'));
    }

    public function add()
    {
        $olahan = Ewak::all();
        return view('v_add', compact('olahan'));
    }

    public function edit($id)
    {
        $olahan = Ewak::all($id);
        return view('v_edit', compact('olahan'));
    }
}
