![colors](https://raw.githubusercontent.com/calebsavage/itp-data-art/master/section1/self-portrait/render.png)
## Intro
A representation of the average color of 4,480 photos I have taken. 

## Inspiration
[The Colors Of Motion](https://thecolorsofmotion.com/) makes beautiful posters showing the average color of each frame in a movie. It's quite beautiful, and I wanted to try applying the same technique to my extensive catalog of still photographs to gain some insight on how my palete has changed over time.
![blade runner](https://raw.githubusercontent.com/calebsavage/itp-data-art/master/section1/self-portrait/bladerunner.png)

## Technical Limitations
I was hoping to include a larger sample from my Lightroom catalog, which has well over 60,000 image files in it from the past 15 years. However, this quickly proved to be too computationally intensive for my laptop to handle and I had to scale back my plans a little bit.

The easiest way to reduce the overhead needed was to limit it to .JPG files only (excluding the tens of thousands of .TIFF and camera raw files, which tend to be much larger)


It ended up being rather tricky, mostly because I needed to spend some time refamiliarixzing myself with bash scripting. I am very comfortable with the command line but prefer other languages when doiung scripting.

I've used Imagemagick before for utilitarian resizing and conversion purposes in web apps, and I knew it has an extremely powerful command line interface. 

The code that did most of the heavy lifting is in the colors.sh file. It's no masterpiece and was glued together from Stackoverflow and reddit topics. It averages the colors in the image by scaling it to a 1x1px .gif file

I manually ran it once for each year of images in my archive, resulting in thousands and thousands of single pixel image files. I then needed to concatenate them into one long image file 1 pixel X 4,480 pixels, which I could then stretch into a beautiful represenation of lines.

The last bit of scripting which joined all the output files (1x1 pixel gif's) into a big 1px x 4,480px file was super easy: 

```
convert -append *.gif out.png
```

I then opened the file in Photoshop and stretched it with the Image Size tool. In order to keep the lines sharp I played around a bit with the resizing algotihm until I found a setting which would not blur the pixels as it interpolated.

## Next Steps
I'mr eally excited by the potential to use ImageMagick for image data analysis and visual representation. I have a lot to learn about its syntax (and the finer points of bash scripting) but I hope to continue with some of these tools and integrate them with other methods. 
