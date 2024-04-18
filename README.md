## How to use !
1. Create folder rizquna in your root folder.
2. Go to folder rizquna and open terminal.
3. Clone this repo using this code below or download the zip file and extract it inside rizquna folder.
   
   ```git clone https://github.com/ekaputra012309/rizquna_laravel.git .```
   
5. After finish clone repo or extract, install composer using below code.
   
   ```composer install```
   
7. Then copy or rename .env.example to .env
8. Create new database rizquna and change this line  
before DB_DATABASE=testaja  
after DB_DATABASE=rizquna  
10. Run migration with this below code.
    
    ```php artisan migrate```
    
12. Run seeder with this below code.
    
    ```php artisan db:seed```
    
14. Run the project with this below code.
    
    ```php artisan serve```
    
16. Use email and password below
    
    email     : admin@gmail.com
    
    password  : admindemo
