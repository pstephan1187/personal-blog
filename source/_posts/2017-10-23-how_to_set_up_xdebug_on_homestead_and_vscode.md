---
title: How to Set Up Xdebug on Laravel Homestead and VSCode
slug: Debugging on your vagrant box from your IDE
url: how-to-set-up-xdebug-on-laravel-homestead-and-vscode
date: 2017-10-23
image: louis-blythe-192936.jpg
image_link: https://unsplash.com/photos/YPCY9HEP6V8
photographer: Louis Blythe
---

I have heard a lot about <a href="https://xdebug.org/" target="_blank" ref="nofollow">Xdebug</a> over the years, but never really took the time to play around with it. I've always been perfectly happy with just `dd()`ing stuff in my development environment. It's worked out fine so far, so why fix something that ain't broke. Recently, I happened upon another article about Xdebug and decided I would check it out. I currently use <a href="https://code.visualstudio.com/" target="_blank" ref="nofollow">Visual Studio Code (VSCode)</a> as my IDE. It comes with debugging built in and there is a Xdebug plugin available that makes setting up a breeze.

## Setup

#### Vagrant

The <a href="https://laravel.com/docs/homestead" target="_blank" ref="nofollow">Laravel Homestead</a> Vagrant box comes with Xdebug already installed. If you are using Homestead, you don't have to worry about any additional setup there.

Since you will be debugging code from a virtual machine it will technically be remote, so you don't even need Xdebug installed on your computer.

#### Browser

You will need to install an extension on your browser to enable xdebug remote debugging from your browser. I use Chrome and the <a href="https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc/related" target="_blank" ref="nofollow">Xdebug Helper</a> extension works great for me. If you use a different browser, you can try using one of the extensions below. I have not used any of them and cannot vouch for them, but they may work for you:

* **Firefox**: <a href="https://addons.mozilla.org/en-US/firefox/addon/the-easiest-xdebug/" target="_blank" ref="nofollow">The Easiest Xdebug</a> 
* **Safari**: <a href="https://github.com/benmatselby/xdebug-toggler" target="_blank" ref="nofollow">Xdebug Toggler</a> 
* **Opera**: <a href="https://addons.opera.com/addons/extensions/details/xdebug-launcher/?display=en" target="_blank" ref="nofollow">Xdebug Launcher</a> 
* **Edge**: `¯\_(ツ)_/¯`

For Chrome, once the plugin is installed, you should see a little bug <img src="/images/post-images/xdebug-vscode/chrome-toolbar-icon.jpg" alt="Chrome Toolbar Icon" width="31" height="32"> show up in the toolbar. Open your site in the browser, click on the icon, and select the "Debug" option. The icon should turn green. This will set the appropriate cookies to enable Xdebug remote debugging.

#### VSCode

You will need to install the <a href="https://marketplace.visualstudio.com/items?itemName=felixfbecker.php-debug" target="_blank" ref="nofollow">PHP Debug</a> Plugin for VSCode. Once installed, make sure to reload VSCode. Open up the debug tab and click on the "gear" icon at the top of the screen. A drop down of options should display. Click on "PHP". This will open up a `launch.json` file where you can save project specific configurations for debugging.

<img src="/images/post-images/xdebug-vscode/debugger.jpg" alt="VSCode Debugger" width="430" height="399">

```json
{
    // Use IntelliSense to learn about possible attributes.
    // Hover to view descriptions of existing attributes.
    // For more information, visit: https://go.microsoft.com/fwlink/?linkid=830387
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Listen for XDebug",
            "type": "php",
            "request": "launch",
            "port": 9000
        },
        {
            "name": "Launch currently open script",
            "type": "php",
            "request": "launch",
            "program": "${file}",
            "cwd": "${fileDirname}",
            "port": 9000
        }
    ]
}
```


There will be two default configurations. The first one will listen for Xdebug and attempt to open any files that it returns. This will work by default if you have Xdebug installed on your local box and use it for debugging things like PHPUnit tests.

The second option will launch the currently focused file and have Xdebug run on it. We will ignore this configuration for now (you can delete it if you'd like).

## Debugging

To launch the debugger, you will need to select your "Listen for XDebug" configuration from the dropdown <img src="/images/post-images/xdebug-vscode/vscode-debugger-dropdown.jpg" alt="VSCode Debugger Dropdown" width="206" height="32"> and press the "play" button. Before you press the play button though, you will want to set a breakpoint in your code. You can do this by pressing the red dot to the left of the line numbers in VSCode <img src="/images/post-images/xdebug-vscode/vscode-breakpoint.jpg" alt="VSCode Breakpoint" width="264" height="19"> (it will display when you hover over the space). A breakpoint tells xdebug to pause execution at this point and allows you to view and step through variables and the stack trace at the point that the script was paused.

If we were to press the play button at this point, Xdebug would halt execution at our breakpoint point (or an exception if the "everything" or "exceptions" boxes are checked in the lower left-hand corner). However, VScode would throw an error saying it cannot find the file. That is because it is looking for a file in the location this it resides on the virtual machine. To fix this, we can map the remote directories to the local ones so that VSCode knows which file to open locally.

I have homestead setup globally (as opposed to per site), and all my sites are located in the `Users/[my_user_name]/Sites` directory. So I can setup my `launch.json` config file to map the directories like so:

```json
{
    // Use IntelliSense to learn about possible attributes.
    // Hover to view descriptions of existing attributes.
    // For more information, visit: https://go.microsoft.com/fwlink/?linkid=830387
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Listen for XDebug",
            "type": "php",
            "request": "launch",
            "port": 9000,
            "localSourceRoot": "/Users/[my_user_name]/Sites",
            "serverSourceRoot": "/home/vagrant/Code"
        }
    ]
}
```

Note the `localSourceRoot` and the `serverSourceRoot` entries.

Now you can press that play button in the VSCode debugger screen. When you do, a control bar displays at the top of VSCode <img src="/images/post-images/xdebug-vscode/vscode-debug-control.jpg" alt="VSCode Breakpoint" width="209" height="32">. You can use this to control script execution once it is halted.

Now, reload your site in the browser. It should pause partly way through execution and return focus to VSCode where you see where the script halted. If the script halted at an Exception, you can uncheck "Everything" from the "Breakpoints" box in the lower left-hand corner of VSCode.

At this point we could browse through the stack trace and look at the variable values in VSCode. We can also continue the code one line at a time and step in and out of method calls (outside of the scope of this post). Press the play button in the controller, and execution should resume continuing until it hits the next breakpoint or execution ends.

## Conclusion

I find this method of debugging to be much more powerful. I have a much deeper view into what is happening in my code and how code progresses through the stack. I also find it easier because I don't have to constantly add and remove `dd`, `dump`, and `log` calls all throughout the code. I hope you find this as useful as I did. Leave a comment or question below to let me know what you think or if I was unclear about something. Thanks!
