const fs = require('fs');

const text = fs.readFileSync('corpus.txt','utf-8');

//console.log(text);

txtArray = text.split('***');

txtArray.forEach(t=>console.log(t.length))