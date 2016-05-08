# [Moxie Lean](https://github.com/moxie-leean/Leean/) [![Build Status](https://travis-ci.org/moxie-leean/Leean.svg?branch=master)](https://travis-ci.org/moxie-leean/Leean)

> Bare bones WordPress starter theme focused on modularity, scalability and performance.

Insipired in the amazing job from [digisavvy](https://github.com/digisavvy)
in [some-like-it-neat](https://github.com/digisavvy/some-like-it-neat).
As [Moxie](https://github.com/moxienyc) we decied to create something that
help us improve our workflow. 

We are focus on create custom platforms using [WordPress](https://wordpress.org/), 
this is the base of those platforms and that's why is focused in construct a 
platform for larger sites insted of a normal blog platform.  

## Content

- [Requirements](#requirements)
- [File Organization](#file-organization)
- [Installation](#installation)
- [Wiki](https://github.com/moxie-leean/Leean/wiki)
- [Contribution](#contribution)
 - [Colaborate](#colaborate)
 - [Error reporting](#error-reporting)

## Requirements

This theme has few requiremenents that you need to have in order to execute
the utilites inside of this theme.

- [php 5.4.x](http://php.net/)
- [node](https://nodejs.org/download/)
- [bower](http://bower.io/#install-bower)
- [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

Please make sure to have all of the latest version of software listed
above. 

## File Organization

Some of this files are ignored by default, because they are created during the 
installation phase and are not present in the structure of the repo, this 
structure represents the final structure after you have finish the installation 
process.

```
|- bin/ ------------------------> Shell scripts
|- node_modules/ ---------------> npm - gulp modules
|- bower_components/ -----------> js, css and html dependencies
|- vendor/ ---------------------> composer dependencies
|- assets/ ---------------------> js, css, sass and maps files.
|  |- js/ ----------------------> Different JS files
|  |  |- app/ ------------------> JS files from the project
|  |  |  |- main.js ------------> FIle that creates the basic of the JS
|  |- css/ ---------------------> Generated files after gulp compilation
|  |- maps/ --------------------> Generated source maps for sass and js
|  |- sass/ --------------------> Sass files
|- languages/ ------------------> Translations
|- inc/ ------------------------> PHP files or custom ones.
|- partials/ -------------------> Repeated views than can be reusable.
```

### Installation

To have the latest version of the theme you can clone the repo directly
where you plan to start to work: 

```shell
git clone git@github.com:moxie-leean/Leean.git
```

Or you can download the latest release from 
[the releases page](https://github.com/moxie-leean/Leean/releases).

Once you have the files you need to be on the theme path or theme
directory, then you need to install the `node`, `composer` and
`bower` dependencies in order to execute some utilities. You need to run
the following command from your terminal in the theme path: 

```shell
./bin/install.sh
```

**Note: Make sure to use the dot before the /bin/ directory to execute
the file inside of the theme bin directory**

You are going to be prompt you can reply with `1` or `0`, where `1` is
yes and `0` means no.

If you have any problem to run this shell script, try by copy and paste
the following commands in your terminal if the command above does not
work.

```shell
npm install && bower install && curl -sS https://getcomposer.org/installer | php && php composer.phar install && php composer.phar update && gulp js && gulp styles
```

Those commands are going to install the required dependencies of the
theme in order to allow other tools to work properly (like gulp).

## Gulp taks and other utilites

Please refer to this conten inside of [our wiki](https://github.com/moxie-leean/Leean/wiki) 
to learn about different tools we may have available on this theme as well with 
all of the available commands.

### [Wiki page](https://github.com/moxie-leean/Leean/wiki)

## Contribution

You're more than welcome to help in this project, you can help us by sending
fixes or by corecting typos or to request a new feature, if you found an error,
please create a [new issue](https://github.com/moxie-leean/Leean/new) with
the problem:

### Collaborate

1. Fork it
2. Create your feature branch (git checkout -b my-new-feature)
3. Commit your changes (git commit -am 'Add some feature')
4. Push to the branch (git push origin my-new-feature)
5. Create new Pull Request

### Error reporting

If you found a problem or you have a trouble using the theme please 
[open a new issue](https://github.com/moxie-leean/Leean/new) with the 
information of your problem, we will take a look at the problem as soon as 

