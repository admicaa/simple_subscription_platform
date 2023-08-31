# Simple Subscription Platform

simple subscription platform(only RESTful APIs with MySQL) in which users can subscribe to a website (there can be multiple websites in the system). Whenever a new post is published on a particular website, all it's subscribers shall receive an email with the post title and description in it. (no authentication of any kind is required)

# Installation

1. run the following commands to install the application

```
git clone https://github.com/admicaa/simple_subscription_platform.git
cd simple_subscription_platform
composer install
cp .env.example .env
php artisan key:generate


```

2. Create a database and change the column `DB_DATABASE` in the .env file
3. run the following command to clear the configuration cache
   `php artisan config:cache`

## change your enviroment variables in .env file

1. Email Settings
    > you can follow this link for more configuration https://laravel.com/docs/8.x/mail

## you can run locally using the command

```
	php artisan serve
```

## seeders

you can run the following command ` php artisan db:seed --class=WebsitesSeeder` to make a Website, you can add more websites in the file `database/seeders/data/websites.csv`

## run the queue

you must keep the command `php artisan queue:work` running in a terminal, you can use PM2, supervisor, or nohub if you like to keep the queue working

## Send Notifications To Subscribers

you can run the following command to send notifications
`php artisan notifications:send`

## Other .ENV variable

    SEND_DIRECTLY=false

the default value of the `SEND_DIRECTLY` is `false`
send directly enable you to send notifications of new posts with no need to run the command

## Send Using CronJobs

you can run laravel scheduler by making a cronjob
`*  *  *  *  * cd /path-to-your-project && php artisan  schedule:run  >>  /dev/null  2>&1`

https://laravel.com/docs/10.x/scheduling#running-the-scheduler

# Subscribe a user to domain

you can use the following end point to subscribe users to custom domain
`api/subscribe`

## request headers

| Paramter | Description                            | Rules                                          |
| -------- | -------------------------------------- | ---------------------------------------------- |
| email    | subscriber email                       | required Valid Email Address                   |
| domain   | the domain the user wanna subscribe in | required, valid domain located in the database |

## example

```
import axios from "axios";

const options = {
  method: 'POST',
  url: 'http://localhost:5050/api/subscribe',
  headers: {'Content-Type': 'application/json', Accept: 'application/json'},
  data: {email: 'almestaadmica@gmail.com', domain: 'inisev.com'}
};

axios.request(options).then(function (response) {
  console.log(response.data);
}).catch(function (error) {
  console.error(error);
});
```

## response

```
{
	"id": 1,
	"email": "almestaadmica@gmail.com",
	"domain": "inisev.com",
	"deleted_at": null,
	"created_at": "2023-08-31T15:41:07.000000Z",
	"updated_at": "2023-08-31T15:41:07.000000Z"
}
```

# create a new post

you can use the following end-point `api/posts` to create new post

## request headers

| Paramter | Description                            | Rules                                          |
| -------- | -------------------------------------- | ---------------------------------------------- |
| title    | Post Title                             | Required                                       |
| website  | the domain the user wanna subscribe in | required, valid domain located in the database |
| body     | Brief Content of the Post              | required If No Post Link passed                |
| link     | URL to the post                        | required if no body passed                     |

## Example Request

```
import axios from "axios";

const options = {
  method: 'POST',
  url: 'http://localhost:5050/api/posts',
  headers: {'Content-Type': 'application/json', Accept: 'application/json'},
  data: {
    title: 'Hello world',
    body: 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis nam amet quia aliquam. Consectetur neque dolorum amet incidunt harum quod animi aperiam, sit voluptatum quam, doloremque totam nemo adipisci ab!',
    website: 'inisev.com',
    link: 'https://inisev.com/blog/the-new-rateitall-is-live/'
  }
};

axios.request(options).then(function (response) {
  console.log(response.data);
}).catch(function (error) {
  console.error(error);
});
```

### Example Response

```
{
	"website_id": 1,
	"title": "Hello world",
	"body": "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis nam amet quia aliquam. Consectetur neque dolorum amet incidunt harum quod animi aperiam, sit voluptatum quam, doloremque totam nemo adipisci ab!",
	"link": "https:\/\/inisev.com\/blog\/the-new-rateitall-is-live\/",
	"updated_at": "2023-08-31T16:36:30.000000Z",
	"created_at": "2023-08-31T16:36:30.000000Z",
	"id": 13
}
```
