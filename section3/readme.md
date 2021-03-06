# RateAState.online
## A friendly competition

### Technologies
d3.js- drawing the map
p5.js- tag cloud for each state
CodeIgniter PHP framework with MySQL database- data persistence

### Why?
With all the buzz over the recent midterm elections, I thought this would be a fun exercise in poll design and "election" result visualization. 

### Questions raised
While I initially thought about this as just a fun little thing, it made me think a lot about the choices made by poll designers and data visualizers. How am I unconsciuously introducing bias? What are the implications of the map projections, scales, and color schemes I've picked? Is it problematic to even create this "competition"? Is it amplifying tribalism in the United States? How does starting each state with a 5/10 rating rather than a 0/10 or 10/10 affect things? Can anything with even the vaguest political connotation be "just for fun"? Am I excluding the international community by limiting it to US states (though there are no restrictions on who can participate)? How do I even begin to make this screenreader-accessible?

I can't say I have answers about any of this, but I definitely got a practical sense of some theoretical concerns. 

### Relevant Files
To see the code that I've written, navigate to these files:

application/controllers/welcome.php

application/views/map.php

application/views/state.php