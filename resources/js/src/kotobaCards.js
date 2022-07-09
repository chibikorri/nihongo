function kotobaCards() {


	stackLearn = [];
	kotobaMode = "kanji";

	$('.stack-view .stack-0 .counter').html(ranks[0].length);
	$('.stack-view .stack-1 .counter').html(ranks[1].length);
	$('.stack-view .stack-2 .counter').html(ranks[2].length);
	$('.stack-view .stack-3 .counter').html(ranks[3].length);
	$('.stack-view .stack-4 .counter').html(ranks[4].length);
	$('.stack-view .stack-5 .counter').html(ranks[5].length);
	$('.stack-view .stack-6 .counter').html(ranks[6].length);
	$('.stack-view .stack-7 .counter').html(ranks[7].length);
	$('.stack-view .stack-8 .counter').html(ranks[8].length);
	$('.stack-view .stack-9 .counter').html(ranks[9].length);

	function clearCanvas() {
	canvas.width = canvas.width;
	}

	console.log(ranks);

	function shuffleCard(stack, rank) {
		// shuffles and picks forst entry
		subjectPick = Math.floor(Math.random()*stack.length);
		console.log("picked "+subjectPick);

		$('.kanjicard .kanji .revealed').hide();
		$('.kanjicard .kana').hide();
		$('.kanjicard .bedeutung').hide();
		$('.kanjicard .kanji .hidden').show();

		$('.kanjicard .id').html(stack[subjectPick].id);
		$('.kanjicard .stackposition').html(subjectPick);
		$('.kanjicard .timestamp').html(stack[subjectPick].timestamp);
		$('.kanjicard .rank').html(stack[subjectPick].rank);
		$('.kanjicard .points').html(stack[subjectPick].points);
		$('.kanjicard .kanji').html(stack[subjectPick].kanji);
		$('.kanjicard .kana .context').html(stack[subjectPick].kana);
		$('.kanjicard .bedeutung .context').html(stack[subjectPick].bedeutung);

	}

	$('.mode-btn').on('click', function() {
		getclass = $(this).attr('class').split(" ")[1];

		$('.mode-btn').removeClass('active');
		$(this).addClass('active');

		kotobaMode = getclass;
		console.log(kotobaMode);
	});

	$('.stack').on('click', function() {
		whichStack = parseInt($(this).attr('class').split(" ")[1].split("-")[1]);
		// alert(whichStack);
		stackLearn = ranks[whichStack];
		console.log(stackLearn);

		//shuffle and output first card
		shuffleCard(stackLearn, whichStack);

		$('.kanjicard.card').show();
		$('.button.reveal').show();
		$('.check.right').css('display', 'none');
		$('.check.wrong').css('display', 'none');
		$('.kanji .revealed').hide();
		function modeAssign(modeDigit) {
			if(modeDigit == 1) {
				$('.kanji .hidden').show();
				$('.card .kanji').show();

			}
			else if(modeDigit == 2) {
				$('.card .kanji').hide();
				$('.kana').show();

			}
			else if(modeDigit == 3) {
				$('.card .kanji').hide();
				$('.bedeutung').show();

			}
		}



		if(kotobaMode == "kanji") {
			modeAssign(1);

		}
		else if(kotobaMode == "kana") {
			modeAssign(2);
		}
		else if(kotobaMode == "bedeutung") {
			modeAssign(3);
		}
		else if(kotobaMode == "all") {
			//shuffles
			rando = Math.ceil(Math.random()*3);
			console.log(rando);
			modeAssign(rando);


		}



		// clearCanvas();

	});

	$('.reveal').on('click', function() {
		$('.button.reveal').hide();
		$('.kanji .hidden').hide();
		$('.bedeutung').show();
		$('.kana').show();
		$('.card .kanji').show();

		$('.check.right').css('display', 'grid');
		$('.check.wrong').css('display', 'grid');




	});

	$('.button.right').on('click', function() {

		console.log("func");
		//ajax call
		token = $('meta[name="csrf-token"]').attr('content');
		thisRank = parseInt($(this).parent().find('.rank').html());
		thisStackPosition = parseInt($(this).parent().find('.stackposition').html());
		thisID = parseInt($(this).parent().find('.id').html());
		console.log(thisRank+", "+thisStackPosition+", "+thisID);

		if(thisRank < 9) {
			//rank up
			console.log("rank up");
			ranks[thisRank][thisStackPosition].rank = thisRank+1;
			//push entry to new rank
			console.log("new rank");
			ranks[thisRank+1].push(ranks[thisRank][thisStackPosition]);
			//remove entry from odl rank
			console.log("remove from old");
			ranks[thisRank].splice(thisStackPosition, 1);
			//refresh stackview
			console.log("stackview");
			$('.stack-view .stack-'+thisRank+' .counter').html(ranks[thisRank].length);
			$('.stack-view .stack-'+(thisRank+1)+' .counter').html(ranks[thisRank+1].length);

			 // console.log(ranks);
		}

		/*-- DB stuff --*/
		//check timestamp for update possibility
		getToday = parseInt($('.kanjicards .today-timestamp').html());
		cardTime = parseInt($(this).parent().find('.timestamp').html());

		if(getToday != cardTime) {
			//addpoint
			newPoints = 1 + parseInt($(this).parent().find('.points').html());
			// console.log(newPoints);
			qualifierPoints = (thisRank+1)*2;

			if(newPoints >= qualifierPoints) {
				if(thisRank != 9) {
					//rank up
					newRank = thisRank+1;
				}
				else {
					newRank = 9;
				}
			}
			else {
				newRank = thisRank;
			}

			//ajax call

			$.ajax({
				url:"/kotobacardsuccess",
				type: "post",
				data: {
					"_token": token,
					"newPoints": newPoints,
					"newRank": newRank,
					"kanjiID": thisID

				},
				cache: false,
				success: function(response) {
					console.log('success');
					console.log(response);
				},
				error: function(response) {
					console.log('fail');
					console.log(response);
				}
			});

		}
		else {

		}

		// timeDifference = getToday - cardTime;
		// console.log("time: "+timeDifference);

		$('.kanjicard').hide();



		// 1. rank the kanji up via ajax db (max 5)
		// ------> update timestamp regardless of rank movement
		// 2. rank the kanji up on teh session (done)
		// 3. remove kanji from stackLearn (done)
		// 4. refresh stackview -> add kanji to rank1 array (done)
	});

	$('.button.wrong').on('click', function() {
		token = $('meta[name="csrf-token"]').attr('content');
		thisRank = parseInt($(this).parent().find('.rank').html());
		thisStackPosition = parseInt($(this).parent().find('.stackposition').html());
		thisID = parseInt($(this).parent().find('.id').html());

		if(thisRank > 0) {
			//rank up
			ranks[thisRank][thisStackPosition].rank = thisRank-1;
			//push entry to new rank
			ranks[thisRank-1].push(ranks[thisRank][thisStackPosition]);
			//remove entry from odl rank
			ranks[thisRank].splice(thisStackPosition, 1);
			//refresh stackview
			$('.stack-view .stack-'+thisRank+' .counter').html(ranks[thisRank].length);
			$('.stack-view .stack-'+(thisRank-1)+' .counter').html(ranks[thisRank-1].length);



			 console.log(ranks);

		}

		/*-- DB stuff --*/

		//rank kanji down if rank higher than zero
		if(thisRank > 0) {
			rankDown = thisRank - 1;
			$.ajax({
				url:"/kotobacardrelearn",
				type: "post",
				data: {
					"_token": token,
					"newRank": rankDown,
					"kanjiID": thisID

				},
				cache: false,
				success: function(response) {
					console.log('success');
					console.log(response);
				},
				error: function(response) {
					console.log('fail');
					console.log(response);
				}
			});



		}






		$('.kanjicard').hide();
		// 1. rank the kanji down via ajax db (min 0)
		// ------> update timestamp regardless of rank movement
		// 2. rank the kanji up on teh session
		// 3. remove kanji from stackLearn
		// 4. refresh stackview -> add kanji to rank1 array
	});






}
