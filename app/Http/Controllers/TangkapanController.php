<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TangkapanModel;
use App\Models\Tangkapan;
use Illuminate\Validation\ConditionalRules;
use Dompdf\Dompdf;

class TangkapanController extends Controller
{
    public function __construct()
    {
        $this->TangkapanModel = new TangkapanModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $tangkapan = TangkapanModel::all();
        return view('tangkapan.v_tangkapan', compact('tangkapan'));
    }

    public function add_tangkapan()
    {
        $tangkapan = TangkapanModel::all();
        return view('tangkapan.v_tangkapan', compact('tangkapan'));
    }

    public function edit_tangkapan($id)
    {
        $tangkapan = TangkapanModel::find($id);
        return view('tangkapan.v_tangkapan', compact('tangkapan'));
    }

    public function insert_tangkapan(Request $request)
    {
        TangkapanModel::create($request->all());
        Request()->validate([
            'id' => 'required',
            'source_id' => 'required',
            'date' => 'required',
            'hasil_tangkapan' => 'required',
        ],[
            'id.required'=>' id tangkapan wajib diisi !!',
            'source_id.required'=>' source id wajib diisi !!',
            'date.required' => 'tanggal wajib diisi !!',
            'hasil_tangkapan.required' => 'hasil tangkapan wajib diisi !!',
        ]);
        $tangkapan = [
            'id' => Request()->id,
            'source_id' => Request()->source_id,
            'date' => Request()->date,
            'hasil_tangkapan' => Request()->hasil_tangkapan,
        ];
        $this->TangkapanModel->addData($tangkapan);
        return redirect()->route('tangkapan');
    }

    public function update_tangkapan(Request $request, $id)
    {
        $tangkapan = TangkapanModel::find($id);
        $tangkapan->update($request->all());
        Request()->validate([
            'id' => 'required',
            'source_id' => 'required',
            'date' => 'required',
            'hasil_tangkapan' => 'required',
        ],[
            'id.required'=>' id tangkapan wajib diisi !!',
            'source_id.required'=>' source id wajib diisi !!',
            'date.required' => 'tanggal wajib diisi !!',
            'hasil_tangkapan.required' => 'hasil tangkapan wajib diisi !!',
        ]);

            $this->TangkapanModel->editData($tangkapan);
            return redirect()->route('tangkapan');
    }

    public function delete_tangkapan($id)
    {
        $tangkapan = TangkapanModel::find($id);
        $tangkapan->delete();
        return redirect()->route('tangkapan');
    }

    public function printer_tangkapan()
    {
        $tangkapan = TangkapanModel::all();
        return view('tangkapan.v_printer_tangkapan', compact('tangkapan'));
    }

    public function printpdf_tangkapan()
    {
        $tangkapan = TangkapanModel::all();
        $html = view('tangkapan.v_printpdf_tangkapan', compact('tangkapan'));

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
