<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KapalModel;
use App\Models\Kapal;
use Illuminate\Validation\ConditionalRules;
use Dompdf\Dompdf;
use Facade\FlareClient\Stacktrace\File;

class KapalController extends Controller
{
     public function __construct()
    {
        $this->KapalModel = new KapalModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $kapal = KapalModel::all();
        return view('kapal.v_kapal', compact('kapal'));
    }

    public function add_kapal()
    {
        $kapal = KapalModel::all();
        return view('kapal.v_kapal', compact('kapal'));
    }

    public function edit_kapal($id)
    {
        $kapal = KapalModel::find($id);
        return view('kapal.v_kapal', compact('kapal'));
    }

    public function insert_kapal(Request $request)
    {
        $kapal = new KapalModel;
        $kapal->source_id = $request->input('source_id');
        $kapal->pemilik_kapal = $request->input('pemilik_kapal');
        if($request->hasFile('foto_kapal'))
        {
            $file = $request->file('foto_kapal');
            $extention = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extention;
            $file->move('foto_kapal/',$fileName);
            $kapal->foto_kapal = $fileName;
        } else{
            return $request;
            $kapal->foto_kapal = '';
        }
        $kapal->crew = $request->input('crew');
        $kapal->contact = $request->input('contact');

        $kapal->save();
        return redirect()->back();
    }

    public function update_kapal(Request $request, $id)
    {
        $kapal = KapalModel::find($id);
        $kapal->source_id = $request->input('source_id');
        $kapal->pemilik_kapal = $request->input('pemilik_kapal');
        if($request->hasFile('foto_kapal'))
        {
            $file = $request->file('foto_kapal');
            $extention = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extention;
            $file->move('foto_kapal/',$fileName);
            $kapal->foto_kapal = $fileName;
        }
        $kapal->crew = $request->input('crew');
        $kapal->contact = $request->input('contact');

        $kapal->update();
        return redirect()->back();
    }

    public function delete_kapal($id)
    {
        $kapal = KapalModel::find($id);
        $kapal->delete();
        return redirect()->route('kapal');
    }

    public function printer_kapal()
    {
        $kapal = KapalModel::all();
        return view('kapal.v_printer_kapal', compact('kapal'));
    }

    public function printpdf_kapal()
    {
        $kapal = KapalModel::all();
        $html = view('kapal.v_printpdf_kapal', compact('kapal'));

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
