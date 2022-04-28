function rotateTTS() {
// console.log(words);
// console.log(allWords);

lessonWords = [];
backupWords = [];
dictateWords= [];
totalScore = 0; //also diceSize;
lowestScore = 9999999999; //set to very high
highestScore = 0;
dice = [];
roll = 10;
progress = 1;
rawDice = [];
endless = "off";





// words.forEach(setButtons);
//
// function setButtons(item) {
//   console.log(Object.keys(item));
// }
console.log(Object.keys(words));
words.forEach(function(value, key) {
		// console.log(key);
		$('.lesson-picker').append('<div class="lesson lesson-'+key+'">L.'+key+'</div>');
});
$('.lesson-picker').append('<div class="lesson lesson-all active">L.All</div>');
$('.current-pick').html('Current: All Words, All Lessons');
lessonWords = allWords;
if(endless == "off") {
	possibility(lessonWords, 0);
}
else {
	dictateWords = lessonWords;
}

// console.log(lessonWords);

function emptyDice(remSide) {
	dice.splice(dice.indexOf(remSide), 1);

	if(dice.indexOf(remSide) != -1) {
		emptyDice(remSide);
	}
	else {
		// console.log("index removed: "+remSide);
		// console.log(dice);
	}
}



function dictatePick(array, i) {
	rollrng = Math.floor(Math.random() * dice.length);
	// console.log("rolled: "+rollrng);
	dictateWords.push(array[dice[rollrng]]);
	emptyDice(dice[rollrng]);


	i++;
	if(i<=roll) {
		dictatePick(array, i);
	}
	else {
		console.log("dictate is");
		console.log(dictateWords);
	}
}

function addtoDice(rPoints, arrayIndex, j) {
	dice.push(arrayIndex);
	j++;

	if(j < reversePoints) {
			addtoDice(rPoints, arrayIndex, j);
	}
	else {

	}
}

function shuffleDice(og, i) {
	rng = Math.floor(Math.random() * og.length);
	// console.log("????");
	// console.log(og);
	// console.log(og.length);
	// console.log(rng);
	// console.log(og[rng]);
	rawDice.push(og[rng]);
	og.splice(rng, 0);
	i++;
	if(i < og.length) {
		shuffleDice(og, i);
	}
	else {
		dice = rawDice;
		// console.log("shuff dice: ");
		// console.log(dice);

	}


}


function distribution(array, i) {
	lowHighSum = parseInt(lowestScore)+parseInt(highestScore);
	reversePoints = Math.ceil((lowHighSum - parseInt(array[i].points))/lowestScore);

	addtoDice(reversePoints, i, 0);

	// console.log(array[i]);
	i++;
	if(i < array.length) {
		distribution(array, i);
	}
	else {
		// console.log(array);
		// console.log(lowHighSum);
		// console.log("dice");
		// console.log(dice);
		shuffleDice(dice, 0);

		dictatePick(array, 1);

	}




}

function possibility(array, i) {
		console.log("!");
		console.log(array[i]);
		console.log(i);


		totalScore += parseInt(array[i].points);

		if (array[i].points > highestScore) {
			highestScore = array[i].points;

		}
		if (array[i].points < lowestScore) {
			lowestScore = array[i].points;

		}
		i++;
		if(i < array.length) {
			possibility(array, i);
		}
		else {
			distribution(array, 0);
			// console.log("done");
			// console.log("tScore: "+totalScore);
			// console.log("hScore: "+highestScore);
			// console.log("lScore: "+lowestScore);
		}
}


$('.lesson').on('click', function() {
	totalScore = 0;
	lowestScore = 9999999999; //set to very high
	highestScore = 0;
	dice = [];
	dictateWords= [];
	roll = 10;
	progress = 1;
	rawDice = [];

		getLesson = $(this).attr('class').split(' ')[1].split('-')[1];
		if(getLesson == "all") {
			lessonWords = allWords;
			$('.current-pick').html('Current: All Words, All Lessons');

			if(endless == "off") {
				possibility(lessonWords, 0);
			}
			else {
				dictateWords = lessonWords;
			}

		}
		else {
			lessonWords = words[getLesson];
			$('.current-pick').html('Current: Words from Lesson '+getLesson);
			if(endless == "off") {
				possibility(lessonWords, 0);
			}
			else {
				dictateWords = lessonWords;
			}

		}

		// console.log(lessonWords);

});






	var synth = window.speechSynthesis;
	var voices = [];
	var speakerArray = [19, 20, 22, 24];

	function populateVoiceList() {
	  voices = synth.getVoices().sort(function (a, b) {
	      var aname = a.name.toUpperCase(), bname = b.name.toUpperCase();
	      if ( aname < bname ) return -1;
	      else if ( aname == bname ) return 0;
	      else return +1;
	  });
	}
		populateVoiceList();
		if (speechSynthesis.onvoiceschanged !== undefined) {
		  speechSynthesis.onvoiceschanged = populateVoiceList;
		}

		function speak(){
		    synth.speak(utterThis);
		}

	// console.log(words);


	function rotator() {
		rng = Math.floor(Math.random()*dictateWords.length);
		shuffler(dictateWords, rng);
		if(endless == "off") {
			backupWords.push(dictateWords[rng]);
			dictateWords.splice(rng, 1);
		}
		else {
			dictateWords = lessonWords;
		}


		if(dictateWords.length == 0) {
			dictateWords = backupWords;
			backupWords = [];
			stopRotator();
		}

		console.log(dictateWords.length+' - '+backupWords.length);
	}

	function stopRotator() {
	  clearInterval(myInterval);
	}

$('.endless').on('click', function() {
	if($(this).hasClass("off")) {
		endless = "on";
		$('.endless').removeClass('off').addClass("on");
		$('.endless span').html("on");
	}
	else {
		endless = "off";
		$('.endless').removeClass('on').addClass("off");
		$('.endless span').html("off");
	}

});
	$('.playpause').on('click', function() {
		if($(this).hasClass('pause')) {
			$(this).html("PAUSE");
			$(this).removeClass('pause').addClass('play');

			myInterval = setInterval(rotator, 10000);

		}
		else if($(this).hasClass('play')) {
			$(this).html("PLAY!");
			$(this).removeClass('play').addClass('pause');

			stopRotator();
		}
	});

	function yesSave() {
		// alert('add point');

		id = $(this).parent().find('.id').html();
		points = parseInt($(this).parent().find('.points').html()) + 1;
			token = $('meta[name="csrf-token"]').attr('content');

		$.ajax({
			url:"/pointchange",
		 	type: "post",
		 	data: {
				"_token": token,
				"newPoints": points,
				"kanjiID": id

			},
			cache: false,
			success: function(response) {
				console.log('success');
				console.log(response);
				$('form.id-'+id).hide();
			},
			error: function(response) {
				console.log('fail');
				console.log(response);
			}
		});
	}

	function noSave() {
		// alert('remove point');
		id = $(this).parent().find('.id').html();
		points = parseInt($(this).parent().find('.points').html()) - 1;
		if(points == 0) {
			points = 1;
		}
		else {
		}
		token = $('meta[name="csrf-token"]').attr('content');

	$.ajax({
		url:"/pointchange",
		type: "post",
		data: {
			"_token": token,
			"newPoints": points,
			"kanjiID": id

		},
		cache: false,
		success: function(response) {
			console.log('success');
			console.log(response);
			$('form.id-'+id).hide();
		},
		error: function(response) {
			console.log('fail');
			console.log(response);
		}
	});
	}


	function addEntry(entry) {
		if(endless == "off") {
			htmlstring = '<form class="entry id-'+entry.id+'">'+
			'<div class="num">'+progress+'</div>'+
			'<div class="points">'+entry.points+'</div>'+
			'<div class="id">'+entry.id+'</div>'+
			'<div class="kanji">'+entry.kanji+'</div>'+
			'<div class="kana">'+entry.kana+'</div>'+
			'<div class="bedeutung">'+entry.bedeutung+'</div>'+
			'<div class="right">yes</div>'+
			'<div class="wrong">no</div>'+
			'</form>';
			$('.result').append(htmlstring);
			$('form.id-'+entry.id).find('.right').on('click', yesSave);
			$('form.id-'+entry.id).find('.wrong').on('click', noSave);
			progress++;
		}

	}

	function shuffler(words, rng) {
		// shuffles and picks forst entry
		console.log(words[rng]);

		$('.kanjicard .id').html(words[rng].id);
		// $('.kanjicard .stackposition').html(subjectPick);
		// $('.kanjicard .timestamp').html(stack[subjectPick].timestamp);
		// $('.kanjicard .rank').html(stack[subjectPick].rank);
		// $('.kanjicard .points').html(stack[subjectPick].points);
		$('.kanjicard .kanji').html(words[rng].kanji);
		$('.kanjicard .kana .context').html(words[rng].kana);
		$('.kanjicard .bedeutung .context').html(words[rng].bedeutung);
		addEntry(words[rng]);

		//tts japanese
		word = new SpeechSynthesisUtterance(words[rng].kana);
		word.volume = 1;
		word.voice = voices[ 24 ];

		synth.speak(word);

		//tts bedeutung
		word = new SpeechSynthesisUtterance(words[rng].bedeutung);

		word.voice = voices[ 1 ];
		word.volume = 0.5;
		synth.speak(word);

		//tts japanese nochmal
		word = new SpeechSynthesisUtterance(words[rng].kana);
		word.volume = 1;
		word.voice = voices[ 24 ];

		synth.speak(word);

	}








}
