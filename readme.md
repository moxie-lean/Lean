# Moxie Lean

> Bare bones WordPress starter theme focused on modularity, scalability and performance.

Insipired in the amazing job from [digisavvy](https://github.com/digisavvy)
in [some-like-it-neat](https://github.com/digisavvy/some-like-it-neat).
As [Moxie](https://github.com/moxienyc) we decied to create something that
help us improve our workflow, we are focus on develop platforms
using [Wordpress](https://wordpress.org/), so this is the base of those
platforms and that's why it's focused in construct a platform for larger
sites insted of a normal blog platform.

## Content

- [Requirements](#requirements)
- [Installation](#installation)
- [Commands](#commands)
- [Set Up](#set-up)
- [Gulp Tasks](#gulp-taks)
  - [styles](#styles)
  - [compile-css](#compile-css)
  - [minify-css](#minify-css)
- [Contribution](#contribution)
 - [Colaborate](#colaborate)
 - [Error reporting](#error-reporting)

## Requirements

The theme has few utilities that need you to have

- [node](https://nodejs.org/download/)
- [bower](http://bower.io/#install-bower)
- [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

### Installation

To set up you need to clone the theme where are you going to
install the theme with:

```shell
git clone git@github.com:moxienyc/Lean.git
```

## Commands

Inside of the theme there a few utilities that will make your life easier
to write code and different tools to set up. We have a set of taks handled
using gulp, so we use gulp to compile, minify and sniff the code as examples.
This commands needs to be run in the theme directory and most are using the terminal.

## Set up

To install the required files and dependencies just run:

```shell
./bin/install.sh
```

In your terminal so make sure you are in the theme directory to install the node and bower dependencies. This script run the following commands:

```shell
npm install && bower install
```

Tyr the second way if you are not able to use the first way. Those commands
are going to install the required packages and versions of each packackge
to allow other tools work properly (like gulp).


## Gulp taks

There few gulp taks than are useful we list the taks as we guess are more
common use and with a description of what the task can do if you
want to run the task by separate, a gulp taks it's executed using:

```shell
gulp <task-name>
```

Where `<task-name>` it's the name of the task to use.

### styles

```shell
gulp styles
```

With this gulp task, you can compile the sass files and minify the output,
this task has one dependency: `minify-css`, this task has another
dependency `compile-css` so the order of execution is as follows:

1. compile-css
2. minify-css
3. run notification

### compile-css

```shell
gulp compile-css
```

This gulp task compiles the `assets/sass/style.scss` file. The task
produces a file `style.css` this file has a source map and it's added
only in the development environment.

Another thing that this task does it's added th autoprexier to the
required CSS.

**Note:** The sourcemaps are stored in the `assets/maps` directory.

### minify-css

```shell
gulp minify-css
```

This gulp task creates a minified version of `assets/css/style.css`,
this minified version does not have any sourcemap associated, and this
is the version used in production.

Another thing that this task does it's added th autoprexier to the
required CSS.

**Note:** The sourcemaps are stored in the `assets/maps` directory.


## Contribution

You're more than welcome to help in this project, you can help us sending
fixes to or to correct typos or any new feature, or if you found an error,
please create a [new issue](https://github.com/moxienyc/Lean/issues/new) with
the problem:

### Collaborate

1. Fork it
2. Create your feature branch (git checkout -b my-new-feature)
3. Commit your changes (git commit -am 'Add some feature')
4. Push to the branch (git push origin my-new-feature)
5. Create new Pull Request

### Error reporting

If you found a problem or you have a trouble using the theme
please [open a new issue](https://github.com/moxienyc/Lean/issues/new) with
the information of your problem, we will take a look at the problem
as soon as possible.

