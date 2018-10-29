var out = ''



var target 
var slider
var chars

var cash = 500

function randomLtr(){

	var rand = Math.floor(Math.random() * chars.length)
	return chars[rand]
}

function makeUnique(str) {
  return String.prototype.concat(...new Set(str))
}




// for(var i=0; i<tgtArr.length; i++){
// 	//console.log(i)
// 	//console.log(tgtArr[i])
// 	attempt(tgtArr[i])
// 	//console.log("out " + out)

	
// }
var typeface;
var textarr;

function preload(){
	typeface = loadFont('./carbontype.ttf');
	textarr = loadStrings('./test.txt');


}




function setup(){

	createCanvas(1920,600);

	target = textarr.join('');
	defaultChars = makeUnique(target);
	chars = defaultChars
	target = '';
	//console.log(target);


	fill(0);
	
	textSize(20);
	textAlign(LEFT, TOP);
	textFont(typeface);

	frameRate(30)
	console.log(textarr)

	slider = createSlider(1, 5000, 30);
  	slider.position(10, 10);
  	slider.style('width', '600px');

  	typeslider = createSlider(1, 3, 2);
  	typeslider.position(10, 40);
  	typeslider.style('width', '600px');
  	

}

const buttonX = 375
const buttonY = 300
const buttonLength = 400
const buttonHeight = 100


var lineCount = 0;
var cand
var onScreen = []
var count=0;
var pos=0;

var rate;

var beginTime = performance.now();
var endTime = performance.now();

var averageArr = [0]
var averageNum = 0
var thisTime =0;

var begin = false;

var morale = 100;

function draw(){
		


if(begin){

	background('beige')
	fill(0)

	if(typeslider.value() == 3){
		morale += 0.001
		cash -= 0.007
	}else if(typeslider.value() == 1){
		morale -= 0.001
		cash += 0.03
	}

	if(slider.value() > 500){
		morale -= 0.001
	}
	
	//console.log("Framerate "+rate)

	pos=0;
	

	for(var i=0;i<onScreen.length;i++){
		text(onScreen[i],20,pos+70)
		pos += 20;
	}

	cand = randomLtr()

	//console.log("POS "+pos)

	text(out + cand, 20, pos+70)
	//console.log(textarr[lineCount]);
	target = textarr[lineCount]

	if(lineCount <= textarr.length){

		if(count <= textarr[lineCount].length)
		
			if(cand == target[count]){
				out += cand
				count++
				endTime = performance.now();
				thisTime = ((endTime - beginTime)/1000).toFixed(2);

				averageArr.push(endTime - beginTime);
var bar=0;

				for(var foo = 0; foo < averageArr.length; foo++){
					bar +=averageArr[foo];
				}
				averageNum = ((bar/averageArr.length)/1000).toFixed(2)
				

				console.log('EXECUTION TIME '+(endTime-beginTime))
				


				beginTime = performance.now();
			}
	}
	text("Average time: "+averageNum, 700,50)
	text("This time: "+thisTime,700,70)
	text("Monkey morale: " + morale.toFixed(1), 700, 90)
	cash -= .03 * typeslider.value()
	// console.log("line count " +lineCount);
	// console.log("count " +count)
	// console.log(onScreen)
	// console.log('linelength '+ target.length)

	if(count == target.length){
		console.log('reset');
		count = 0
		lineCount ++;
		onScreen.push(out)
		out = ''
		cash += 150
		morale += 10
	}
}else{
	background(0)
	fill(255)

	

	text("The Infinite Monkey Games", 400, 100)
	
	fill('grey');

  // A rectangle
  rect(buttonX, buttonY, buttonLength, buttonHeight);
  fill('black')
  text('begin',475,325)
}

if(!begin){
	fill(255)
}

	
  	text("Typewriter quality", 20,50)

  	text("Number of monkeys", 20,20)

	
	text(rate, 700,10)


	rate = slider.value()
	frameRate(rate)

	text("Cash: $"+cash.toFixed(2), 700,30)

}

function mousePressed(){
	if(mouseX >buttonX
		&& mouseX < buttonX + buttonLength
		&& mouseY > buttonY
		&& mouseY < buttonY + buttonHeight){

		begin = true;
	}
}


