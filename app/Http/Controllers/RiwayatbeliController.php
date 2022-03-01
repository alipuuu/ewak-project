<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatbeliModel;
use App\Models\Riwayatbeli;
use Illuminate\Validation\ConditionalRules;
use Dompdf\Dompdf;

class RiwayatbeliController extends Controller
{
     public function __construct()
    {
        $this->RiwayatbeliModel = new RiwayatbeliModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $riwayatbeli = RiwayatbeliModel::all();
        return view('riwayatbeli.v_riwayatbeli', compact('riwayatbeli'));
    }

    public function add_riwayatbeli()
    {
        $riwayatbeli = RiwayatbeliModel::all();
        return view('riwayatbeli.v_add_riwayatbeli', compact('riwayatbeli'));
    }

    public function edit_riwayatbeli($id)
    {
        $riwayatbeli = RiwayatbeliModel::find($id);
        return view('riwayatbeli.v_edit_riwayatbeli', compact('riwayatbeli'));
    }

    public function insert_riwayatbeli(Request $request)
    {
        // RiwayatbeliModel::create($request->all());
        Request()->validate([
            'rekening_id' => 'required',
            'ikan_id' => 'required',
            'jumlah_beli' => 'required',
            'kwitansi' => 'required',
        ],[
            'rekening_id.required'=>' rekening id wajib diisi !!',
            'ikan_id.required' => 'ikan id wajib diisi !!',
            'jumlah_beli.required' => 'jumlah beli wajib diisi !!',
            'kwitansi.required' => 'kwitansi wajib diisi !!',
        ]);

        $riwayatbeli = [
            'rekening_id' => Request()->rekening_id,
            'ikan_id' => Request()->ikan_id,
            'jumlah_beli' => Request()->jumlah_beli,
            'kwitansi' => Request()->kwitansi,
        ];
        $this->RiwayatbeliModel->addData($riwayatbeli);
        return redirect()->route('riwayatbeli')->with('pesan', 'Data berhasil ditambahkan!');
    }

    public function update_riwayatbeli(Request $request)
    {
        $riwayatbeli = RiwayatbeliModel::find($request->id);
        // dd($request->all());
        $riwayatbeli->update($request->all());
        // Request()->validate([
        //     'rekening_id' => 'required',
        //     'ikan_id' => 'required',
        //     'jumlah_beli' => 'required',
        //     'kwitansi' => 'required',
        // ],[
        //     'rekening_id.required'=>' rekening id wajib diisi !!',
        //     'ikan_id.required' => 'ikan id wajib diisi !!',
        //     'jumlah_beli.required' => 'jumlah beli wajib diisi !!',
        //     'kwitansi.required' => 'kwitansi wajib diisi !!',
        // ]);
        // $this->RiwayatbeliModel->editData($riwayatbeli);
        return redirect()->route('riwayatbeli')->with('pesan', 'Data berhasil diupdate!');
    }

    public function delete_riwayatbeli($id)
    {
        $riwayatbeli = RiwayatbeliModel::find($id);
        $riwayatbeli->delete();
        return redirect()->route('riwayatbeli');
    }

    public function printer_riwayatbeli()
    {
        $riwayatbeli = RiwayatbeliModel::all();
        return view('riwayatbeli.v_printer_riwayatbeli', compact('riwayatbeli'));
    }

    public function printpdf_riwayatbeli()
    {
        $riwayatbeli = RiwayatbeliModel::all();
        $html = view('riwayatbeli.v_printpdf_riwayatbeli', compact('riwayatbeli'));

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
