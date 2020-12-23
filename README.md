# Fiddly web application

The fiddly project. Project based on a webshop for a project on school.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Installing

A step by step series of examples that tell you have to get a development env running

Clone the repository to your computer, in any desired directory.
```
git clone https://gitlab.com/avansfiddly/periode4.git
```
After cloning this repository to your computer you need to have Yarn. If you don't have Yarn package on your computer you need to install Yarn first.
```
https://yarnpkg.com/en/docs/install
```
Yarn will have all the dependencies installed and will run gulp. Also this will call composer and install php packages such as PHP Unit. 

In order to make this project run on your environment you need to change a few files. Copy the next commands in your commandline separately.
Then change the files to your personal environment if needed.

from the root of the project ->

for config file 
```
cd app/config
cp example.config.php config.php
```
for .htacces file
```
cd /public
cp example.htaccess .htaccess
```
for gulp config file
```
cp example.gulp-config.json gulp-config.json
```

When you changed your files to your personal environment needs, you can run yarn start from the commandline.
```
yarn start
```

## How to
Front-end tools are compiled with gulp tasks. When you have yarn start run it will automatically update all the files and changes you make in the
source map(src). Files will be compiled to the public map where the application will be rendered. 

Back-end tools are in the 'app' root. Here you will find our own custom made mvc. Which obviously works with controllers models and views.
We have a library which insures you for clean urls. And is also provided with a translation module. In the map Helpers you will find various function which are helpers for
classes and modules. Just to make life a little bit easier. 

For translation u can use the function t_() in every situation and in every file. 

For installing the database and dummy content you just can easily go to __your_url__/install this will automatically start installing the database with dummy. 
You can set this up whenever and after you set up your config file.  
 
 
## Deployment

When deploying we need to remove the install directory in public map. You need to upload the following directories and files. 

* app/
* public/
* .htacces

## Built With

* [Bootstrap 4](https://getbootstrap.com) 
* [Gulp](https://gulpfile.org)
* [Browser-Sync](https://www.browsersync.io) 
* [Sass](http://sass-lang.com) 
* [Babel](https://babeljs.io)
* PHP Unit

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Authors

* **Jeremy-Percy** - *Initial work* - [JeremyPercy](https://github.com/JeremyPercy)
* **Martijn Dijkgraaf** - *Initial work* -
* **Maarten Ceyssen** - *Initial work* - 
* **Yoshua Weijl** - *Initial work* - 

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

