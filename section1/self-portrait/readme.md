!(render.png)
A representation of the average color of 4,480 photos I have taken

I've seen some cool work like this with movie posters, and wanted to figure it out myself. 

It ended up being rather tricky, mostly because I needed to spend some time refamiliarixzing myself with bash scripting. I am very comfortable with the command line but prefer other languages when doiung scripting.

I've used Imagemagick before for utilitarian resizing and conversion purposes in web apps, and I knew it has an extremely powerful command line interface. 

The code that did most of the heavy lifting is in the colors.sh file. It's no masterpiece and was glued together from Stackoverflow and reddit topics.

The last bit of scripting which joined all the output files (1x1 pixel gif's) into a big 1px x 4,480px file was super eacy: 

`convert -append *.gif out.png`
I then opened the file in Photoshop to stretch it. 
