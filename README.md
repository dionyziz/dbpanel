dbPanel <https://github.com/dionyziz/dbpanel>

WHAT IS DBPANEL?

dbPanel is a MySQL administration web application in PHP. dbPanel can't do much
yet. It is open source and we'd love to have you help us out. The two goals of
dbPanel are:

 * Build an application that has carefully crafted human-computer interaction
   and overall behavior design for the users. A clear, minimal interface with
   attention to usability is what we're building. We want common actions to be
   done fast and with few clicks, ideally allowing keyboard navigation as well.
   We also want the communication from the software to be clear to the user, in
   a way that all information and actions are obvious and intuitive. Every-day
   operations should be easy and obvious.
 * Build an application that is very extensible. This means that the code is
   well-organized and well-architectured using principles of software design 
   for big projects, in a way that many people can contribute to it. We're
   splitting up the code in a modular way, always seperating business logic and
   presentation and building libraries as necessary. Any junior programmer
   should be able to extend parts of the software and understand the basic
   structure. We want many people to meaningfully contribute, and this is the
   only way.

For now, we do not care so much about the following:
 
 * Support for customizability (themes etc.)
 * Support for every single database feature out there
 * Internationalization

The key concepts to keep in mind are:
 * Easy
 * Intuitive
 * Fast
 * Minimal
 * Clear
 * Extensible
 * Organized
 * Modular

Installation
============
To install dbpanel, copy the files into a directory on your server. Then create a
file named settings-local.php inside the folder and edit it so that it contains
the URL where your dbpanel installation is located. For example:

<?php
    return array(
        'url' => 'http://developer.example.com/dbpanel/'
    );
?>

TODO: Remove this installation step.

You need Apache with mod_rewrite installed to run dbpanel. Your httpd must also be
configured to read the .htaccess files in your htdocs directory.

TODO: Add support for systems that do not have mod_rewrite.

Style
=====
It is essential that code written by a lot of people maintains a particular set of
conventions. Although every programmer has his own way of doing things, when it comes
to things like formatting, it is absolutely essentially that we stick to a standard.

If you want to contribute code to this project, you are expected to follow the rules
described at <http://dionyziz.com/Style>. Your pull requests will be rejected and you
will have to rewrite your code if you do not (which is okay).

Contribution
============
dbPanel is intended to be an open-source bazaar-style project where a lot of contributors
can cooperate. Work on your patches and pull request. You're welcome and expected to pull
request many times. Your pull requests will get rejected and you're expected to rework on
them before they get merged. Please accept this as part of your workflow and do not
hesitate to make many pull requests at will. Make bold edits often and do not be afraid
to repeatedly pull request and discuss them. This is the way an open source project

License
=======
dbPanel is licensed under the MIT license:

Copyright (C) 2012 Dionysis "dionyziz" Zindros <dionyziz@gmail.com> and the dbPanel contributors

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
works.
