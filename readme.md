 # QUOTESONDEV - Web site built with Wordpress and AngularJS
 
 -project 6 RED Academy. 
 
 -I presented this website on RED's showcase on 10/Dec/2015.

In this project I could mix the Wordpress CMS and the AngularJS framework in order to use the WP_REST API pluggin and fetch data on the homepage.

Basically I intend to:
a) Fetch random posts on the homepage;
b) Accept new quote submissions from the front-end of the site (from logged in users only), and set those submissions to pending.

For this purpose I approached the project using plain jQuery (main branch) and later on I used AngularJS (angular branch). 

If you're interested to see the requirements please take a look at the list below:

- WordPress requirements:

Make use of the WP REST API (v2) plugin to satisfy functional requirements

- AngularJS requirements:

Create at least one Angular Directive to encapsulate the UI for displaying and fetching quotes;
Use an external template in your Directive;
Create a service module to encapsulate HTTP request/response functionality;
Enable fetching of random quotes, and fetching individual quotes using the ‘slug’ property;
Create a controller module to capture user input, perform input validation and handle submitting quotes to the API.
