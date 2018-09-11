let populations;
let objArray = [];
let girth=20;




function preload() {
  // Don't use preload() function for JSON files, 
  // currently a bug in p5 where it doesn't return JSON Arrays only JSON Objects
  // populations = loadJSON('../data/simpleData_noRegions.json');
}

function setup() {
  // put setup code here
  // load static data set here
  loadJSON('data.json', callback);
	createCanvas(2000,8000);
	background(0);
	
}

function callback(data) {
  console.log('done loading data');
  //console.log(data);
  populations = data;
	
	
  //if the data is loaded, start working with it
  if (populations) {
		

		
    for (let i = 0; i < populations.length; i++) {
      //console.log(populations[i]);
    
      let name = populations[i].country;
      let population = populations[i].estimate;
      //sampling error of the estimate, estimate could be + or - the margin of error
      let error = populations[i].marginOfError;
      
      //get magnitude of error compared to population estimate;
      let errorFraction =  populations[i].marginOfError / population;
      //console.log(errorFraction);
      
			let y = girth * i * 1.3;
			
			
      //console.log(name, population, error);
			fill(75);
			let plusErr = populations[i].estimate/1000;
			plusErr += populations[i].marginOfError/1000;
			
			
			rect(0,y,plusErr,girth);
			
			
			
			fill(255);
			rect(0,y,populations[i].estimate/1000,girth);
			
		
			fill(200);
			let minusErr = populations[i].estimate/1000;
			minusErr -= populations[i].marginOfError/1000;
		
			rect(0,y,minusErr,girth);
			
			fill(127,35,100)
			let label  = populations[i].country + " - " + populations[i].estimate + " ± " +populations[i].marginOfError; 

			text(label, 20, y-10);
			
			
    }
  }
}

function draw() {

	
  }
