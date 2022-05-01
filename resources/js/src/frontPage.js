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

		for(i = 0; i < voices.length; i++) {
			if(voices[i].name.indexOf("Sayaka") != -1) {
				console.log('found main');
				foundMain = i;
			} else if (voices[i].name.indexOf("Google 日本語")) {
				console.log('found backup');
				foundBK = i;

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



function speak(word) {

	theWord = new SpeechSynthesisUtterance(word);
	theWord.volume = 1;
		// console.log(voices);
	theWord.voice = voices[ speaker ];


	synth.speak(theWord);
}

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
				speak(speakthis);
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

$('.kotoba-front .port .swap').on('click', function() {
	getId = $(this).parent().attr('class').split(" ")[2];
	getStatus = $(this).parent().attr('class').split(" ")[1];
	token = $('meta[name="csrf-token"]').attr('content');
	if(getStatus == "true") {
		newStatus = 0;
		$(this).parent().addClass("false").removeClass("true");

	}
	else if(getStatus == "false") {
		newStatus = 1;
		$(this).parent().addClass("true").removeClass("false");
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
		speakthis = $(this).html();
		speak(speakthis);
	}
	if (e.which === 2) {
		/* remove */
	}




});

function dictatethis(key) {
	if(kotobashuffle == "on") {
		//get length
		switch(key) {
			case 100:
			kotobaElem = $('.kotoba-front .listitems .port');
			break;
			case 102:
				if($('.kotoba-front .listitems .port.true').length) {
					kotobaElem = $('.kotoba-front .listitems .port.true');
				}
				else {
					kotobaElem = $('.kotoba-front .listitems .port');
				}
			break;
			case 103:
				if($('.kotoba-front .listitems .port.false').length) {
					kotobaElem = $('.kotoba-front .listitems .port.false');
				}
				else {
					kotobaElem = $('.kotoba-front .listitems .port');
				}
			break;

		}
		kotobaNum = kotobaElem.length;
		console.log(kotobaNum);
		pickRand = Math.floor(Math.random()*kotobaNum);
		randWord = kotobaElem.eq(pickRand).find('.kana').html();
		randWordKanji = kotobaElem.eq(pickRand).find('.kanji').html();
		randwordMeaning = kotobaElem.eq(pickRand).find('.meaning').html();
		console.log(randWord);

		speak(randWord);
		dictCount++;

		appendThis = '<div class="port">'+
			'<div class="visib f30 kanji"><span >'+dictCount+'</span> '+randWordKanji+'</div>'+
			'<div class="hidden">'+
				'<div class="inner">'+
					'<div class="tts kana">'+randWord+'</div>'+
					'<div class="">'+randwordMeaning+'</div>'+
				'</div>'+
			'</div>'+
		'</div>';

		// appendThis = '<div class="port">'+
		// 	'<div class="visib kana">'+randWord+'</div>'+
		// 	'<div class="hidden">'+
		// 		'<div class="inner">'+
		// 			'<div class="tts f30  kanji">'+randWordKanji+'</div>'+
		// 			'<div class="">'+randwordMeaning+'</div>'+
		// 		'</div>'+
		// 	'</div>'+
		// '</div>';

		$('.kotoba-front .dictateitems .hl').after(appendThis);
		$('.kotoba-front .port').on('mouseover', function() {
			kotoMouseover($(this));
		});

		$('.kotoba-front .port').on('mouseout', function() {
			kotoMouseout($(this));

		});

	}
	else {

	}
}

function dictatethis2() {
	if(kotobashuffle == "on") {

		kotobaElem = $('.sentences-front .port');
		kotobaNum = kotobaElem.length;
		console.log(kotobaNum);
		pickRand = Math.floor(Math.random()*kotobaNum);
		randWord = kotobaElem.eq(pickRand).html();
		speak(randWord);
	}
	else {

	}
}

$('.dictate-mode .mode-button').on('click', function() {
	$('.dictate-mode .mode-button').removeClass('active');
	$(this).addClass('active');
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
		case "inactive":
		fakekey = 103;
		break;
		case "active":
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
	console.log(e.keyCode);

	if(e.keyCode == "100" || e.keyCode == "102" || e.keyCode == "103") {
		dictatethis(e.keyCode);
	}
});






}
