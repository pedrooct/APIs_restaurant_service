# APIs_restaurant_service
This project is based on the following : One API is for serving the restaurant and the other API combines the information of the restaurant APIs to delivery it to the user.

# Web service 1

This web service is for the restaurant to manage there information like shcedule , menu , reservations , etc...  
This API is also "work horse", making the queries to the database , and giving the information back to web service 2.  
It has a interface for ease of use.  

# Web Service 2

This web service is for delivering the information back to the user. The user is able to search for the restaurant based on location, name , street, etc ...  
He can also make reservation , where the web service is just a midddle man.  
When the reservation is valid , he will recieve a email with .ICS file (this is not the api).  
This API also uses memcached for a quick response.



This Project was made with a colleage.
