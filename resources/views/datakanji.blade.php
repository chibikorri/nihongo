@extends('layout')
@section('pagename', 'startpage')
@section('title', 'japaneselearning')

@section('content')
@php

$timestamp = date('Ymd');

@endphp
<div class="kanji-data data">
	<div class="con">
	<div class="add-new">
		<h2>Add New Kanji</h2>
		<form action="addkanji" method="POST" class="data-form">
			<div>
				<span>Kanji</span>
				<input required type="text" value="" name="kanji" placeholder="kanji">
			</div>
			<div>
				<span>On-Lesung (sinojapanisch)</span>
				<input required type="text" value="" name="on_lesung" placeholder="on_lesung">
			</div>
			<div>
				<span>Kun-Lesung (japanisch)</span>
				<input required type="text" value="" name="kun_lesung" placeholder="kun_lesung">
			</div>
			<div>
				<span>Bedeutung</span>
				<input required type="text" value="" name="bedeutung" placeholder="bedeutung">
			</div>
			<div>
				<span>active/passive</span>
				<input required type="text" value="" name="ap" placeholder="active/passive">
			</div>
			<div class="">
				<span >L</span>
				<input  required type="number" value="12" name="lesson">
			</div>
			<div class="ronly"  style="display:none;">
				<span >Rank</span>
				<input  required type="number" value="0" name="rank" readonly>
			</div>
			<div class="ronly" style="display:none;">
				<span >Points</span>
				<input  required type="number" value="0" name="points" readonly>
			</div>
			<div class="ronly" style="display:none;">
				<span >Status</span>
				<input  required type="number" value="1" name="status" readonly>
			</div>
			<div class="ronly"  style="display:none;">
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
			<div class="table-header lesson">Lesson</div>
			<div class="table-header kanji">KANJI</div>
			<div class="table-header on">ON-Lesung</div>
			<div class="table-header kun">Kun-Lesung</div>
			<div class="table-header bedeutung">Bedeutung</div>
			<div class="table-header ap">active/passive</div>
			<div class="table-header rank">Rank</div>
			<div class="table-header status">Status</div>
			<div class="table-header points">Points</div>
			<div class="table-header timestamp">Timestamp</div>

			<!-- output rows -->
			@foreach($kanjis as $kanji)
			<div class="table-row id">{{ $kanji->id }}</div>
			<div class="table-row lesson">{{ $kanji->lesson }}</div>
			<div class="table-row kanji">{{ $kanji->kanji }}</div>
			<div class="table-row on">{{ $kanji->on_lesung }}</div>
			<div class="table-row kun">{{ $kanji->kun_lesung }}</div>
			<div class="table-row bedeutung">{{ $kanji->bedeutung }}</div>
			<div class="table-row ap">{{ $kanji->activepassive }}</div>
			<div class="table-row rank">{{ $kanji->rank }}</div>
			<div class="table-row status">{{ $kanji->status }}</div>
			<div class="table-row points">{{ $kanji->points }}</div>
			<div class="table-row timestamp">{{ $kanji->timestamp }}</div>
			@endforeach

		</div>
	</div>
	<div>
</div>

@stop
