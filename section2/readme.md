# It's Yahoo Answers... but it makes even less sense.

## (View Project)[http://calebcalebcaleb.com/yoohoo]

## Why?
Yahoo Answers is a great place to go if you want to feel smart. When I was 13, I got banned from answering questions for being too sassy to people with stupid questions.

## Dataset
I downloaded a large dataset of questions & answers circa 2007 from Webscope which is Yahoo's portal for academic datasets.

## JavaScript and PHP
I began writing JS code, debugging, and testing with node. When I settled on the idea of making a semi-functional web app facsimilie of Yahoo Answers, I decided to use PHP for server-side rendering because I've got the most practice with it, and it is a language well-suited to quick and dirty jobs like this. I was considering using a MySQL or Sqlite database for some storage and processing, but decided to stick with flat files.

Once it came time to deploy, I realized that generating the text server-side introduced additional complications. I ported my Node code to run in the browser. The PHP script spits out a placeholder for each element to be generated which tells the client-side code which category to use (comes from URL parameters), how many sentences to make, and what kind of sentence to make (i.e. question title, question content, or answer)

## Markov chains
This was much easier than I thought. I started with Dan Shiffman's tutorials on rolling your own n-grams and made some decent progress on character-based generative text. But time was short, so I went with Rita's RiMarkov functions. I also played around a bunch with Rita's lexical analysis and part of speech tagging, but the code quickly became unweildy. Overall the library was very pleasant to work with. 

## Web App 
I grabbed the HTML from the Wayback Machine, and am using a simple PHP script to modify it. 

## Please Don't Sue Me
I believe the appropriation elements of this artwork fall under fair use. 