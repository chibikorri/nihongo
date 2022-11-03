@extends('layout')
@section('pagename', 'startpage')
@section('title', 'japaneselearning')

@section('content')

<div class="listening-practice">
	<div class="test">rgthetrhz</div>
	<script>
	videosources = [];
	</script>

	@foreach($videoList as $mainkey => $data)
		@foreach($data as $video)
		<script>
		videosources.push("{{$video}}");
		</script>
		@endforeach
	@endforeach
</div>

<script>
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var player;
var randomVideo;
randomVideo = videosources[Math.floor(Math.random()*videosources.length)];
console.log("?? "+randomVideo);
function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
    height: '360',
    width: '640',
		autoplay: "1",
		color: "white",
    videoId: randomVideo,
    events: {
      'onReady': onPlayerReady,
      'onStateChange': onPlayerStateChange
    }
  });
}

      function onPlayerReady(event) {
				//getVideoLength
				testVideo = player.getDuration();
				//subtract 120 seconds
				practiceDuration = parseInt(testVideo - 120);
				//set random Start Time
				startNode = Math.round(Math.random()*practiceDuration);
				//start player at startnode
				player.seekTo(startNode);
				console.log("video length: "+testVideo);
				console.log("practice dur: "+practiceDuration);
				console.log("startNode: "+startNode);
        event.target.playVideo();
      }

      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 120000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
				location.reload();
				//reload page for new video
      }

</script>

<div id="player"></div>

<div>
	<!-- <iframe id="player" type="text/html" class="video-con" width="560" height="315" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
</div>

<script>
console.log(videosources);
</script>


@stop
