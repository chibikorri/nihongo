function dataTable() {

	$('.change-btn').on('click', function() {
		getID = $(this).attr('class').split('_')[1];
		console.log(getID);
		$('input.upd-id').val(getID);
		$('input.upd-id').attr('value', getID);

		$('input.upd-deutsch').val($('.word-'+getID+'-deutsch').val());
		$('input.upd-deutsch').attr('value', $('.word-'+getID+'-deutsch').val());

		$('input.upd-romaji').val($('.word-'+getID+'-romaji').val());
		$('input.upd-romaji').attr('value', $('.word-'+getID+'-romaji').val());

		$('input.upd-kana').val($('.word-'+getID+'-kana').val());
		$('input.upd-kana').attr('value', $('.word-'+getID+'-kana').val());

		$('input.upd-kanji').val($('.word-'+getID+'-kanji').val());
		$('input.upd-kanji').attr('value', $('.word-'+getID+'-kanji').val());

	});

}