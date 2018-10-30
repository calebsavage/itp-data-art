# It's Yahoo Answers... but it makes even less sense.

## [View Project](http://calebcalebcaleb.com/yoohoo)


![screenshot](https://github.com/calebsavage/itp-data-art/raw/master/section2/screenshot.jpg | width=500)

## Why?
Yahoo Answers is a great place to go if you want to feel smart. When I was 13, I got banned from Yahoo Answers for telling people they should just Google their stupid questions. It still holds a special place in my heart, but also I hate it. It truly is a window into the collective consciousness of netizens (remember when that was the buzzword du jour!?) worldwidw. It's totally fascinating, frequently sad, and invariably confusing to see the insane (and inane) things that people decided "Let me ask anonymous strangers on the internet about this". 

## Dataset
I downloaded a large dataset of questions & answers circa 2007 from Webscope which is Yahoo's portal for academic datasets.

## Languages
I began writing JS code, debugging, and testing with Node. When I settled on the idea of making a semi-functional web app facsimilie of Yahoo Answers, I decided to use PHP for server-side rendering because I've got the most practice with it, and it is a language well-suited to quick and dirty jobs like this. I was considering using a MySQL or Sqlite database for some storage and processing, but decided to stick with flat files and on-the-fly generation.

Once it came time to deploy, I realized that generating the text server-side introduced additional complications. I ported my Node code to run in the browser. The PHP script spits out a placeholder for each element to be generated which tells the client-side code which category to use (comes from URL parameters), how many sentences to make, and what kind of sentence to make (i.e. question title, question content, or answer). The whole thing could have been more effectively accomplished without any PHP 

## Markov chains
This was much easier than I thought. I started with Dan Shiffman's tutorials on rolling your own n-grams and made some decent progress on character-based generative text. But time was short, so I went with Rita's RiMarkov functions. I also played around a bunch with Rita's lexical analysis and part of speech tagging, but the code quickly became unweildy and the Markov functionality worked quite well. Overall the RiTa library was very pleasant to work with. 
 

## Thoughts on further developing this idea
It would be moderately amusing to create a set of scripts which would crawl an arbitrary website, scrape and analyze the text, and then spit back out a nonsense version. This was fun to make.

## Please Don't Sue Me
I believe the appropriation elements of this artwork fall under fair use.