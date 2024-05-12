<?php

namespace App\Http\Controllers;

use Akaunting\Apexcharts\Chart;
use App\Models\FoodNote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FoodNoteController extends Controller
{
    public function dashboard(){
        $data = FoodNote::where('customer_id', '=', Auth::user()->customer->_id)->get(['kalori']);
        $count = FoodNote::where('customer_id', '=', Auth::user()->customer->_id)->count();

        $QPagi = FoodNote::where('customer_id', '=', Auth::user()->customer->_id)->where('jadwal_makan', '=', 'pagi')->whereDate('tgl_note', '=', Carbon::now());
        $QSiang = FoodNote::where('customer_id', '=', Auth::user()->customer->_id)->where('jadwal_makan', '=', 'siang')->whereDate('tgl_note', '=', Carbon::now());
        $QMalam = FoodNote::where('customer_id', '=', Auth::user()->customer->_id)->where('jadwal_makan', '=', 'malam')->whereDate('tgl_note', '=', Carbon::now());
        $totalKal = FoodNote::where('customer_id', '=', Auth::user()->customer->_id)->whereDate('tgl_note', '=', Carbon::now())->sum('kalori');

        $startDate = Carbon::now()->subWeek(); 
        $endDate = Carbon::now(); 

        $foodEntries = FoodNote::whereBetween('tgl_note', [$startDate, $endDate])
            ->orderBy('tgl_note')
            ->get()
            ->groupBy(function ($entry) {
                return Carbon::parse($entry->tgl_note)->format('Y-m-d');
            });

        $caloriesByDate = [];
        foreach ($foodEntries as $date => $entries) {
            $caloriesByDate[Carbon::parse($date)->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y')] = $entries->sum('kalori');
        }
        $target_kalori = array_fill(0,count($caloriesByDate),Auth::user()->customer->getCalories());
        
        $dateLabel = [];
        foreach ($caloriesByDate as $key => $value) {
            array_push($dateLabel,$key);
        }

        $chart = (new Chart)->setType('line')
            ->setWidth('100%')
            ->setHeight(300)
            ->setTooltipFillSeriesColor(true)
            ->setColor('#4ECDC4')
            ->setStrokeColors(['#4ECDC4','#90EE7E'])
            ->setMarkersColors(['#4ECDC4','#90EE7E'])
            ->setTooltipTheme('dark')
            ->setYaxisMin(0)
            ->setYaxisTitle(['text' => 'Kalori (Kkal)'])
            ->setSubtitle('')
            ->setTooltipX(['show' => false])
            ->setSeries([
                [
                    'name' => 'Target Kalori',
                    'data' => $target_kalori
                ],
                [
                    'name' => 'Konsumsi Kalori',
                    'data' => array_values($caloriesByDate)
                ]
            ])
            ->setLabels($dateLabel);

        $chart2 = (new Chart)->setType('donut')
            ->setWidth('100%')
            ->setHeight(300)
            ->setSubtitle('')
            ->setDataLabelsEnabled(true)
            ->setLegendShow(true)
            ->setLegendPosition('bottom')
            ->setLabels(['Makan Pagi', 'Makan Siang', 'Makan Malam'])
            ->setDataset('Kalori (Kkal)', 'donut', [$QPagi->sum('kalori'), $QSiang->sum('kalori'), $QMalam->sum('kalori')]);

        return view('dashboard', compact('data', 'count', 'chart', 'chart2', 'totalKal'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tgl = $request->jadwal ?? Carbon::now()->format('Y-m-d');
        $customerId = Auth::user()->customer->id;
        $QPagi = FoodNote::where('jadwal_makan','=','pagi')->whereDate('tgl_note','=',$tgl)->where('customer_id','=',$customerId);
        $QSiang = FoodNote::where('jadwal_makan','=','siang')->whereDate('tgl_note','=',$tgl)->where('customer_id','=',$customerId);
        $QMalam = FoodNote::where('jadwal_makan','=','malam')->whereDate('tgl_note','=',$tgl)->where('customer_id','=',$customerId);
        $totalKal = FoodNote::whereDate('tgl_note','=',$tgl)->where('customer_id','=',$customerId)->sum('kalori');

        $makanPagi = $QPagi->get();
        $makanSiang = $QSiang->get();
        $makanMalam = $QMalam->get();


        $donutChart = (new Chart)->setType('donut')
        ->setWidth('100%')
        ->setHeight(300)
        ->setSubtitle('')
        ->setDataLabelsEnabled(true)
        ->setLegendShow(true)
        ->setLegendPosition('bottom')
        ->setLabels(['Makan Pagi','Makan Siang', 'Makan Malam'])
        ->setDataset('Kalori (Kkal)','donut',[$QPagi->sum('kalori'),$QSiang->sum('kalori'),$QMalam->sum('kalori')]);
        
        return view('foodnote.index',compact('donutChart','makanPagi','makanSiang','makanMalam','totalKal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $kategori = $request->kategori;
        $jadwal = Carbon::parse($request->jadwal)->format('m/d/Y');

        return view('foodnote.create',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_makanan' => 'required',
            'kalori' => 'required',
            'porsi' => 'required|numeric|min:1',
            'satuan' => 'required',
        ]);

        $data = [
            'customer_id' => Auth::user()->customer->id,
            'nama_makanan' => $request->nama_makanan,
            'kalori' => ($request->kalori * $request->porsi),
            'tgl_note' => Carbon::parse($request->tgl_note)->setTimezone(config('app.timezone')),
            'jadwal_makan' => $request->kategori,
            'qty' => $request->porsi . ' ' . $request->satuan
        ];

        FoodNote::create($data);
        return Redirect::route('foodnote.create',['kategori' => $request->kategori,'jadwal' => $request->tgl_note])->with('status', 'foodnote-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodNote $foodNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodNote $foodNote)
    {
        $kategori = $foodNote->jadwal_makan;
        $jadwal = $foodNote->tgl_note;
        $satuan = explode(' ', $foodNote->qty, 2)[1];
        $jmlh = strtok($foodNote->qty,' ');
        return view('foodnote.create',compact('foodNote','kategori','jadwal','jmlh','satuan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodNote $foodNote)
    {
        $request->validate([
            'nama_makanan' => 'required',
            'kalori' => 'required',
            'porsi' => 'required|numeric|min:1',
            'satuan' => 'required',
        ]);

        $data = [
            'nama_makanan' => $request->nama_makanan,
            'kalori' => ($request->kalori * $request->porsi),
            'qty' => $request->porsi . ' ' . $request->satuan
        ];

        $foodNote->update($data);

        return Redirect::route('foodnote.edit',['foodNote' => $foodNote->id])->with('status', 'foodnote-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodNote $foodNote)
    {
        if($foodNote){
            $tgl = Carbon::parse($foodNote->tgl_note)->format('Y-m-d');
            
            if($foodNote->delete()){
                return Redirect::route('foodnote.index',['jadwal' => $tgl])->with('status', 'foodnote-deleted');
            }
        }
        return Redirect::route('foodnote.index',['jadwal' => $tgl])->with('status', 'foodnote-delete-error');
    }
}
