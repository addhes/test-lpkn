<?php

namespace App\Http\Controllers;

use App\Models\HasilPertandingan;
use App\Models\Pertandingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PertandinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($match_id = "")
    {
        $get_hasil = Pertandingan::with('hasil')->where('id',$match_id)->first();

        $pemenangIs = [];

        if($get_hasil->score_a > $get_hasil->score_c) {
            $pemenangIs = [
                'team '.$get_hasil->arsenal => $get_hasil->arsenal,
                'point '.$get_hasil->arsenal => $get_hasil->hasil->point_a,
               'messages' => 'Pemenang pertandingan sempak bola kepada '.$get_hasil->arsenal
            ] ;
        } elseif ($get_hasil->score_a == $get_hasil->score_c) {
            $pemenangIs = [
                'team '.$get_hasil->arsenal => $get_hasil->arsenal,
                'point '.$get_hasil->arsenal => $get_hasil->hasil->point_a,
                'team '.$get_hasil->chelsea => $get_hasil->chelsea,
                'point '.$get_hasil->chelsea => $get_hasil->hasil->point_c,
                'messages' => 'pertandingan smepak bola seri antara team  '.$get_hasil->arsenal . ' dan team ' . $get_hasil->chelsea
            ] ;
        } else {
            $pemenangIs = [
                'team '.$get_hasil->chelsea => $get_hasil->chelsea,
                'point '.$get_hasil->chelsea => $get_hasil->hasil->point_c,
                'messages' => 'Pemenang pertandingan sempak bola kepada '.$get_hasil->chelsea
            ] ;
        }

        return response()->json([
            'data' => $pemenangIs
        ],200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $data = $request->all();

        $validation = Validator::make($data,[
            'arsenal' => 'required',
            'score_a' => 'required',
            'chelsea' => 'required',
            'score_c' => 'required',
        ]);

        if($validation->fails()) {
            return response()->json([
               'status' => 'fail',
               'messages' => $validation->errors()->first(),
            ],422);
        }

        $input = [
          'arsenal' => $data['arsenal'],
          'score_a' => $data['score_a'],
          'chelsea' => $data['chelsea'],
          'score_c' => $data['score_c'],
        ];

        $success = Pertandingan::create($input);

        if($success->score_a > $success->score_c) {
            $input = [
                'match_id' => $success->id,
                'arsenal' => $success->arsenal,
                'point_a' => 3,
                'chelsea' => $success->chelsea,
                'point_c' => 0,
            ];
            HasilPertandingan::create($input);
        }else if($success->score_a == $success->score_c) {
            $input = [
                'match_id' => $success->id,
                'arsenal' => $success->arsenal,
                'point_a' => 1,
                'chelsea' => $success->chelsea,
                'point_c' => 1,
            ];
            HasilPertandingan::create($input);
        }

        return response()->json([
           'message' => 'success',
           'data' => $success
        ],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
