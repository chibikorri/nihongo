function frontPage() {

	//vars
	kotobashuffle = "on";
	sentenceshuffle = "on";

	//counter
	dictCount = 0;


	//tts functionality
	synth = window.speechSynthesis;
	voices = synth.getVoices();
	foundMain = 0;
	foundBK = 0;
	speaker = 0;
	sprecher = 0;
	timer = false;


	i = 0;

	var speakerArray = [19, 20, 22, 24];



	function populateVoiceList() {
	  voices = synth.getVoices().sort(function (a, b) {
	      var aname = a.name.toUpperCase(), bname = b.name.toUpperCase();
				if(a.name.toUpperCase().indexOf("SAYAKA") != -1) {
					console.log('found');
				}
	      if ( aname < bname ) return -1;
	      else if ( aname == bname ) return 0;
	      else return +1;
	  });
		console.log(voices);

		for(i = 0; i < voices.length; i++) {

			if(voices[i].name.indexOf("Sayaka") != -1) {
				console.log('found main');

				foundMain = i;
			} else if (voices[i].name.indexOf("Google 日本語") != -1) {
				console.log('found backup');
				foundBK = i;

			}
			if (voices[i].name.indexOf("Google Deutsch") != -1) {
				console.log("!!! "+i);
				sprecher = i;
			}


	  }

		if(foundMain > 0) {
				speaker = foundMain;
		}
		else if (foundBK > 0) {
				speaker = foundBK;
		}

	}
		populateVoiceList();

		if (speechSynthesis.onvoiceschanged !== undefined) {
		  speechSynthesis.onvoiceschanged = populateVoiceList;
		}



function speak(word, pitch, speaker) {

	console.log("! "+sprecher);
	theWord = new SpeechSynthesisUtterance(word);
	theWord.rate = pitch;
	theWord.volume = 1;
		// console.log(voices);
	theWord.voice = voices[ speaker ];


	synth.speak(theWord, 1);
}

//content-toggle
$('.toggle-modes .mode-buttons').on('click', function() {
	$('.toggle-modes .mode-buttons').removeClass('active');
	$(this).addClass('active');
	showContent = $(this).attr('class').split(" ")[1].split("-")[0];
	$('.cBox').hide();
	$('.'+showContent+'-front').show();

});

$('.controls .show').on('click', function() {
	thisClass = $(this).attr('class').split(" ")[1];
	thisParent = $(this).parent().parent().parent().attr('class');

	// alert(thisParent);

	if(thisClass == "all") {
		$("."+thisParent).find('.port').show();

	}
	else {
		if(thisClass == "true") {
			$("."+thisParent).find('.port.true').show();
			$("."+thisParent).find('.port.false').hide();

		}
		else {
			$("."+thisParent).find('.port.true').hide();
			$("."+thisParent).find('.port.false').show();
		}

	}

});

$('.kotoba-front .ui .show').on('click', function() {
	thisClass = $(this).attr('class').split(" ")[1];
	thisParent = $('.kotoba-front');

	// alert(thisParent);

	if(thisClass == "all") {
		thisParent.find('.port').show();

	}
	else {
		if(thisClass == "true") {
			thisParent.find('.port.true').show();
			thisParent.find('.port.false').hide();
			thisParent.find('.port.disabled').hide();

		}
		else if(thisClass == "false") {
			thisParent.find('.port.true').hide();
			thisParent.find('.port.false').show();
			thisParent.find('.port.disabled').hide();
		}
		else if(thisClass == "disabled") {
			thisParent.find('.port.true').hide();
			thisParent.find('.port.false').hide();
			thisParent.find('.port.disabled').show();
		}

	}

});

$('.kanji-front .port').mousedown(function(e) {

	    if (e.which === 1) {
        /* copy to clipboard */
				copy = $(this).html();
				navigator.clipboard.writeText(copy);



    	}
			if (e.which === 2) {
				getId = $(this).attr('class').split(" ")[2];
				getStatus = $(this).attr('class').split(" ")[1];
				token = $('meta[name="csrf-token"]').attr('content');
				if(getStatus == "true") {
					newStatus = 0;
					$(this).addClass("false").removeClass("true");

				}
				else if(getStatus == "false") {
					newStatus = 1;
					$(this).addClass("true").removeClass("false");
				}


				$.ajax({
					url:"/kanjistatus",
					type: "post",
					data: {
						"_token": token,
						"status": newStatus,
						"kanjiID": getId

					},
					cache: false,
					success: function(response) {
						console.log('success');
						console.log(response);
						// $('form.id-'+id).hide();
					},
					error: function(response) {
						console.log('fail');
						console.log(response);
					}
				});
    	}
});

// $('.kanji-front .port').on('click', function() {
//
//
//
//
// });

$('.lesson-button').on('click', function() {

	getLesson = $(this).attr('class').split(" ")[1];
	 if(getLesson == "-1") {
	 	getLesson = "All";
	 }
	//  alert(getLesson);
	if($(this).hasClass('on')) {
			getStatus = 0;
	}
	else {
		getStatus = 1;
	}
	// getStatus = $(this).attr('class').split(" ")[1];
	token = $('meta[name="csrf-token"]').attr('content');



	$.ajax({
		url:"/lessonpick",
		type: "post",
		data: {
			"_token": token,
			"status": getStatus,
			"lessonpick": getLesson

		},
		cache: false,
		success: function(response) {
			console.log('success');
			console.log(response);
			location.reload();
			// $('form.id-'+id).hide();
		},
		error: function(response) {
			console.log('fail');
			console.log(response);
		}
	});


});

function kotoMouseover(elem) {
	elem.find('.visib').hide();
	elem.find('.hidden').show();

}

function kotoMouseout(elem) {
	elem.find('.visib').show();
	elem.find('.hidden').hide();

}

$('.kotoba-front .port').on('mouseover', function() {
	kotoMouseover($(this));
});

$('.kotoba-front .port').on('mouseout', function() {
	kotoMouseout($(this));

});


$('.kotoba-front .port').mousedown(function(e) {

	    if (e.which === 1) {
        /* speak */
				speakthis = $(this).find('.tts').html();
				speak(speakthis, 1, speaker);
    	}
			if (e.which === 2) {
        /* remove */

    	}
});
// $('.kotoba-front .port').on('click', function() {
//
// 	//tts
//
//
// ;
//
//
// });


//active dictate / inactive dictate
$('.kotoba-front .port .swap').on('click', function() {
	getId = $(this).parent().parent().attr('class').split(" ")[2];
	getStatus = $(this).parent().parent().attr('class').split(" ")[1];
	token = $('meta[name="csrf-token"]').attr('content');
	if(getStatus == "true") {
		newStatus = 0;
		$(this).parent().parent().addClass("false").removeClass("true");
		  $('.kotoba-front .curDictCount').html(curDictCount);

	}
	else if(getStatus == "false") {
		newStatus = 1;
		$(this).parent().parent().addClass("true").removeClass("false");
		  $('.kotoba-front .curDictCount').html(curDictCount);
	}
	else if(getStatus == "disabled") {
		newStatus = 1;
		$(this).parent().parent().addClass("true").removeClass("false");
		 $('.kotoba-front .curDictCount').html(curDictCount);
	}


	$.ajax({
		url:"/kotobastatus",
		type: "post",
		data: {
			"_token": token,
			"status": newStatus,
			"kotobaID": getId

		},
		cache: false,
		success: function(response) {
			console.log('success');
			console.log(response);
			// $('form.id-'+id).hide();
		},
		error: function(response) {
			console.log('fail');
			console.log(response);
		}
	});
});

//disabled / enabled
$('.kotoba-front .port .disable').on('click', function() {
	getId = $(this).parent().parent().attr('class').split(" ")[2];
	getStatus = $(this).parent().parent().attr('class').split(" ")[1];
	token = $('meta[name="csrf-token"]').attr('content');
	if(getStatus == "disabled") {
		newStatus = 1;
		$(this).parent().parent().addClass("true").removeClass("false").removeClass("disabled");

	}
	else {
		newStatus = 2;
		$(this).parent().parent().removeClass("true").removeClass("false").addClass("disabled");
	}


	$.ajax({
		url:"/kotobastatus",
		type: "post",
		data: {
			"_token": token,
			"status": newStatus,
			"kotobaID": getId

		},
		cache: false,
		success: function(response) {
			console.log('success');
			console.log(response);
			// $('form.id-'+id).hide();
		},
		error: function(response) {
			console.log('fail');
			console.log(response);
		}
	});
});

$('.sentences-front .port').mousedown(function(e) {


	if (e.which === 1) {
		/* speak */
		speakthis = $(this).find('.hira-sent').html();
		speak(speakthis, 0.5, speaker);
	}
	if (e.which === 2) {
		/* remove */
	}




});

function pickRandom(kotobaElem_f, kotobaNum_f) {
	pickRand = Math.floor(Math.random()*kotobaNum_f);
	randWord = kotobaElem_f.eq(pickRand).find('.kana').html();
	randWordKanji = kotobaElem_f.eq(pickRand).find('.kanji').html();
	randwordMeaning = kotobaElem_f.eq(pickRand).find('.meaning').html();
	thisOccur = kotobaElem_f.eq(pickRand).find('.thisOccur').html();
	chance = 1-((totalOccur-thisOccur)/(totalOccur+thisOccur));
	thisOrigin = kotobaElem_f.eq(pickRand).find('.origin').html();
	elemState = kotobaElem_f.eq(pickRand).attr('class').split(" ")[1];
	elemID = kotobaElem_f.eq(pickRand).attr('class').split(" ")[3];
	switch(elemState) {
		case "true":
		quickSwap = "add";
		break;
		case "false":
		quickSwap = "remove";
		break;
		case "disabled":
		quickSwap = "add";
		break;
	}
	// chance = 1-((totalOccur-100)/(totalOccur+100));
	roll = Math.random();
	console.log(randWord);
	console.log("occur: "+chance+', roll: '+roll);


	if(roll<chance) {
		speak(randWord, 1, speaker);
		if($('.dictate-mode .german-enable').hasClass('enable')) {
			speak(randwordMeaning, 1, sprecher);
		}
		dictCount++;

		appendThis = '<div class="port dict-'+dictCount+' '+elemID+' dict-'+elemState+'">'+
		'<div class="quick-btn-con">'+
		'<div class="quick-btn '+quickSwap+'">'+quickSwap+'</div><div class="quick-btn disabler">Disable</div>'+
		'</div>'+
		'<div class="dictorigin">'+thisOrigin+'</div>'+
		'<div class="visib f30 kanji"><span class="dictcount">'+dictCount+'</span> '+randWordKanji+'</div>'+
		'<div class="hidden">'+
		'<div class="inner">'+
		'<div class="tts kana">'+randWord+'</div>'+
		'<div class="">'+randwordMeaning+'</div>'+
		'</div>'+
		'</div>'+
		'</div>';

		newOccur = parseInt(thisOccur)+1;
		console.log("new:"+ newOccur);
		getId = kotobaElem_f.eq(pickRand).attr('class').split(" ")[2] ;
		console.log("id "+getId);
		token = $('meta[name="csrf-token"]').attr('content');

		//add counter to database
		$.ajax({
			url:"/kotobaoccur",
			type: "post",
			data: {
				"_token": token,
				"newOccur": newOccur,
				"kotobaID": getId

			},
			cache: false,
			success: function(response) {
				console.log('success');
				console.log(response);
				kotobaElem_f.eq(pickRand).find('.thisOccur').html(newOccur);
				// $('form.id-'+id).hide();
			},
			error: function(response) {
				console.log('fail');
				console.log(response);
			}
		});


		$('.kotoba-front .dictateitems .hl').after(appendThis);
		$('.kotoba-front .port').on('mouseover', function() {
			kotoMouseover($(this));
		});

		$('.kotoba-front .port').on('mouseout', function() {
			kotoMouseout($(this));

		});
		$('.kotoba-front .port.dict-'+dictCount).on('click', function() {
			speak($(this).find('.tts.kana').html(), 1, speaker);

		});

		$('.port.dict-'+dictCount+' .quick-btn').on('click', function() {
			//1. find id
			dictElemID = $(this).parent().parent().attr('class').split(" ")[2];
			dictElemState = $(this).attr('class').split(" ")[1];
			console.log(dictElemState+", "+dictElemID);
			switch(dictElemState) {
				case "add":
				$('.listitems .port.'+dictElemID).removeClass("true").removeClass("disabled").addClass("false");
				newStatus = 0;
				break;
				case "remove":
				$('.listitems .port.'+dictElemID).addClass("true").removeClass("disabled").removeClass("false");
				newStatus = 1;
				break;
				case "disabler":
				$('.listitems .port.'+dictElemID).removeClass("true").addClass("disabled").removeClass("false");
				newStatus = 2;
				break;
			}
			$.ajax({
				url:"/kotobastatus",
				type: "post",
				data: {
					"_token": token,
					"status": newStatus,
					"kotobaID": dictElemID

				},
				cache: false,
				success: function(response) {
					console.log('success');
					console.log(response);
					$('.dictateitems .port.'+dictElemID).find('.quick-btn').remove();
					// $('form.id-'+id).hide();
				},
				error: function(response) {
					console.log('fail');
					console.log(response);
				}
			});


		});

	}
	else {
		console.log('reroll');
		pickRandom(kotobaElem_f, kotobaNum_f);
	}


}

function dictatethis(key) {
	if(kotobashuffle == "on") {
		//get length
		switch(key) {
			case 100:
			kotobaElem = $('.kotoba-front .listitems .port');
			break;
			case 115:
			kotobaElem = $('.kotoba-front .listitems .port.enabled');
			break;
			case 103:
				if($('.kotoba-front .listitems .port.true').length) {
					kotobaElem = $('.kotoba-front .listitems .port.true');
				}
				else {
					kotobaElem = $('.kotoba-front .listitems .port');
				}
			break;
			case 102:
				if($('.kotoba-front .listitems .port.false').length) {
					kotobaElem = $('.kotoba-front .listitems .port.false');
				}
				else {
					kotobaElem = $('.kotoba-front .listitems .port');
				}
			break;

		}
		kotobaNum = kotobaElem.length;
		console.log("kotobanum: "+kotobaNum);


		pickRandom(kotobaElem, kotobaNum);


	}
	else {

	}
}

function stopSpeakRotate() {
	if(timer == true) {
		clearInterval(myInterval);
		timer = false;
	}
}

function speakRotate(spoken, rate) {
	shuffleRates = [1, 0.9, 0.8, 0.7, 0.6, 0.5];
	rateRand = Math.floor(Math.random()*6);
	if(rateRand == 6) {
		rateRand = 5;
	}
	speak(spoken, shuffleRates[rateRand], speaker);
}

function dictatethis2(key) {
	if(kotobashuffle == "on") {

		kjSentElem = $('.sentences-front .port .kanji-sent');
		hiraSentElem = $('.sentences-front .port .hira-sent');
		kotobaNum = kjSentElem.length;
		pickRand = Math.floor(Math.random()*kotobaNum);
		kjWord = kjSentElem.eq(pickRand).html();
		hiraWord = hiraSentElem.eq(pickRand).html();
		speakRotate(hiraWord, 1);
		// if(timer == true) {
		// 	clearInterval(myInterval);
		// 	console.log("eyo");
		// }
		// timer = true;
		// myInterval = setInterval(speakRotate, 10000, hiraWord, 0.7);


		if(key=="106") {
			appendThis = '<div class="port sent-dict">'+
			'<div class="kanji-sent-d">'+kjWord+'</div>'+
			'<div style="display: none;" class="hira-sent-d">'+hiraWord+'</div>'+
			'</div>';

			$('.sentences-front .dictateitems .hl').after(appendThis);
			$('.sent-dict').on('click', function() {

				speakHira = $(this).find('.hira-sent-d').html();

				console.log(speakHira);
				speak(speakHira, 0.5, speaker);

			});
		}
	}
	else {

	}
}

$('.dictate-mode .mode-button').on('click', function() {
	$('.dictate-mode .mode-button').removeClass('active');
	$(this).addClass('active');
});
$('.dictate-mode .german-enable').on('click', function() {
	if($('.dictate-mode .german-enable').hasClass('disable')) {
		$(this).addClass('enable').removeClass('disable').html('DE On');

	}
	else {
		$(this).addClass('disable').removeClass('enable').html('DE Off');
	}

});

$('.manual-mode .mode-button').on('click', function() {
	manualMode = $(this).html();
	console.log(manualMode);
	switch(manualMode) {
		case "ALL":
		fakekey = 100;
		break;
		case "nonDict":
		fakekey = 103;
		break;
		case "Dict":
		fakekey = 102;
		break;
	}
	dictatethis(fakekey);
});

function rotator() {
	//d = 100 keycode = dictate all
	//f = 102 keycode = dictate true
	//g = 103 keycode = dictate false
	dictateMode = $('.dictate-mode .mode-button.active').html();
	console.log(dictateMode);
	switch(dictateMode) {
		case "ALL":
		fakekey = 100;
		break;
		case "nonDict":
		fakekey = 103;
		break;
		case "Dict":
		fakekey = 102;
		break;
	}
	dictatethis(fakekey);
}
function stopRotator() {
	clearInterval(myInterval);
}

function rotator2() {
	dictatethis2();
}
function stopRotator2() {
	clearInterval(myInterval2);
}

$('.kotoba-front .playstop').on('click', function()  {
	if($(this).hasClass('stop')) {
		$(this).html("Stop");
		$(this).removeClass('stop').addClass('start');

		myInterval = setInterval(rotator, 20000);

	}
	else if($(this).hasClass('start')) {
		$(this).html("Start");
		$(this).removeClass('start').addClass('stop');

		stopRotator();
	}
});

$('.sentences-front .rng-btn').on('click', function()  {

//pick random sentence
dictatethis2("106");


});

$('.sentences-front .playstop').on('click', function()  {
	if($(this).hasClass('stop')) {
		$(this).html("Stop");
		$(this).removeClass('stop').addClass('start');

		myInterval2 = setInterval(rotator2, 15000);

	}
	else if($(this).hasClass('start')) {
		$(this).html("Start");
		$(this).removeClass('start').addClass('stop');

		stopRotator2();
	}
});

$('html').keypress(function(e) {
	//d = 100 keycode = dictate all
	//f = 102 keycode = dictate true
	//g = 103 keycode = dictate false
	//j = 106 keycode = random sentence
	//k = 107
	//s = 115 = dictate enabled
	console.log(e.keyCode);

	if(e.keyCode == "100" || e.keyCode == "102" || e.keyCode == "103") {
		dictatethis(e.keyCode);
	}
	else if(e.keyCode == "106") {
		dictatethis2(e.keyCode);
	}
	else if (e.keyCode == "107") {
		stopSpeakRotate();
	}
	else if (e.keyCode == "115") {
		dictatethis(e.keyCode);
	}
});






}
