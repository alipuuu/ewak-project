<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataikanModel;
use App\Models\Dataikan;
use Illuminate\Validation\ConditionalRules;
use Dompdf\Dompdf;

use function GuzzleHttp\Promise\all;

class DataikanController extends Controller
{
     public function __construct()
    {
        $this->DataikanModel = new DataikanModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $dataikan = DataikanModel::all();
        //dd($dataikan);
        return view('dataikan.v_dataikan', compact('dataikan'));
    }

    public function add_dataikan()
    {
        $dataikan = DataikanModel::all();
        return view('dataikan.v_dataikan', compact('dataikan'));
    }

    public function edit_dataikan($id)
    {
        $dataikan = DataikanModel::find($id);
        return view('dataikan.v_dataikan', compact('dataikan'));
    }

    public function insert_dataikan(Request $request)
    {
        //DataikanModel::create($request->all());
        Request()->validate([
            'nama_ikan' => 'required',
            'jenis_ikan' => 'required',
            'harga_ikan' => 'required',
            'stock_ikan' => 'required',
        ],[
            'nama_ikan.required'=>' nama ikan wajib diisi !!',
            'jenis_ikan.required'=>' jenis ikan wajib diisi !!',
            'harga_ikan.required' => 'harga ikan wajib diisi !!',
            'stock_ikan.required' => 'stock ikan wajib diisi !!',
        ]);

        $dataikan = [
            'nama_ikan' => Request()->nama_ikan,
            'jenis_ikan' => Request()->jenis_ikan,
            'harga_ikan' => Request()->harga_ikan,
            'stock_ikan' => Request()->stock_ikan,
        ];
        $this->DataikanModel->addData($dataikan);
        return redirect()->route('dataikan')->with('pesan', 'Data berhasil ditambahkan!');
    }

    public function update_dataikan(Request $request)
    {
        $dataikan = DataikanModel::find($request->id);
        //dd($request->all());
        $dataikan->update($request->all());
        // Request()->validate([
        //     'nama_ikan' => 'required',
        //     'jenis_ikan' => 'required',
        //     'harga_ikan' => 'required',
        //     'stock_ikan' => 'required',
        // ],[
        //     'nama_ikan.required'=>' nama ikan wajib diisi !!',
        //     'jenis_ikan.required'=>' jenis ikan wajib diisi !!',
        //     'harga_ikan.required' => 'harga ikan wajib diisi !!',
        //     'stock_ikan.required' => 'stock ikan wajib diisi !!',
        // ]);
        // $this->DataikanModel->editData($dataikan);
        return redirect()->route('dataikan')->with('pesan', 'Data berhasil diupdate!');;
    }

    public function delete_dataikan($id)
    {
        $dataikan = DataikanModel::find($id);
        $dataikan->delete();
        return redirect()->route('dataikan');
    }

    public function printer_dataikan()
    {
        $dataikan = DataikanModel::all();
        return view('dataikan.v_printer_dataikan', compact('dataikan'));
    }

    public function printpdf_dataikan()
    {
        $dataikan = DataikanModel::all();
        $html = view('dataikan.v_printpdf_dataikan', compact('dataikan'));

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



