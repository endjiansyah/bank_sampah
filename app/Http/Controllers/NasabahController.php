<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Tabungan;
use Illuminate\Http\Request;

class NasabahController extends Controller
{
    function index()
    {
        $nasabah = Nasabah::query()->get();

        return response()->json([
            "status" => true,
            "message" => "mbuh opo iki",
            "data" => $nasabah
        ]);
    }
    function show($id)
    {
        $nasabah = Nasabah::query()
            ->where("id", $id)
            ->first();
            $tabungan = Tabungan::query()
            ->get()
            ->where("id_nasabah", $id);

        if (!isset($nasabah)) {
            redirect()->back();
        }

        return response()->json([
            "status" => true,
            "message" => "mbuh opo iki",
            "data" => [
                'nasabah' => $nasabah,
                'tabungan' => $tabungan
                ]
        ]);
    }


    function store(Request $request)
    {
        $payload = $request->all();

        $nasabah = Nasabah::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "mbuh opo iki",
            "data" => $nasabah
        ]);
    }

    function nabung(Request $request, $id){
        $nasabah = Nasabah::query()
        ->where("id", $id)
        ->first();

        $payloadtabungan = [
            'id_nasabah' => $id,
            'sampah' => $request->input('sampah'),
            'debet' => $request->input('debet')
        ];
        

        $payloadnasabah = ['saldo' => $nasabah['saldo'] + $request->input('debet')];

        $tabungan = Tabungan::query()->create($payloadtabungan);
        $nasabah->fill($payloadnasabah);
        $nasabah->save();
        return response()->json([
            "status" => true,
            "message" => "mbuh opo iki",
            "data" => [
                'nasabah' => $nasabah,
                'tabungan' => $tabungan
                ]
        ]);
    }

    function ambil($id){
        $nasabah = Nasabah::query()
        ->where("id", $id)
        ->first();

        $payloadtabungan = [
            'id_nasabah' => $id,
            'kredit' => 500000
        ];

        if($nasabah['saldo'] < 500000){
            return response()->json([
                "status" => true,
                "message" => "DUITMU KURANG MAS",
                "data" => null
            ]);
        }
        $payloadnasabah = ['saldo' => $nasabah['saldo'] - 500000];

        $tabungan = Tabungan::query()->create($payloadtabungan);
        $nasabah->fill($payloadnasabah);
        $nasabah->save();
        return response()->json([
            "status" => true,
            "message" => "mbuh opo iki",
            "data" => [
                'nasabah' => $nasabah,
                'tabungan' => $tabungan
                ]
        ]);
    }

}
