



#  WRATS
Version 0.1

Initial Discovery project: RS21 was contracted by the New Mexico Office of the State Engineer (OSE) to conduct a detailed discovery and requirements gathering process to identify opportunities for improvement for a modernized Water Rights Adjudication Tracking System (WRATS) application. 

RS21 conducted a thorough discovery research analysis, which identified critical needs for OSE and the 25-year-old WRATS application in the areas of modernization, data management, data and applications integrations, document generation and maintenance, improvements to analysis functions, and updated business processes.

This app is Phase 2 of the project: Implementation.

*  Laravel 11
*  Laravel Breeze
*  Alpine JS
*  Livewire
*  Bootstrap

Welcome to the Team!

## Important Project Links

- **[RS21 project Wiki](https://resilientsolutions21.sharepoint.com/sites/RS21/Shared%20Documents/Forms/AllItems.aspx)** 
- **[OSE Sharepoint ](https://rtsolutions1.sharepoint.com/sites/OSE/Shared%20Documents/Forms/AllItems.aspx)** 


##  Software Development Methodology
Maintainability is king. The development team at OSE have been maintainng the predecessor to this app for 25 years. We will build this project assuming that it will have a similar life cycle. 

Laravel has a major version update every 1-2 years, and PHP has a major version update every year, and deprecates (stops security updates) the PHP version that is 5 years old.  Because laravel versions have PHP dependencies, we can anticipate OSE having to do a major maintenance update (update PHP syntax to newest version, and Laravel to latest version) at least once every 5 years. 

That can be a big lift in both time and risk. Think hundreds of hours. There is a product called **[Laravel Shift](https://laravelshift.com/)** that will automate a lot of this process, but to leverage it, and similar tools, we have to follow Laravel best practices and be very lean on thrid party dependant libraries.

### Git Strategy
Because we are going to have specific user acceptance testing events on discrete deliverables, we will use the **[Git Flow](https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow)** work flow, so we can easily segregate and deploy specific release candidates. 


### Development Guidelines 
We will be using these for our guidelines on the Peer Review process.
- **[OSE Development Standards ](https://rtsolutions1.sharepoint.com/:w:/r/sites/OSE/Shared%20Documents/2023_08_03_OSE%20Development_Standards%20-%20Current%20CO%20OSE.docx?d=w5a3b7aa8e816448586d26e5aeab8f72e&csf=1&web=1&e=L2kgWH)**   
- **[OWASP top 10 Web Software Security Standards ](https://owasp.org/www-project-top-ten/)**   
- **[Laravel Best Practices ](https://github.com/alexeymezenin/laravel-best-practices)**   

All PHP code should be formatted to the PSR-4 standard. We have a tool that you should **[Pint](https://laravel.com/docs/11.x/pint)** run pre-commit to massage your source code. Usage `./vendor/bin/pint -v`.

I would mention SOLID, DRY and KIS here too, but they are covered in the OSE Development standards.



### Training Resources
To keep everyone on the same page and optimize on-boarding of new engineers. We will recommend content on the Laracasts platform as it is the defacto training tool for Laravel (referenced on the laravel.com site). This content does require a subscription, but in our opinion it is worth it. 
- **[PHP Introduction](https://laracasts.com/topics/php)**
- **[Laravel Introduction](https://laracasts.com/series/30-days-to-learn-laravel-11)**


### Setting up your local environment
We will be running this project locally using docker and MySQL, to support developers on Mac's. 
Please install :
- **[Docker Desktop](https://www.docker.com/products/docker-desktop/)**
- **[MYSQL ODBC Connector](https://dev.mysql.com/downloads/connector/odbc/)**
- **[Your MySQL client of choice (I like DBeaver)](https://dbeaver.io/)**

Once you download your git repository, you can run the following commands to spin your local environment up:
```
docker compose up -d 
php artisan migrate
php artisan db:migrate
```
Your database table storage will live in .\mysql_data inside of your application root. Spinning the environment up and down won't break your data, but if you delete that folder your mysql instance will need to be restarted, and you will have an empty database. 

Useful Docker commands:

To see running Docker Containers
```
Docker PS
```
To stop all containers
```
docker stop $(docker ps -a -q)
```
To remove all containers
```
docker rm $(docker ps -a -q)
```
To build fresh containers (once you build one, it gets cached and re-used between up and downs)
```
docker compose build --no-cache  
```
To log into the containers CLI context (versus your laptops)
```
docker compose exec mysql bash
Or
docker compose exec app bash
```

### A Note on Auditing 
We are using the  **[Laravel Audit package](https://https://laravel-auditing.com/)** to track changes to our database. 

This works only when changes are made through the Laravel ORM (Eloquent), specifically when changing data via the web interface.

// Using Eloquent model (will trigger audit log)

```
$user = User::find(1);
$user->name = "Updated Name";
$user->save();
```

// Using DB facade (will also trigger audit log)
```
DB::table('users')->where('id', 1)->update(['name' => 'Updated Name']);
```

But if you change data directly in the database (e.g. via a SQL query), the audit log will not be triggered.
Also if you change data via the artisan LI, the audit log will not be triggered.




