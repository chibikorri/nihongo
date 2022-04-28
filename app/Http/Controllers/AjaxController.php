<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Word;
use Redirect, Response;

class AjaxController extends Controller
{
    public function getData($id = 0){
    // get records from database
 
    if($id==0){
      $arr['data'] = Word::orderBy('id', 'asc')->get(); 
    }else{
      $arr['data'] = Word::where('id', $id)->first();
    }
    echo json_encode($arr);
    exit;
  }
}
