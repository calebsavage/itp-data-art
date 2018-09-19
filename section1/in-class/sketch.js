function setup(){
	console.log('test');
createCanvas(1200,800)
console.log('hi');
//v4 callback
// d3.csv('data.csv',(error,data)=>{
// 	if(error) throw error
// 		console.log(data);
// })

//v5 promise

// d3.csv('data.csv').then(data=>{
// 	//do things now
// 	console.log(data);
// }).catch(e=>{
// 	console.log(e);
// })

Promise.all([
//loading multiple files
	d3.csv('data.csv'),
	d3.csv('simpleData.csv')
]).then(([usaData,nycData]) =>
	{
		console.log(usaData);
		console.log('simpleData');
		console.log(nycData);

		const processedNyc = processData(nycData, true);
		const processedUsa = processData(usaData, false);

	} )


}

function processData(data, isNycData){
	const mapped = data.map(d =>{
		return {
			'country': isNycData ? d['country/region'] : d['country'], //ternary if else operator-- condition ? true actipon : false action
			'population': +d['estimate'].replace(/,/g,""),
			'marginOfError': +d.marginOfError.replace(/,/g,'').slice(3)
		}
	}).map(d=>{
		return {...d, errorFraction: d.marginOfError /d.population}
	})
console.log(mapped);


const regionsToFilter = ['Europe', 'Asia'] //etc

const noRegions = mapped.filter(d => {
	return regionsToFilter.every(region=>{
		return d.country.indexOf(region) === -1
	})
})

console.log(noRegions);

const total = noRegions.reduce((acc,d)=> );


}


