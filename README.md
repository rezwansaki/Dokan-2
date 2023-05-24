# Dokan-2 - Laravel 10 Project

![Alt text](screenshot.jpg "Lara Dokan - Laravel 8 Project")

An Inventory Management System for practice. It can help to run a small shop. Such as, paying the employees, managing products, ePOS etc.

## Instruction:

<ul>
    <li>1. Creating a Database 'dokan_2' in your database server</li>
    <li>2. composer update</li>
    <li>3. 'npm install' and then 'npm run dev'</li>
    <li>5. copy the file .env.example and rename into .env, then give information of database, server and create app key by 'php artisan key:gen' the save the file</li>
    <li>6. php artisan migrate</li>
    <li>7. php artisan serve</li> 
    <li>8. First time you have to install this app. After 'serve command' this app will show you installation process automatically. Or you can visit 'install' route for this.</li> 
    <li>9. After installation you will get information to login. You will be a super admin. Now you can access everything.</li> 
    <li>10. You can change the information from 'Settings' menu from left sidebar.</li> 
</ul>

### User Role:

<ul>
    <li>super admin (role 2) - can access everything. It will be created automatically after installation.</li>
    <li>admin (role 1) - can access everything, excluding 'installation and settings route'.</li>
    <li>user (role 0) - No need and can't do anything.</li>
</ul>

### Change TimeZone:

<ul>
<li>Go to app.php of the project folder</li>
<li>(For Asia/Dhaka) Add this line and save</li>
'timezone' => 'Asia/Dhaka',
</ul>

### Database that must obey:

The work of the database must be done through migrate, but it cannot be directly modified by going to the database from database server.

### Extra Packages used:

1.

<hr>

### Project Version:

1.0.0

### Start Date:

19-May-2023

### Last Update:

19-May-2023

### Developed by:

Md. Rezwan Saki Alin
https://www.alinsworld.com/

### Used Tools:

Laravel v10.11.0, Bootstrap free admin template 'AdminLTE 2.3.0', PHP v8.2.3

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>

</p>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
