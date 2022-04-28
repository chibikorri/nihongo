@extends('layout')
@section('pagename', 'startpage')
@section('title', 'japaneselearning')

@section('content')
 <form action="kanjicardsuccess" method="POST" class="data-form">
	<input required type="text" value="" name="kanji" placeholder="kanji">
	<input required type="text" value="" name="on_lesung" placeholder="on_lesung">
	<input required type="text" value="" name="kun_lesung" placeholder="kun_lesung">
	<input required type="text" value="" name="bedeutung" placeholder="bedeutung">			
	<input  required type="number" value="0" name="rank" readonly>
	<input  required type="number" value="0" name="points" readonly>
	<input  required type="text" value="{{$timestamp}}" name="timestamp" readonly>
	<button>Add</button>
	@csrf
</form>
  
@stop
