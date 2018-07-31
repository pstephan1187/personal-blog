---
title: Bash Alias for Creating a Laravel Project
slug: Create a Laravel Project from Anywhere and Open in VS Code with One Command
url: bash-alias-for-creating-a-laravel-project
date: 2018-07-31
image: ej-yao-194786.jpg
image_link: https://unsplash.com/photos/D46mXLsQRJw
photographer: EJ Yao
---

Whenever I create a new Laravel project, there are a number of things that I do in the terminal before I can start working on code:

1. Navigate to my `~/Sites/` directory
2. Create the Laravel App
3. Install NPM dependencies
4. Initialize git and make the first commit
5. Open in VS Code

I wanted to streamline that into one command. So I created a Bash alias/function to do everything for me: `nlp` (New Laravel Project). It will check if that project exists, automatically navigate to the `~/Sites` directory, create the project, install the dependencies (Composer and NPM), and open the project in VS Code all with one command. Below is the function in my `.bash_profile` file. Of course, edit the code to fit your needs.

```bash
function nlp() {
    DIR="$HOME/Sites"

    if [ -d "$DIR/$1" ]; then
        echo "Directory $DIR/$1 exists already."

        return 1
    fi

    cd $DIR
    composer create-project laravel/laravel --prefer-dist $1
    cd $1
    npm install
    git init
    git add -A
    git commit -m "Initial commit"
    code .
}
```

Usage: `nlp my-project-name`.

You can call the command from anywhere on your system and the project will be created in the `~/Sites` directory.

P.S. Don't forget to `source ~/.bash_profile` to load the new command into your current shell.
