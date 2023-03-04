<p align="center"><a href="https://sohibd.com" target="_blank"><img src="https://www.sohibd.com/storage/app/files/shares/backend/sohibd-logo.png" width="400" alt="Laravel Logo"></a></p>

## Laravel 10 With  Sohibd Admin Template 


# Installation

1. Clone This Code With Link:

    ```sh
    $ https://github.com/zahidul1994/argon-boylar-backend-with-laravel-10.git
    
    ```

    Then Go to Your folder.

2. Rename The File env.example To .env  and excute command on Composer:

    ```sh
    composer install
    
   php artisan vendor:publish --all
  
   ```

3. Setup your database at .env 

 ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sohibd
    DB_USERNAME=root
    DB_PASSWORD=
   ```

4. After migrate your database and seeding

 ```sh
    php artisan migrate:refresh --seed"
   
   ```



5. Execute  artisan serve command and goto this link

```sh
http://127.0.0.1:8000/login

```


6. Login with superadmin

``` 
email: superadmin@gmail.com
password: superadmin1234

```
## Enjoy and amazing your coding life  ............................  
