# Quick And Dirty Data Visualization
## World map visualizations with D3.js
### Normalizing the data (Excel)
Starting point: https://bl.ocks.org/mbostock/4180634
I started with some example code and an SVG of a world map from this site.

The countries on the map are indexed by its ISO 3166-1 code. In order to match the country names in the provided dataset on immigrants with the relevant ISO codes, I used the VLOOKUP function in Excel. I started by creating a sheet with the provided dataset, and another sheet with a list of countries and their ISO codes. 

The basic forumula I used is =VLOOKUP(A2,Sheet1!A:B,2,FALSE) where A2 is the name of the country I want to find the code for. Sheet1!A:B is the range of cells containing the country names and ISO codes. The third parameter ("2") indicates which column in the source dataset contains the ISO codes to grab. The last parameter ("FALSE") specifies that I want to only find an exact match.

The dataset has a number of geographic areas which don't map to a country, which for the purposes of this assignment I will ignore. 
