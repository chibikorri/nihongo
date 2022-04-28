@extends('layout')
@section('pagename', 'startpage')
@section('title', 'japaneselearning')

@section('content')

<div class="kanjicards cards">
	<div class="today-timestamp" style="display:none;">{{$todayIs}}</div>
	<div class="con">
		<div class="stack-view">
			<div class="stack stack-0">
				<div class="icon"><img src="assets/img/stack.png"></div>
				<div class="counter"></div>
			</div>
			<div class="stack stack-1">
				<div class="icon"><img src="assets/img/stack.png"></div>
				<div class="counter"></div>
			</div>
			<div class="stack stack-2">
				<div class="icon"><img src="assets/img/stack.png"></div>
				<div class="counter"></div>
			</div>
			<div class="stack stack-3">
				<div class="icon"><img src="assets/img/stack.png"></div>
				<div class="counter"></div>
			</div>
			<div class="stack stack-4">
				<div class="icon"><img src="assets/img/stack.png"></div>
				<div class="counter"></div>
			</div>
			<div class="stack stack-5">
				<div class="icon"><img src="assets/img/stack.png"></div>
				<div class="counter"></div>
			</div>
			<div class="stack stack-6">
				<div class="icon"><img src="assets/img/stack.png"></div>
				<div class="counter"></div>
			</div>
			<div class="stack stack-7">
				<div class="icon"><img src="assets/img/stack.png"></div>
				<div class="counter"></div>
			</div>
			<div class="stack stack-8">
				<div class="icon"><img src="assets/img/stack.png"></div>
				<div class="counter"></div>
			</div>
			<div class="stack stack-9">
				<div class="icon"><img src="assets/img/stack.png"></div>
				<div class="counter"></div>
			</div>
		</div>
		<div class="kanjicard card" style="display:none;">
			<div class="id" style="display: none;">1</div>
			<div class="timestamp" style="display: none;">1</div>
			<div class="points" style="display: none;">1</div>
			<div class="stackposition" style="display: none;">1</div>
			<div class="rank"  style="display: none;">0</div>
			<div class="ap passive">aktiv</div>
			<div class="kanji">
				<div class="hidden">?</div>
				<div class="revealed" style="display: none;">私</div>
			</div>
			<div class="on lesung">
				<div class="title">On-Lesung</div>
				<div class="context">シ</div>
			</div>
			<div class="kun lesung">
				<div class="title">Kun-Lesung</div>
				<div class="context">わたし・わたくし</div>
			</div>
			<div class="bedeutung">
				<div class="title">Bedeutung</div>
				<div class="context">Ich selbst</div>
			</div>
			<div class="button reveal">Reveal</div>
			<div class="button check right">Got it!</div>
			<div class="button check wrong">Relearn</div>

		</div>
	</div>
</div>

<div class="datafetch">
	<div class="rank rank-0">
		<script>
		ranks = [];
		ranks[0] = [];
		ranks[1] = [];
		ranks[2] = [];
		ranks[3] = [];
		ranks[4] = [];
		ranks[5] = [];
		ranks[6] = [];
		ranks[7] = [];
		ranks[8] = [];
		ranks[9] = [];
		</script>

	@foreach($kanjis as $kanji)
		@if($kanji->rank == 0)
		<script>

		ranks[0].push(@json($kanji));

		</script>

		@endif
	@endforeach
	</div>
	<div class="rank rank-1">
		@foreach($kanjis as $kanji)
		@if($kanji->rank == 1)
		<script>

		ranks[1].push(@json($kanji));

		</script>

		@endif
	@endforeach
	</div>
	<div class="rank rank-2">
		@foreach($kanjis as $kanji)
		@if($kanji->rank == 2)
		<script>

		ranks[2].push(@json($kanji));

		</script>

		@endif
	@endforeach
	</div>
	<div class="rank rank-3">
		@foreach($kanjis as $kanji)
		@if($kanji->rank == 3)
		<script>

		ranks[3].push(@json($kanji));

		</script>

		@endif
	@endforeach
	</div>
	<div class="rank rank-4">
		@foreach($kanjis as $kanji)
		@if($kanji->rank == 4)
		<script>

		ranks[4].push(@json($kanji));

		</script>

		@endif
	@endforeach
	</div>
	<div class="rank rank-5">
		@foreach($kanjis as $kanji)
		@if($kanji->rank == 5)
		<script>

		ranks[5].push(@json($kanji));

		</script>

		@endif
	@endforeach
	</div>
	<div class="rank rank-6">
		@foreach($kanjis as $kanji)
		@if($kanji->rank == 6)
		<script>

		ranks[6].push(@json($kanji));

		</script>

		@endif
	@endforeach
	</div>
	<div class="rank rank-7">
		@foreach($kanjis as $kanji)
		@if($kanji->rank == 7)
		<script>

		ranks[7].push(@json($kanji));

		</script>

		@endif
	@endforeach
	</div>
	<div class="rank rank-8">
		@foreach($kanjis as $kanji)
		@if($kanji->rank == 5)
		<script>

		ranks[8].push(@json($kanji));

		</script>

		@endif
	@endforeach
	</div>
	<div class="rank rank-9">
		@foreach($kanjis as $kanji)
		@if($kanji->rank == 9)
		<script>

		ranks[9].push(@json($kanji));

		</script>

		@endif
	@endforeach
	</div>
</div>

@stop
