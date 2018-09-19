function setup(){
createCanvas(1200,800)

//v4 callback
d3.csv('data.csv',(error,data)=>{
	if(error) throw error
		console.log(data);
})

//v5 promise

d3.csv('data.csv').thenI(data=>{
	//do things now
})
}
