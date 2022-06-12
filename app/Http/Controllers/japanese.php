<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Config;

class japanese extends Controller
{
    public function kanjiList() {

      $configArray = array();
      $config = DB::table('config')
      ->orderBy('lesson')
      ->get();

      foreach($config as $value) {
        if($value->status == "1") {
          array_push($configArray, $value->lesson);
        }
      }

      // dd($configArray);

      $activeLesson = $config->first();
      $activeLesson = $activeLesson->status;

    	$kanjis = DB::table('kanjis')->get();
      $shuffleKanjis = $kanjis->shuffle();
      $shuffleKanjis->all();

      $kotobas = DB::table('kotobas')->get();
      $shuffleKotobas = $kotobas->shuffle();
      $shuffleKotobas->all();
      $sortkotoba = $kotobas->sortBy('kana');


      $sentences = DB::table('sentences')->get();
      $shuffleSentences = $sentences->shuffle();
      $shuffleSentences->all();

      $lessons = DB::table('kanjis')
      ->groupBy('lesson')
      ->get();

      // dd($activeLesson);









      // foreach ($kanjis as $kanji) {
      //   // code...
      //   if($kanji->id <= 47) {
      //     DB::table('kanjis')
      //     ->where('id', $kanji->id)
      //     ->update( [  'activepassive' => "active" ] );
      //   }
      //   else if ($kanji->id > 47) {
      //     DB::table('kanjis')
      //     ->where('id', $kanji->id)
      //     ->update( [  'activepassive' => "passive" ] );
      //   }
      // }


        return view('start', [
            'kanjis' => $shuffleKanjis,
            'kotobas' => $shuffleKotobas,
            'sentences' => $shuffleSentences,
            'lessons' => $lessons,
            'config' => $config,
            'activeLesson' =>   $activeLesson,
            "configArray" => $configArray,
            'sorted' => $sortkotoba,
            ]);


    }

    public function kanjicardsNormal() {

      $data = self::kanjiCards("");
      // dd($data);
      return view('kanjicards', [
        'kanjis' => $data[0],
        'todayIs' => $data[1]

      ]);






    }

    public function kanjicardsActive() {

      $data = self::kanjiCards("active");
      // dd($data);
      return view('kanjicards', [
    		'kanjis' => $data[0],
    		'todayIs' => $data[1]

    		]);
    }

    public function kanjicardsPassive() {

      $data = self::kanjiCards("passive");
      // dd($data);
      return view('kanjicards', [
    		'kanjis' => $data[0],
    		'todayIs' => $data[1]

    		]);
    }

    public function kanjiCards($mode ="") {
        // dd($mode);

        //load DB for ranking check
        $kanjis = DB::table('kanjis')->get();
        $getTime = date('Ymd');
        foreach($kanjis as $kanji) {
            $thisStamp = $kanji->timestamp;
            $thisRank = $kanji->rank;
            $newRank = $thisRank;
            $thisPoints = $kanji->points;
            $timeDiff = $getTime - $thisStamp;
        	// dd( $timeDiff);

            if($thisRank == 1) {
                if($timeDiff >=4) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 2) {
                if($timeDiff >=5) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 3) {
                if($timeDiff >=6) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 4) {
                if($timeDiff >=7) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 5) {
                if($timeDiff >=8) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 6) {
                if($timeDiff >=9) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 7) {
                if($timeDiff >=10) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 8) {
                if($timeDiff >=11) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 9) {
                $highrankTimeDiff = floor(($thisPoints/2)+1);
                if($timeDiff >= $highrankTimeDiff) {
                    $newRank = $thisRank-1;
                }

            }


            //DBupdate
            if($thisRank != $newRank) {
                DB::table('kanjis')
               ->where('timestamp', $thisStamp)
                ->update([
                'rank' => $newRank
               ]);
            }
            else {
                // dd('nothing to update');
            }
        }

        if($mode == "") {
          //load DB again to mirror rank changes
          $kanjis = DB::table('kanjis')
          ->get();

        }
        else {
          $kanjis = DB::table('kanjis')
          ->where('activepassive', $mode)
          ->get();
        }

        return [$kanjis, $getTime];




    	// return view('kanjicards', [
    	// 	'kanjis' => $kanjis,
    	// 	'todayIs' => $getTime
      //
    	// 	]);
    }
    public function kotobaCards() {
        // dd($mode);

        //load DB for ranking check
        $kotobas = DB::table('kotobas')->get();
        $getTime = date('Ymd');
        foreach($kotobas as $kotoba) {
            $thisStamp = $kotoba->timestamp;
            $thisRank = $kotoba->rank;
            $newRank = $thisRank;
            $thisPoints = $kotoba->points;
            $timeDiff = $getTime - $thisStamp;
        	// dd( $timeDiff);

            if($thisRank == 1) {
                if($timeDiff >=4) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 2) {
                if($timeDiff >=5) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 3) {
                if($timeDiff >=6) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 4) {
                if($timeDiff >=7) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 5) {
                if($timeDiff >=8) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 6) {
                if($timeDiff >=9) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 7) {
                if($timeDiff >=10) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 8) {
                if($timeDiff >=11) {
                    $newRank = $thisRank-1;
                }

            } else
            if($thisRank == 9) {
                $highrankTimeDiff = floor(($thisPoints/2)+1);
                if($timeDiff >= $highrankTimeDiff) {
                    $newRank = $thisRank-1;
                }

            }


            //DBupdate
            if($thisRank != $newRank) {
                DB::table('kanjis')
               ->where('timestamp', $thisStamp)
                ->update([
                'rank' => $newRank
               ]);
            }
            else {
                // dd('nothing to update');
            }
        }


          //load DB again to mirror rank changes
          $kotobas = DB::table('kotobas')
          ->get();



          return view('kotobacards', [
        		'kotobas' => $kotobas,
        		'todayIs' => $getTime

        		]);




    	// return view('kanjicards', [
    	// 	'kanjis' => $kanjis,
    	// 	'todayIs' => $getTime
      //
    	// 	]);
    }

    public function rotateTTS() {
        // dd($mode);

        //load DB for ranking check
        $kotobas = DB::table('kotobas')->get();

          return view('rotate_tts', [
        		'kotobas' => $kotobas

        		]);

    }


}
