## Photovoltaic Jobs Forcasting Model Website

This project is an online application designed to replicate a complex Xcel forcasting model with the intent to make the process easier and most digestible for users. It gave the user the ability to input about 30 different variables of information and then the site would run the model and return the forecast in a sharable and saveable report. The user could run, save, and share as many different variations as they would like. Updates to model were tracked and highlighted.

## Calculation Engine

The Xcel model consisted of over 25,000 variables and calculations, each of which needed to be represented in the online version to ensure the integrity of the data. However, the Xcel model was continually being updated and added to. In order to accommodate the changing nature of the model data and structure, I developed a Model Uploader that could convert any Xcel spreadsheet into an interactive PHP-based calculation engine in minutes. This allowed the site to accommodate all of the future changes that would come to the model and, with minimal effort, incorporate them into the site. 

The final site utilized a calculation file with over 2500 values and calculations each time the model was updated, and it ran it in about a 10th of a second. An example of the calculation file can be found at **/includes/inc_calculations_8.php**.

## Technology Stack

- PHP
- Custom Model Uploader
- JavaScript
- HTML
- CSS / LESS

## Project Details

- Year Built: 2012
- Client: National Renewable Energy Laboratory (NREL)

See more images and other work at [EnochFredericks.com](https://enochfredericks.com)