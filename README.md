### DEPLOY PROJECT ON LOCAL

What ports are used on the host system?
* 7777 - Development PHP server
* 6666 - MySQL-server
* 8888 - Swagger

~~~
git clone https://github.com/iNeedNew/todo-list.git
~~~

~~~
cd todo-list
~~~
~~~
cp .env.example .env
~~~
Resolve Permission denied to storage folder
~~~
chmod 777 -R storage
~~~
~~~
docker-compose build
~~~

~~~
docker-compose up -d
~~~

~~~
docker exec -it app composer update
~~~

~~~
docker exec -it app php artisan key:generate
~~~
~~~
docker exec -it app php artisan jwt:secret
~~~

~~~
docker exec -it app php artisan migrate
~~~

[//]: # (If you need test data on a project)

[//]: # (~~~)

[//]: # (docker exec -it app php artisan db:seed )

[//]: # (~~~)
Start development server in container
~~~
docker exec app php artisan serve --host 0.0.0.0 --port 8000
~~~

### REST API documentation

#### http://localhost:8888
