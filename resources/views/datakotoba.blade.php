@extends('layout')
@section('pagename', 'startpage')
@section('title', 'japaneselearning')

@section('content')
@php

$timestamp = date('Ymd');

@endphp
<div class="kotoba-data data">
	<div class="con">
	<div class="add-new">
		<h2>Add New Word</h2>
		<form action="addkotoba" method="POST" class="data-form">
			<div>
				<span>Kanji</span>
				<input required type="text" value="" name="kanji" placeholder="kanji">
			</div>
			<div>
				<span>Kana</span>
				<input required type="text" value="" name="kana" placeholder="kana">
			</div>

			<div>
				<span>Bedeutung</span>
				<input required type="text" value="" name="bedeutung" placeholder="bedeutung">
			</div>
			<div>
				<span>Lektion</span>
				<input required type="text" value="13" name="lesson" placeholder="lesson">
			</div>
			<div class="ronly">
				<span>status</span>
				<input required type="number" value="1" name="active" readonly>
			</div>
			<div class="ronly">
				<span >Rank</span>
				<input  required type="number" value="0" name="rank" readonly>
			</div>
			<div class="ronly">
				<span >Points</span>
				<input  required type="number" value="1" name="points" readonly>
			</div>
			<div class="ronly" style="display:none;">
				<span >Status</span>
				<input  required type="number" value="1" name="status" readonly>
			</div>
			<div class="ronly">
				<span >Timestamp</span>
				<input  required type="text" value="{{$timestamp}}" name="timestamp" readonly>
			</div>
			<button>Add</button>
			@csrf
		</form>
	</div>
	<div class="database-mirror">
		<h2>Database Overview</h2>
		<div class="table">
			<div class="table-header id">ID</div>
			<div class="table-header kanji">KANJI</div>
			<div class="table-header kanji">KANA</div>
			<div class="table-header bedeutung">Bedeutung</div>
			<div class="table-header lesson">Lesson</div>
			<div class="table-header ap">status</div>
			<div class="table-header rank">Rank</div>
			<div class="table-header points">Points</div>
			<div class="table-header timestamp">Timestamp</div>

			<!-- output rows -->
			@foreach($kotobas as $kotoba)
			<div class="table-row id">{{ $kotoba->id }}</div>
			<div class="table-row kanji">{{ $kotoba->kanji }}</div>
			<div class="table-row kanji">{{ $kotoba->kana }}</div>
			<div class="table-row bedeutung">{{ $kotoba->bedeutung }}</div>
			<div class="table-row lesson">{{ $kotoba->lesson }}</div>
			<div class="table-row active">{{ $kotoba->active }}</div>
			<div class="table-row rank">{{ $kotoba->rank }}</div>
			<div class="table-row points">{{ $kotoba->points }}</div>
			<div class="table-row timestamp">{{ $kotoba->timestamp }}</div>
			@endforeach

		</div>
	</div>
	<div>
</div>

@stop
