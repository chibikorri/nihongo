function Ajax() {
	 // // Fetch all records
  //   $('#fetchAllRecord').click(function(){
  //    fetchRecords();
  //   });

    // Search by userid
    // $('#btnSearch').click(function(){
    //   var userid = Number($('#search').val().trim());
    //     if(userid > 0){
    //      fetchRecords(userid);
    //     }
    //   });
    
    function loopConvert(i, dataResponse, len) {
        if(i<len) {
            // console.log(dataResponse);
            words[i] = {
            'deutsch': dataResponse.data[i].deutsch,
             'romaji':dataResponse.data[i].romaji,
             'kana': dataResponse.data[i].kana,
             'kanji': dataResponse.data[i].kanji,
             'pt_d': parseInt(dataResponse.data[i].pt_d),
             'pt_rj': parseInt(dataResponse.data[i].pt_rj),
             'pt_kn': parseInt(dataResponse.data[i].pt_kn),
             'pt_kj': parseInt(dataResponse.data[i].pt_kj)
            };
          i++;
          loopConvert(i, dataResponse, len);
        }
    }

  function fetchRecords(){
    console.log('!');
    $.ajax({
      url: 'getData/',
      type: 'get',
      dataType: 'json',
      error: function() {
        console.log('error');
      },
      success: function(response){
        console.log('success');        
        console.log(response);

        words = [];
        len = 0;
        if(response.data != null){
          len = response.data.length;
         }

         loopConvert(0, response, len);
        
        // for(var i=0; i<len; i++) {
          
            
             
        // }

        // words[0][4] = parseInt(words[0][4])+1;


        console.log(words);

       
      }
    });
	}
	fetchRecords();
}