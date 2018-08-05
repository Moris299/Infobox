# Infobox  

![Infobox](https://i.imgur.com/HENIx5L.png)    

Infobox - box with useful informations 
This is a little box, created for forums, to inform about birthdays, events and display some intresting information about current day. 

Forums using this script: 

[forum.mistrzowie.org](http://forum.mistrzowie.org/)


### Prerequisites, installing and using

You have to:    
     
1. Put folder "infobox" to your public_html folder. 
2. Than, where you want to display infobox insert html code from iframe.html file.
3. Open mysql.php and configure it with database name, username and password  
4. Add to CRON: 
0 0 * * * (running at 0 at night, every day) 
wget -O - /infobox/generating/CRON/sunriseAndSunsetToFile.php
5. Run yoursite.com/infobox/generating/CRON/sunriseAndSunsetToFile.php once time.

## How to add birthdays and events:

This section will be updates soon

## Version  
   
Current version: 0.3  
   
## Authors   
   
* **Maurycy Kaczmarek**    
    
## License   
    
Totally free to use and edit.

## Other info:
This project has been created in polish. I translated some comments in code but in future versions I will add option to translate elements to other languages. 
