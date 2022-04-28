@extends('layout')
@section('pagename', 'startpage')
@section('title', 'japaneselearning')

@section('content')

<div class="rotate-tts cards">

	<div class="con">
		<div class="current-pick" style="margin-bottom: 5px;"></div>
		<div class="endless off" style="background: #777; cursor: pointer; padding: 5px; width: 200px; margin-bottom: 5px;">
			Endless: <span>off</span>
		</div>
		<div class="lesson-picker">
		</div>

		<div class="playpause pause">
			PLAY!
		</div>

		<div class=""></div>

		<div class="kanjicard card" style="">
			<div class="id" style="display: none;">1</div>
			<div class="timestamp" style="display: none;">1</div>
			<div class="points" style="display: none;">1</div>
			<div class="stackposition" style="display: none;">1</div>
			<div class="rank"  style="display: none;">0</div>
			<div class="kanji">
			</div>
			<div class="kana lesung">
				<div class="title">Kana</div>
				<div class="context"></div>
			</div>
			<div class="bedeutung">
				<div class="title">Bedeutung</div>
				<div class="context"></div>
			</div>


		</div>
	</div>
	<div class="result" style="margin-top: 30px;">
		<h1>Result</h1>

	</div>
</div>

<div class="datafetch" style="margin-top: 50px;">

		<script>
		words = [];
		allWords = [];

		</script>

	@foreach($kotobas as $kotoba)
		<script>
		console.log("{{$kotoba->kanji}}");

		if(typeof words[{{$kotoba->lesson}}] === 'undefined') {
			console.log("lesson: "+{{$kotoba->lesson}});
    // does not exist
		console.log('doesnt exist');
		words[{{$kotoba->lesson}}] = [];
		}
		else {
		    // does exist
				console.log("lesson: "+{{$kotoba->lesson}});
				console.log('exist');
		}

		var isActive = {{$kotoba->active}};
		if(isActive == 1) {
			words[{{$kotoba->lesson}}].push(@json($kotoba));
			allWords.push(@json($kotoba));
			console.log(isActive);

		}
		</script>
		@if($kotoba->active == 1)
		<div class="wordline remove-this {{$kotoba->id}}" style="">
			<div>{{$kotoba->lesson}}</div>
			<div>{{$kotoba->kanji}}</div>
			<div>{{$kotoba->kana}}</div>
			<div>{{$kotoba->bedeutung}}</div>

		</div>
		@endif
	@endforeach

</div>

@stop
