@extends('layout')
@section('pagename', 'startpage')
@section('title', 'japaneselearning')

@section('content')
<script>
kanjilist = [];
kotobalist = [];
sentencelist = [];
</script>


<div class="nav module">
 <div class="con start">
 	<div class="links">
    <div class="section-title">Modules</div>
 		<a href="{{url('/kanjicards')}}">Kanji Cards</a>
    <a href="{{url('/kanjicardsactive')}}">Kanji Cards (Active)</a>
    <a href="{{url('/kanjicardspassive')}}">Kanji Cards (Passive)</a>
    <a href="{{url('/kotobacards')}}">Kotoba Cards</a>
    <a href="{{url('/rotate_tts')}}">Rotate TTS</a>
 	</div>
</div>
</div>
<div class="nav data-modules">
 <div class="con start">
 	<div class="links">
    <div class="section-title">Database</div>
 		<a href="{{url('/datakanji')}}">Kanjis</a>
    <a href="{{url('/datakotoba')}}">Kotobas</a>

 	</div>
 </div>
</div>

<div class="con filter">
  <div class="inner">
    <div class="">Filter: </div>
    @if($activeLesson != "1")
      <div class="lesson-button All on">All</div>
    @else
      <div class="lesson-button All">All</div>
    @endif
    <div> ||| </div>
  @foreach($config as $lesson)
  @if($lesson->status == 1 && $lesson->lesson != "All" && $activeLesson == "0")
    <div class="lesson-button {{$lesson->lesson}} on">{{$lesson->lesson}}</div>
  @elseif($lesson->lesson != "All")
    <div class="lesson-button {{$lesson->lesson}}">{{$lesson->lesson}}</div>
  @endif
  @endforeach
  </div>
</div>

 <div class="con frontpage">
   <div class=kanji-front>
     <div class="headline">漢字</div>
     <div class="aktiv">
       <div class="title">
         <div class="category">Aktiv</div>
         <div class="controls">
           <div class="show true">T</div>
           <div class="show false">F</div>
           <div class="show all">A</div>
         </div>


       </div>
       <div class="view">
         @foreach($kanjis as $kanji)
          @if(in_array($kanji->lesson, $configArray))
           <script>
           console.log("{{$kanji->kanji}}");

           if(typeof kanjilist[{{$kanji->id}}] === 'undefined') {
           kanjilist[{{$kanji->id}}] = [];
           }
           else {
               console.log('exist');
           }

           </script>
           @if ($kanji->activepassive == "active" && $kanji->status == 1)
           <div class="port true {{$kanji->id}}">{{$kanji->kanji}}</div>
           @elseif ($kanji->activepassive == "active" )
             <div class="port false {{$kanji->id}}" style="display: none;">{{$kanji->kanji}}</div>

           @endif

        @endif
         @endforeach
         <!-- <div class="port">1</div>
         <div class="port">2</div>
         <div class="port">3</div>
         <div class="port">4</div>
         <div class="port">5</div> -->
       </div>
     </div>
     <div class="passiv">
       <div class="title">
         <div class="category">Passiv</div>
         <div class="controls">
           <div class="show true">T</div>
           <div class="show false">F</div>
           <div class="show all">A</div>
         </div>


       </div>
       <div class="view">
         @foreach($kanjis as $kanji)
             @if(in_array($kanji->lesson, $configArray))
           <script>
           console.log("{{$kanji->kanji}}");

           if(typeof kanjilist[{{$kanji->id}}] === 'undefined') {
           kanjilist[{{$kanji->id}}] = [];
           }
           else {
               console.log('exist');
           }

           </script>
           @if ($kanji->activepassive == "passive" && $kanji->status == 1)
           <div class="port true {{$kanji->id}}">{{$kanji->kanji}}</div>
           @elseif ($kanji->activepassive == "passive" )
             <div class="port false {{$kanji->id}}" style="display: none;">{{$kanji->kanji}}</div>

           @endif
           @endif

         @endforeach
         <!-- <div class="port">1</div>
         <div class="port">2</div>
         <div class="port">3</div>
         <div class="port">4</div>
         <div class="port">5</div> -->
       </div>
     </div>

   </div>
   <div class="kotoba-front">
     <div class="headline">
       <div class="hl">言葉</div>
       <div class="dictate-mode">
         <div>Dictate Mode</div>
         <div class="mode-button">ALL</div>
         <div class="mode-button active">active</div>
         <div class="mode-button">inactive</div>
       </div>
       <div class="manual-mode">
         <div>Manual pick</div>
         <div class="mode-button">ALL</div>
         <div class="mode-button active">active</div>
         <div class="mode-button">inactive</div>
       </div>
       <div class="ui">
         <div class="playstop stop">start</div>

         <!-- <div class="shuffle on">shuffle on</div> -->
         <!-- <input type="number" value="10"> -->
         <div class="show true">T</div>
         <div class="show false">F</div>
         <div class="show all">A</div>
       </div>
     </div>
     <div class="view">
       <div class="dictateitems">
         <div class="hl">Dictate</div>
      </div>


       <div class="listitems">
         <div class="hl">List</div>
       @foreach($kotobas as $kotoba)
          @if(in_array($kotoba->lesson, $configArray))
        @php
        //$shuffle = rand(1,3);
        $shuffle = 1;
        @endphp
         <script>


         if(typeof kotobalist[{{$kotoba->id}}] === 'undefined') {
         kotobalist[{{$kanji->id}}] = [];
         }
         else {
             console.log('exist');
         }

         </script>

         @if ($kotoba->status == 1)
           <div class="port true {{$kotoba->id}}">
         @else
           <div class="port false {{$kotoba->id}}" style="display: none;">
         @endif
          <div class="swap">Swap</div>
           @if($shuffle == 1)
           <div class="visib f30 kanji">{{$kotoba->kanji}}</div>
           <div class="hidden">
             <div class="inner">
               <div class="tts kana">{{$kotoba->kana}}</div>
               <div class="meaning">{{$kotoba->bedeutung}}</div>
             </div>

           </div>

           @elseif($shuffle == 2)
           <div class="visib tts kana">{{$kotoba->kana}}</div>
           <div class="hidden">
             <div class="inner">
               <div class="f30 kanji">{{$kotoba->kanji}}</div>
               <div class="meaning">{{$kotoba->bedeutung}}</div>
             </div>

           </div>
           @elseif($shuffle == 3)
           <div class="visib meaning">{{$kotoba->bedeutung}}</div>
           <div class="hidden">
             <div class="inner">
               <div class="f30 kanji">{{$kotoba->kanji}}</div>
               <div class="tts kana">{{$kotoba->kana}}</div>
             </div>

           </div>
           @endif
         </div>

         @endif
       @endforeach
       </div>
     </div>
   </div>
   <div class="sentences-front">
      <div class="headline">
        <div class="hl">文章</div>
        <div class="ui">
         <div class="playstop stop">start</div>
         <!-- <div class="shuffle on">shuffle on</div> -->
         <!-- <input type="number" value="10"> -->
         <div class="show true">T</div>
         <div class="show false">F</div>
         <div class="show all">A</div>
       </div>
   </div>
     <div class="view">
       @foreach($sentences as $sentence)
        @if(in_array($sentence->lesson, $configArray))
         <script>


         if(typeof sentencelist[{{$sentence->id}}] === 'undefined') {
         sentencelist[{{$sentence->id}}] = [];
         }
         else {
             console.log('exist');
         }

         </script>
         @if ($sentence->status == 1)
           <div class="port tts true">
         @else
           <div class="port tts false">
         @endif
           {{$sentence->sentence}}
         </div>

         @endif
       @endforeach
     </div>
   </div>
 </div>




@stop
