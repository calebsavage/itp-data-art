#!/bin/bash
# Define a variable to increment 



counter=69
# Iterate over images
for image in /Users/savagec/*/*.JPG; do
  # Convert number from `1' to pretty format `001'
  printf -v pretty_counter "%03d" $counter
  # Convert image
  convert $image -scale 1x1\! -verbose /Users/savagec/Downloads/out/d2018_$pretty_counter.gif
  # Increment counter
  counter=$(( $counter + 1 ))
done
