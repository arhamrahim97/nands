<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riwayatInfo = Riwayat::orderBy('id', 'DESC')->first();
        $rule = Rule::where('riwayat_id', $riwayatInfo->id ?? 0)->orderBy('confidence_persen', 'DESC')->get();
        $if = Rule::where('riwayat_id', $riwayatInfo->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('if')->toArray();
        $then = Rule::where('riwayat_id', $riwayatInfo->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('then')->toArray();
        $support = Rule::where('riwayat_id', $riwayatInfo->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('support_count')->toArray();
        $confidence = Rule::where('riwayat_id', $riwayatInfo->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('confidence_persen')->toArray();
        $liftRatio = Rule::where('riwayat_id', $riwayatInfo->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('lift_ratio')->toArray();
        $ifJSON = json_encode($if);
        $thenJSON = json_encode($then);
        $supportJSON = json_encode($support);
        $confidenceJSON = json_encode($confidence);
        $liftRatioJSON = json_encode($liftRatio);

        $data = [
            'title' => 'Riwayat',
            'rule' => $rule,
            'riwayat' => Riwayat::latest()->get(),
            'riwayatInfo' => $riwayatInfo,
            'if' => $ifJSON,
            'then' => $thenJSON,
            'support' => $supportJSON,
            'confidence' => $confidenceJSON,
            'liftRatio' => $liftRatioJSON,
        ];
        return view('riwayat', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getRiwayat(Request $request, Riwayat $riwayat)
    {
        $riwayatInfo = Riwayat::where('id', $riwayat->id)->first();
        $rule = Rule::where('riwayat_id', $riwayat->id)->orderBy('confidence_persen', 'desc')->get();
        $if = Rule::where('riwayat_id', $riwayat->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('if')->toArray();
        $then = Rule::where('riwayat_id', $riwayat->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('then')->toArray();
        $support = Rule::where('riwayat_id', $riwayat->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('support_count')->toArray();
        $confidence = Rule::where('riwayat_id', $riwayat->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('confidence_persen')->toArray();
        $liftRatio = Rule::where('riwayat_id', $riwayat->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('lift_ratio')->toArray();
        $ifJSON = json_encode($if);
        $thenJSON = json_encode($then);
        $supportJSON = json_encode($support);
        $confidenceJSON = json_encode($confidence);
        $liftRatioJSON = json_encode($liftRatio);

        $data = [
            'riwayatInfo' => $riwayatInfo,
            'rule' => $rule,
            'if' => $ifJSON,
            'then' => $thenJSON,
            'support' => $supportJSON,
            'confidence' => $confidenceJSON,
            'liftRatio' => $liftRatioJSON,
        ];

        return view("partials.riwayatHasil")->with($data)
            ->render();
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function show(Riwayat $riwayat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function edit(Riwayat $riwayat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Riwayat $riwayat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Riwayat $riwayat)
    {
        //
    }
}
