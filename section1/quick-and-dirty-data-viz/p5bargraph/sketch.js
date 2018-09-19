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
	createCanvas(800,4000);
	background(255);
  
  fill(0);
  textAlign(LEFT);
  textSize(24);
  text("US Immigrant Populations (with margin of error indicated)",50,20);
  textSize(12);
	textAlign(LEFT);
}

function callback(data) {
  console.log('done loading data');
  //console.log(data);
  populations = data;
	
	
  //if the data is loaded, start working with it
  if (populations) {
		populations.sort(function(a,b){
      //sort the data from greatest estimate to least
      
      a.estimate = parseInt(a.estimate);
      b.estimate = parseInt(b.estimate);
      //sort it
    	if(a.estimate > b.estimate){return -1;}
      else if(a.estimate == b.estimate){return 0;}
      else{return 1;}
    });

		
    for (let i = 0; i < populations.length; i++) {
      //console.log(populations);
      //console.log(populations[i]);
      
    
      let name = populations[i].country;
      let population = populations[i].estimate;
      //sampling error of the estimate, estimate could be + or - the margin of error
      let error = populations[i].marginOfError;
      
      //get magnitude of error compared to population estimate;
      let errorFraction =  populations[i].marginOfError / population;
      //console.log(errorFraction);
      
			let y = girth * i * 1.3+25;
			
			
      //console.log(name, population, error);
			fill(75);
			let plusErr = populations[i].estimate/1000;
			plusErr += populations[i].marginOfError/1000;
			
			
			rect(0,y,plusErr,girth);
			
			
			
			fill(255);
			rect(0,y,populations[i].estimate/1000,girth);
			
		
			fill(150);
			let minusErr = (populations[i].estimate/1000) - (populations[i].marginOfError/1000);
      console.log("ME:"+minusErr);
      rect(0,y,minusErr,girth);
			
			fill(0)
      //toLocaleString formats a number with commas
			let label  = populations[i].country + " - " + parseInt(populations[i].estimate).toLocaleString() + " ± " +parseInt(populations[i].marginOfError).toLocaleString(); 
			text(label, 50, y+15);
			
			
    }
  }
}

function draw() {

	
  }
