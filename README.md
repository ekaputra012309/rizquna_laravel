## Preview
Login page | Dashboard page | User management
--- | --- | ---
![login page](https://github.com/ekaputra012309/rizquna_laravel/assets/88359335/63308692-c5f7-4705-b4b4-06c0e6749b52) | ![dashboard page](https://github.com/ekaputra012309/rizquna_laravel/assets/88359335/39762596-1f23-4db1-a5cf-0f2b6d6ed6ab) | ![user management](https://github.com/ekaputra012309/rizquna_laravel/assets/88359335/b445b891-54f5-4861-8044-1561cbd4732e)  

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
