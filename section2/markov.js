


console.log($('.placeholder'))

$.get('dictionary.json', function(data){


		const dict = data;

		
		console.log('dix')





});





function generate(category, type, quantity, dict){
	var corpusArray = dict.categories[category][type]
	//console.log(corpusArray);
	//console.log(corpusArray);

	var rm = new rita.RiMarkov(2);
	rm.loadText(corpusArray.join(' '));

	sentences = rm.generateSentences(quantity);

	return(sentences.join(' '))


}