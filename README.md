# LaranZEDb-FrontEnd
Laravel replacement for the front-end (API and Website) of nZEDb

### Why?
Because why not. The nZEDb codebase is ancient and epic. The best way forward in my opinion is to wipe and start over. 
Beginning with a complete re-write of the front-end and separation of concerns. Each piece should be modeled and focused 
on it's job. Mixing of mulitple uses in one codebase adds needless complexity and makes the application difficult to scale
and configure for distributed environments.

### So you are duplicating all of nZEDb in Laravel?
Eventually, yes, but that is a long-term goal. At first we will be replacing the front-end with a new Laravel-based front-end.

### I can install now?
Nah. It's little more than the basic boilerplate laravel install at this point. We'll update this readme when we get closer 
to an actual Release Candidate. 

### Can I help?
Absolutely, feel free to pick a feature and submit a PR or post an issue to ask questions on what you should work on. Also 
you can pop into our IRC channel to discuss: #LaranZEDb on irc.synirc.net.

### Dev environment
We use laradock for deployment and development. 

Requires:
* Git
* Docker >= 1.12
* Docker-compose
* NPM (if you want to do front-end dev at all)
* Nothing else running on port 80, 3306, 27017, or 6379 (you can change the ports in the .env.laradock file)

Be sure to pull all sub modules:
`git clone --recursive git://github.com/LaranZEDb/Web-Api.git`

Create a symlink to the laradock environment file (should not need to be modified):
```
# From inside the project root dir:
$ ln -s ../.env.laradock ./laradock/.env
```

Spin up the necessary containers (this will take awhile):
```
$ cd laradock
$ docker-compose up -d nginx percona mongo redis  
```

Use the defaults from the `.env.dev` file:

`$ cp .env.dev .env`

Do application setup from inside workspace container:

```bash
$ cd laradock #if not already in this folder
$ docker-compose exec workspace bash
root@9b5d5d2af870:/var/www# composer install
root@9b5d5d2af870:/var/www# npm install
root@9b5d5d2af870:/var/www# php artisan migrate
root@9b5d5d2af870:/var/www# php artisan db:seed
root@9b5d5d2af870:/var/www# exit
```

(if NPM exists) Spin up laravel mix to compile JS and SASS files as well as auto-refreshing the browser on file modification:

`$ npm run watch`

Note: You may have to install yarn for that to work.

Voila, access your installation:

If using laravel mix, it should open automatically to `http://localhost:3000` otherwise type: `http://localhost`



