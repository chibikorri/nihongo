<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Config;

class datahandler extends Controller
{


    /* KANJI FUNCTIONS*/
    public function dataOutputKanji() {

    	//gets DB entries for output
    	$kanjis = DB::table('kanjis')->get();


    	return view('datakanji', [
    		'kanjis' => $kanjis
    		]);

    }

    public function dataStoreKanji(){
    	//receives data input to store to database

    	// dd(request('kanji'));
    	$kanji = request('kanji');
    	$on = request('on_lesung');
    	$kun = request('kun_lesung');
    	$bedeutung = request('bedeutung');
    	$rank = request('rank');
    	$time = request('timestamp');
      $points = request('points');
      $ap = request('ap');
      $status = request('status');
      $lesson = request('lesson');

    	// dd(request()->all());

     	DB::table('kanjis')
		->updateOrInsert([
			"timestamp" => $time,
            "points" => $points,
			"kanji" => $kanji,
			"on_lesung" => $on,
			"kun_lesung" => $kun,
			"bedeutung" => $bedeutung,
			"rank" => $rank,
      "activepassive" => $ap,
      "status" => $status,
      "lesson" => $lesson
		 ]);

		return redirect('/datakanji');


    }
    public function kanjicardSuccess() {
        $data = request()->all();
        $newStamp = date('Ymd');
        $points = $data['newPoints'];
        $rank = $data['newRank'];
        $kanji = $data['kanjiID'];

        // dd($data);
        // echo 'points: '.$data['newPoints'].', rank: '.$data['newRank'].', id: '.$data['kanjiID'].', timestamp: '.$newStamp;



       DB::table('kanjis')
       ->where('id', $kanji)
        ->update([
        'points' => $points,
        'rank' => $rank,
        'timestamp' => $newStamp
       ]);


      // dd($data);
      // return redirect('/kanjicards');

    }
    public function kanjicardRelearn() {
        $data = request()->all();
        $newStamp = date('Ymd');
        $rank = $data['newRank'];
        $kanji = $data['kanjiID'];

        // dd($data);
        // echo 'points: '.$data['newPoints'].', rank: '.$data['newRank'].', id: '.$data['kanjiID'].', timestamp: '.$newStamp;



       DB::table('kanjis')
       ->where('id', $kanji)
        ->update([
        'rank' => $rank,
        'timestamp' => $newStamp
       ]);

    }

    /* KOTOBA FUNCTIONS*/
    public function dataOutputKotoba() {

    	//gets DB entries for output
    	$kotobas = DB::table('kotobas')->get();


    	return view('datakotoba', [
    		'kotobas' => $kotobas
    		]);

    }

    public function dataStoreKotoba(){
    	//receives data input to store to database

    	// dd(request('kanji'));
    	$kanji = request('kanji');
      $kana = request('kana');
    	$bedeutung = request('bedeutung');
    	$rank = request('rank');
    	$time = request('timestamp');
      $points = request('points');
      $active = request('active');
        $status = request('status');
      $lesson = request('lesson');

    	// dd(request()->all());

      //check if lesson exists
      $checkConfig = DB::table('config')
      ->where('lesson', $lesson)
      ->get();

      if(!isset($checkConfig[0])) {
          DB::table('config')
          ->updateOrInsert([
            "status" => $status,
            "lesson" => $lesson,
          ]);

      }





     	DB::table('kotobas')
		->updateOrInsert([
			"timestamp" => $time,
      "points" => $points,
			"kanji" => $kanji,
      "kana" => $kana,
			"bedeutung" => $bedeutung,
			"rank" => $rank,
      "active" => $active,
        "status" => $status,
      "lesson" => $lesson,
      "dictoccur" => 1,
		 ]);

		return redirect('/datakotoba');


    }
    public function kotobacardSuccess() {
        $data = request()->all();
        $newStamp = date('Ymd');
        $points = $data['newPoints'];
        $rank = $data['newRank'];
        $kanji = $data['kanjiID'];

        // dd($data);
        // echo 'points: '.$data['newPoints'].', rank: '.$data['newRank'].', id: '.$data['kanjiID'].', timestamp: '.$newStamp;



       DB::table('kotobas')
       ->where('id', $kanji)
        ->update([
        'points' => $points,
        'rank' => $rank,
        'timestamp' => $newStamp
       ]);


      // dd($data);
      // return redirect('/kanjicards');

    }
    public function kotobacardRelearn() {
        $data = request()->all();
        $newStamp = date('Ymd');
        $rank = $data['newRank'];
        $kanji = $data['kanjiID'];

        // dd($data);
        // echo 'points: '.$data['newPoints'].', rank: '.$data['newRank'].', id: '.$data['kanjiID'].', timestamp: '.$newStamp;



       DB::table('kotobas')
       ->where('id', $kanji)
        ->update([
        'rank' => $rank,
        'timestamp' => $newStamp
       ]);

    }
    public function pointchange() {
        $data = request()->all();
        $points = $data['newPoints'];
        $kanji = $data['kanjiID'];

        // dd($data);
        // echo 'points: '.$data['newPoints'].', rank: '.$data['newRank'].', id: '.$data['kanjiID'].', timestamp: '.$newStamp;



       DB::table('kotobas')
       ->where('id', $kanji)
        ->update([
        'points' => $points
       ]);


      // dd($data);
      // return redirect('/kanjicards');

    }

    public function kanjistatus() {
      $data = request()->all();
      $status = $data['status'];
      $kanji = $data['kanjiID'];

      // dd($data);
      // echo 'points: '.$data['newPoints'].', rank: '.$data['newRank'].', id: '.$data['kanjiID'].', timestamp: '.$newStamp;



     DB::table('kanjis')
     ->where('id', $kanji)
      ->update([
      'status' => $status
     ]);


    // dd($data);
    // return redirect('/kanjicards');

    }
    public function kotobaoccur() {
      $data = request()->all();
      $newOccur = $data['newOccur'];
      $kotobaID = $data['kotobaID'];

      // dd($data);
      // echo 'points: '.$data['newPoints'].', rank: '.$data['newRank'].', id: '.$data['kanjiID'].', timestamp: '.$newStamp;



     DB::table('kotobas')
     ->where('id', $kotobaID)
      ->update([
      'dictoccur' => $newOccur
     ]);


    // dd($data);
    // return redirect('/kanjicards');

    }
    public function kotobastatus() {
      $data = request()->all();
      $rank = $data['rank'];
      $kotoba = $data['kotobaID'];

      // dd($data);
      // echo 'points: '.$data['newPoints'].', rank: '.$data['newRank'].', id: '.$data['kanjiID'].', timestamp: '.$newStamp;



     DB::table('kotobas')
     ->where('id', $kotoba)
      ->update([
      'rank' => $rank
     ]);


    // dd($data);
    // return redirect('/kanjicards');

    }

    public function lessonpick() {
      $data = request()->all();

      $lesson = $data['lessonpick'];
      $status = $data['status'];

      if($lesson != "All") {
        DB::table('config')
        ->where('lesson', "-1")
         ->update([
         'status' => 0
        ]);

        DB::table('config')
        ->where('lesson', $lesson)
         ->update([
         'status' => $status
        ]);
      }

      if($lesson == "All") {
        DB::table('config')
         ->update([
         'status' => 1
        ]);
      }
      if($lesson == "none") {
        DB::table('config')
         ->update([
         'status' => 0
        ]);
      }

      // dd($data);
      // echo 'points: '.$data['newPoints'].', rank: '.$data['newRank'].', id: '.$data['kanjiID'].', timestamp: '.$newStamp;



     DB::table('config')
     ->where('lesson', $lesson)
      ->update([
      'status' => $status
     ]);


    // dd($data);
    // return redirect('/kanjicards');

    }
}
