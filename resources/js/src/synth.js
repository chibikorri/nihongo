// function synth() {
//
//
//
// var synth = window.speechSynthesis;
//
// // var inputForm = document.querySelector('form');
// // var inputTxt = document.querySelector('.txt');
// // var voiceSelect = document.querySelector('select');
//
// // var pitch = document.querySelector('#pitch');
// // var pitchValue = document.querySelector('.pitch-value');
// // var rate = document.querySelector('#rate');
// // var rateValue = document.querySelector('.rate-value');
//
// var voices = [];
// var speakerArray = [19, 20, 22, 24];
//
// function populateVoiceList() {
//   voices = synth.getVoices().sort(function (a, b) {
//       var aname = a.name.toUpperCase(), bname = b.name.toUpperCase();
//       if ( aname < bname ) return -1;
//       else if ( aname == bname ) return 0;
//       else return +1;
//   });
//   // var selectedIndex = voiceSelect.selectedIndex < 0 ? 0 : voiceSelect.selectedIndex;
//   // voiceSelect.innerHTML = '';
//   // for(i = 0; i < voices.length ; i++) {
//   //   var option = document.createElement('option');
//   //   option.textContent = voices[i].name + ' (' + voices[i].lang + ')';
//
//   //   if(voices[i].default) {
//   //     option.textContent += ' -- DEFAULT';
//   //   }
//
//   //   option.setAttribute('data-lang', voices[i].lang);
//   //   option.setAttribute('data-name', voices[i].name);
//   //   voiceSelect.appendChild(option);
//   // }
//   // voiceSelect.selectedIndex = selectedIndex;
// }
//
// populateVoiceList();
//
// if (speechSynthesis.onvoiceschanged !== undefined) {
//   speechSynthesis.onvoiceschanged = populateVoiceList;
// }
//
// function speak(){
//     synth.speak(utterThis);
// }
//
// function loopWords(i) {
// 	if(running == 1) {
//
// 		$('.kanji').removeClass('active');
// 		$('.kana').removeClass('active');
// 		$('.romaji').removeClass('active');
// 		if(running == 1) {
// 			setTimeout(function() {
// 				bookLength = activeBook.length;
// 				// pickWord = Math.floor(Math.random()*bookLength);
// 				pickSpeaker = Math.floor(Math.random()*speakerArray.length);
// 				// console.log(activeBook[pickWord][0].length);
//
// 				getSettings = settings(activeBook[pickWord][0].length);
// 				console.log(getSettings);
// 				$('.kanji').css('font-size', getSettings[1]).addClass('active');
// 				$('.kanji').html(activeBook[pickWord][0]);
// 				if(running == 1) {
// 					setTimeout(function() {
// 						$('.kana').addClass('active');
// 						$('.romaji').addClass('active');
// 						$('.kana').html(activeBook[pickWord][1]);
// 						$('.romaji').html(activeBook[pickWord][2]);
//
// 						var word = new SpeechSynthesisUtterance(activeBook[pickWord][1]);
// 						// console.log(voices);
// 						word.voice = voices[ speakerArray[pickSpeaker] ];
// 						synth.speak(word);
// 						i++;
//
// 						if(i !== 1000) {
// 							if(running == 1) {
// 								setTimeout(function() {
//
// 									loopWords(i);
// 								}, getSettings[0]*3);
// 							}
// 							else {
// 								running = 0;
// 								console.log('stopped');
// 							}
//
// 						}
// 						else {
// 							console.log('excercise done');
// 						}
//
//
//
//
// 					}, getSettings[0]);
//
// 				}
//
//
//
// 			}, 2000);
// 		}
//
//
//
//
// 	}
// 	else {
// 		console.log('stopped');
// 	}
// }
//
// running = 0;
//
// });
// }
