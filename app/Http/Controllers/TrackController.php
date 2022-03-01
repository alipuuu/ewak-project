<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrackModel;
use App\Models\Track;
use Illuminate\Validation\ConditionalRules;
use Dompdf\Dompdf;

class TrackController extends Controller
{
     public function __construct()
    {
        $this->TrackModel = new TrackModel();
        $this->middleware('auth');
    }

    public function index()
    {
        $track = TrackModel::all();
        //dd($track);
        return view('track.v_track', compact('track'));
    }

    public function add_track()
    {
        $track = TrackModel::all();
        return view('track.v_track', compact('track'));
    }

    public function edit_track($id)
    {
        $track = TrackModel::find($id);
        return view('track.v_track', compact('track'));
    }

    public function insert_track(Request $request)
    {
        // TrackModel::create($request->all());
        Request()->validate([
            'source_id' => 'required',
            'dest_id' => 'required',
            'crew' => 'required',
            'lat' => 'required',
            'longitude' => 'required',
            'received' => 'required',
            'message' => 'required',
        ],[
            'source_id.required'=>' source id wajib diisi !!',
            'dest_id.required' => 'dest id wajib diisi !!',
            'crew.required' => 'crew wajib diisi !!',
            'lat.required' => 'lat wajib diisi !!',
            'longitude.required' => 'longitude wajib diisi !!',
            'received.required' => 'received wajib diisi !!',
            'message.required' => 'message wajib diisi !!',
        ]);
        $track = [
            'source_id' => Request()->source_id,
            'dest_id' => Request()->dest_id,
            'crew' => Request()->crew,
            'lat' => Request()->lat,
            'longitude' => Request()->longitude,
            'received' => Request()->received,
            'message' => Request()->message,
        ];
        $this->TrackModel->addData($track);
        return redirect()->route('track')->with('pesan', 'Data berhasil ditambahkan!');
    }

    public function update_track(Request $request)
    {
        $track = TrackModel::find($request->id);
        // dd($request->all());
        $track->update($request->all());
        // Request()->validate([
        //     'source_id' => 'required',
        //     'dest_id' => 'required',
        //     'crew' => 'required',
        //     'lat' => 'required',
        //     'longitude' => 'required',
        //     'received' => 'required',
        //     'message' => 'required',
        // ],[
        //     'source_id.required'=>' source id wajib diisi !!',
        //     'dest_id.required' => 'dest id wajib diisi !!',
        //     'crew.required' => 'crew wajib diisi !!',
        //     'lat.required' => 'lat wajib diisi !!',
        //     'longitude.required' => 'longitude wajib diisi !!',
        //     'received.required' => 'received wajib diisi !!',
        //     'message.required' => 'message wajib diisi !!',
        // ]);
        //     $this->TrackModel->editData($track);
            return redirect()->route('track')->with('pesan', 'Data berhasil diupdate!');
    }

    public function delete_track($id)
    {
        $track = TrackModel::find($id);
        $track->delete();
        return redirect()->route('track');
    }

    public function printer_track()
    {
        $track = TrackModel::all();
        return view('track.v_printer_track', compact('track'));
    }

    public function printpdf_track()
    {
        $track = TrackModel::all();
        $html = view('track.v_printpdf_track', compact('track'));

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
