<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaldoModel;
use App\Models\Saldo;
use Illuminate\Validation\ConditionalRules;
use Dompdf\Dompdf;

class SaldoController extends Controller
{
      public function __construct()
    {
        $this->SaldoModel = new SaldoModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $saldo = SaldoModel::all();
        return view('saldo.v_saldo', compact('saldo'));
    }

    public function add_saldo()
    {
        $saldo = SaldoModel::all();
        return view('saldo.v_saldo', compact('saldo'));
    }

    public function edit_saldo($id)
    {
        $saldo = SaldoModel::find($id);
        return view('saldo.v_saldo', compact('saldo'));
    }

    public function insert_saldo(Request $request)
    {
        SaldoModel::create($request->all());
        Request()->validate([
            'id' => 'required',
            'pengguna' => 'required',
            'rekening_id' => 'required',
            'saldo' => 'required',
        ],[
            'id.required'=>' id saldo wajib diisi !!',
            'pengguna.required'=>' user wajib diisi !!',
            'rekening_id.required' => 'rekening_id wajib diisi !!',
            'saldo.required' => 'saldo wajib diisi !!',
        ]);
        $saldo = [
            'id' => Request()->id,
            'pengguna' => Request()->pengguna,
            'rekening_id' => Request()->rekening_id,
            'saldo' => Request()->saldo,
        ];
        $this->SaldoModel->addData($saldo);
        return redirect()->route('saldo');
    }

    public function update_saldo(Request $request, $id)
    {
        $saldo = SaldoModel::find($id);
        $saldo->update($request->all());
        Request()->validate([
            'id' => 'required',
            'pengguna' => 'required',
            'rekening_id' => 'required',
            'saldo' => 'required',
        ],[
            'id.required'=>' id saldo wajib diisi !!',
            'pengguna.required'=>' user wajib diisi !!',
            'rekening_id.required' => 'rekening_id wajib diisi !!',
            'saldo.required' => 'saldo wajib diisi !!',
        ]);
            $this->SaldoModel->editData($saldo);
        return redirect()->route('saldo');
    }

    public function delete_saldo($id)
    {
        $saldo = SaldoModel::find($id);
        $saldo->delete();
        return redirect()->route('saldo');
    }

    public function printer_saldo()
    {
        $saldo = SaldoModel::all();
        return view('saldo.v_printer_saldo', compact('saldo'));
    }

    public function printpdf_saldo()
    {
        $saldo = SaldoModel::all();
        $html = view('saldo.v_printpdf_saldo', compact('saldo'));

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
