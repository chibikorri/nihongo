@extends('layout')
@section('pagename', 'startpage')
@section('title', 'japaneselearning')

@section('content')
<script>
activeKanjilist = [];
passiveKanjilist = [];
kotobalist = [];
sentencelist = [];
totalOccur = 0;
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
    <div class="lesson-button none">none</div>

    @if($activeLesson != 1)
      <div class="lesson-button All on">All</div>
    @else
      <div class="lesson-button All">All</div>
    @endif
    <div> ||| </div>
  @foreach($config as $lesson)
  @if($lesson->status == 1 && $lesson->lesson != "-1")
    <div class="lesson-button {{$lesson->lesson}} on">{{$lesson->content}}</div>
  @elseif($lesson->lesson != "-1")
    <div class="lesson-button {{$lesson->lesson}}">{{$lesson->content}}</div>
  @endif
  @endforeach
  </div>
</div>

<div class="con toggle-modes">
  <div class="inner">
    <div class="mode-buttons kanji-btn"> KANJIS</div>
    <div class="mode-buttons kotoba-btn active"> KOTOBAS</div>
    <div class="mode-buttons sentences-btn"> SENTENCES</div>
  </div>
</div>

 <div class="con frontpage">
   <div class="cBox kanji-front">
     <div class="headline">漢字</div>
     <div class="aktiv">
       <div class="title">
         <div class="category">Aktiv (<span class="counter"></span>)</div>
         <div class="controls">
           <div class="show true">T</div>
           <div class="show false">F</div>
           <div class="show all">A</div>
         </div>


       </div>
       <div class="view">
         @foreach($kanjis as $kanji)
         @if ($kanji->activepassive == "active" )
          <script>
           activeKanjilist.push("{{$kanji->kanji}}");
          </Script>
          @endif
          @if(in_array($kanji->lesson, $configArray))
           <script>
           console.log("{{$kanji->kanji}}");



           // if(typeof activeKanjilist[{{$kanji->id}}] === 'undefined') {
           //  activeKanjilist[{{$kanji->id}}] = [];
           //  activeKanjilist[{{$kanji->id}}].push("test") ;
           //  console.log("me not there");
           // }
           // else {
           //     console.log('exist');
           // }

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
     <script>
     $('.kanji-front .aktiv .category .counter').html(activeKanjilist.length);
     </script>
     <div class="passiv">
       <div class="title">
         <div class="category">Passiv (<span class="counter"></span>)</div>
         <div class="controls">
           <div class="show true">T</div>
           <div class="show false">F</div>
           <div class="show all">A</div>
         </div>


       </div>
       <div class="view">
         @foreach($kanjis as $kanji)
         @if ($kanji->activepassive == "passive" )
         <script>
         passiveKanjilist.push("{{$kanji->kanji}}");
         </script>

          @endif
             @if(in_array($kanji->lesson, $configArray))
           <script>
           console.log("{{$kanji->kanji}}");

           // function pkj_check(kjid) {
           //   if(typeof passiveKanjilist[kjid] === 'undefined') {
           //     passiveKanjilist[kjid] = [];
           //   }
           //   else {
           //     console.log({{$kanji->id}}+'pkj exist');
           //   }
           //
           // }
           // pkj_check({{$kanji->id}});


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
   <script>
   $('.kanji-front .passiv .category .counter').html(passiveKanjilist.length);
   </script>
   <script>
   $(function() {
     console.log(activeKanjilist);
     console.log(passiveKanjilist);

   });
   </script>
   <div class="cBox kotoba-front active">
     <div class="headline">
       <div class="hl">言葉 (<span class="curDictCount">0</span>)</div>
       <script>
       curDictCount = 0;
       </script>
       <div class="dictate-mode">
         <div>Dictate Mode</div>
         <div class="mode-button">ALL</div>
         <div class="mode-button active">Dict</div>
         <div class="mode-button">nonDict</div>
         <div class="german-enable disable">DE Off</div>
       </div>
       <div class="manual-mode">
         <div>Manual pick</div>
         <div class="mode-button">ALL</div>
         <div class="mode-button active">Dict</div>
         <div class="mode-button">nonDict</div>
       </div>
       <div class="ui">
         <div class="playstop stop">start</div>

         <!-- <div class="shuffle on">shuffle on</div> -->
         <!-- <input type="number" value="10"> -->
         <div class="show true">nonDict</div>
         <div class="show false">Dict</div>
         <div class="show disabled">Dis</div>
         <div class="show all">All</div>
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
           kotobalist[{{$kotoba->id}}] = [];
           totalOccur += {{$kotoba->dictoccur}} ;
           // console.log(kotobalist);
         }
         else {
           console.log('exists');
         }




         </script>

         @if ($kotoba->status == 1)
           <div class="port true enabled {{$kotoba->id}}">
             @php
             $add_remove = "Add";
             $enable_disable = "disabled";
             @endphp

         @elseif ($kotoba->status == 0)
           <div class="port false enabled {{$kotoba->id}}" style="display: none;">
             @php
             $add_remove = "Remove";
             $enable_disable = "disabled";
             @endphp
             <script>
             curDictCount++;
             </script>
        @elseif ($kotoba->status == 2)
          <div class="port false disabled {{$kotoba->id}}" style="display: none;">
            @php
            $add_remove = "Enable";
            $enable_disable = "enable";
            @endphp
         @endif
         <div class="swap-disable">
           <div class="origin">{{$kotoba->lesson}}</div>
           <div class="swap">{{$add_remove}}</div>
           <div class="disable">{{$enable_disable}}</div>
         </div>
           @if($shuffle == 1)

           <div class="visib f30 kanji">{{$kotoba->kanji}}</div>
           <script>
              fullstring = "{{$kotoba->kanji}}";
              rebuildString = "";
              // console.log(fullstring);
              for (var i = 0; i < fullstring.length; i++) {
                // console.log(fullstring.charAt(i));
                //check each character if activepassive
                singleKJ = fullstring.charAt(i);

                if(activeKanjilist.includes(singleKJ)) {
                  // console.log("YEP");
                  rebuildString += '<span style="background: #a60; color: white;">'+singleKJ+'</span>';
                }
                else {
                  rebuildString += '<span>'+singleKJ+'</span>';
                }
              }
              // console.log(rebuildString);
              $('.port.{{$kotoba->id}} .visib.f30.kanji').html(rebuildString);
           </script>
           <div class="hidden">
             <span style="display: none;" class="thisOccur">{{$kotoba->dictoccur}}</span>
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
   <div class="cBox sentences-front">
      <div class="headline">
        <div class="hl">文章</div>
        <div class="ui">
          <div class="rng-btn">Random Sentence</div>
         <div class="playstop stop">start</div>
         <!-- <div class="shuffle on">shuffle on</div> -->
         <!-- <input type="number" value="10"> -->
         <!-- <div class="show true">T</div> -->
         <!-- <div class="show false">F</div> -->
         <!-- <div class="show all">A</div> -->
       </div>
   </div>
     <div class="view">
       <div class="dictateitems">
         <div class="hl">Dictate</div>
      </div>
       <div class="hl">Overview</div>
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
           <div class="port tts true sentence-{{$sentence->id}}">
         @else
           <div class="port tts false sentence-{{$sentence->id}}">
         @endif
           <div class="kanji-sent">{{$sentence->sentence}}</div>
           <div style="display: none;" class="hira-sent">{{$sentence->hiragana}}</div>
         </div>
         <script>
            fullstring = " {{$sentence->sentence}}";
            rebuildString = "";
            // console.log(fullstring);
            for (var i = 0; i < fullstring.length; i++) {
              // console.log(fullstring.charAt(i));
              // //check each character if activepassive
             singleKJ = fullstring.charAt(i);

              if(activeKanjilist.includes(singleKJ)) {
                // console.log("YEP");
                rebuildString += '<span style="background: #a60; color: white;">'+singleKJ+'</span>';
              }
              else {
                rebuildString += '<span>'+singleKJ+'</span>';
              }
            }
            // console.log(rebuildString);
            $('.port.sentence-{{$sentence->id}} .kanji-sent').html(rebuildString);
         </script>

         @endif
       @endforeach
     </div>
   </div>
 </div>

 <script>
  console.log(totalOccur);
  $('.kotoba-front .curDictCount').html(curDictCount);
 </script>




@stop
