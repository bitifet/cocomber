==================
Cocomber Framework
==================
   :Date: Thu20121011-1705
   :Version: 0.1_alpha
   :Authors: - Joan Miquel Torres<joanmi@bitifet.net>

=====================
Getting started guide
=====================


INTRODUCTION:
=============

FEATURES:
---------

   ...


PREREQUISITES:
--------------

   * PHP enabled web server.


SETUP:
------

   All you need to do to get started with cocomber framework is to follow
   next simple steps:

   1. Create your new project directory in whatever directory reachable
         from your web server.
   2. Download Cocomber framework and put into /cocomber in your new
         project root directory.
   3. Create new /app directory to store your application's there.
   4. Copy any of the provided demo applications (you can find them at
         /cocomber/appdemo) to your /app directory.
   5. Symlink /app/<your_new_app>/controller.php as /<your_new_app>.php
   6. Play.


OVERVIEW:
========

APPLICATION STRUCTURE:
----------------------

   * /app/<your_app>/ui/               - Application UIs
   * /app/<your_app>/tpl/              - Application templates 
   * /app/<your_app>/layout/           - Application layouts 
   * /app/<your_app>/controller.php    - Your application controller.
   * /app/<your_app>/routing.php       - Your routing controler.
   * /app/<your_app>/...               - Other (static) data: css, js...



BASIC CONCEPTS:
---------------

   Layout
      Surrounding part of the response contents, usually common for all of
      the application pages or, at least, for a group of them. Can contain
      as many UIs as you want (which will appear in all pages using this
      layout) and MUST place the page contents by interpoling the
      $page_contents variable.
      You can have bunch of layouts and switch between them by your
      routing policy. The default is to have single common layout for pages
      and none for ui's.

   Template
      Templates are used to render the result of the UI's when it returns
      it as an array. All of its keys are expanded to '$tpl_' preffixed
      variables which the template must render in the right place.

   User Interface (UI)
      Small piece of (can be php-generated) HTML code implementing a
      concrete part or whole page contets.
      UIs can return:
         - Nothing (or boolean false), in which case they must directly
           output its html result (no template or layout will be applyed
           in this case).
         - An array whith the data to be rendered by the corresponding
           template and then surrounded by the applicable layout.
         - A yet formatted output to be surrounded by layout (bypassing
           templating process).

CONTROLLER:
-----------

The controller is the entry point for all of your application pages and
http requests.
It is the core of any web applicattion based on this framework. 
Each application must be placed in /app/<app_name> directory and must have
an entry point script named 'main.php'.  
This entry point file is symlinked from http_root directory and includes
and instantiates the framework's controller.

Example of typicall main.php file:
::
  <?php
  namespace CocomberFramework;

  require_once ('cocomber/lib/cocomber/controller.php');

  isset ($_SESSION['cocomber_fw'])
  || $_SESSION['cocomber_fw'] = new Cocomber (array (
     'app' => 'demo',
     'title' => 'COCOMBER demo',
     // 'style' => 'default',
  ));
  $c =& $_SESSION['cocomber_fw'];

  $c->set_layout ('title', "Cocomber Framework DEMO");
  $c->set_layout ('heading', "Cocomber Framework DEMO");

  $c->render();

 
ROUTING:
--------

Roting is the policy that follows your application to to instruct
framework about three important parameters which will determine the rest
of the request processing.

This parameters are:

   User Interface:
      Relative path from app/ui/ to the requested user interface.

   Template:
      Relative path from app/tpl/ to the template to be applyed (user
      interface can avoid it).

   Layout:
      Relative path from app/layout to be applyed (user interface and
      template can avoid it).


Each cocomber application must have a *routing.php* file in its root
directory implementing application's routing policy.

Cocomber framework comes with a default (and simple) routing
implementation at cocomber/appfw/routing.php. For most applications,
including this in its routing.php file, would be enought. But you can
take a copy of this and modify it or completely rewrite to accomplish
your needings if you want.

The mission of routing.php is to return an array with the below three
parameters calculated in function of url data, but it can also look for
other data like cookies, referer, etc...


DEFAULT ROUTING IMPLEMENTATION:
-------------------------------

Default routing implementation is too simple (but powerfull enought for
most web applications).

Suppose your front controller (the root link to it) is accessible via the
following url:

::
   http://example.com/my_app.php

Then, whenever you request this url, default routing policy will return
the following result:

   User Interface (UI): pages/default.ui.php Template:
   pages/default.tpl.php Layout: default.layout.php

This means that user interface in app/my_app/ui/pages/default.ui.php
will be executed.

Then app/my_app/tpl/default.tpl.php will be rendered using the data
returned by the ui.  But, alternatively, ui can directly generate
rendered output and avoid any template to be used.

Finally, the app/my_app/layout/default.layout.php layout will be applyed
and the result will be sent to the browser.



USER INTERFACES (UI):
=====================

User interfaces are small pieces (files) of php code placed inside
app/my_app/ui which are used to implement any specific part of your
application.

They can directly output html (or other kind of data) or return an array
with the data to be rendered by corresponding template.

The simplest way to implement an UI is to directly output rendered html
and do nothing more.

But you can also use templates or control if the global layout is
applyed or not. This is controlled by an (optional) return stament at
the end of its processing.

The type of the return value determines the *mode* in which framework
will threat UI's output and return value itself.

UI Modes:
---------
 
  WARNING: This is the current approach, but it can (and sure it will
  be) change in a near future...


  *notpl*
    Output is directly rendered by UI. No template is processed.  This
    mode is triggered returning NUMERIC 1 or not executing any return
    stament at all.

  *changelayout*
    Normally, the layout used to envolve the (template-rendered or not)
    output is defined by routing policy. But you can "manually" change
    the used layout directly from the UI simply by returning a STRING
    with the layout name. Obviously you cannot use any template in this
    case (except if you apply it by hand).

  *nolayout*
    Alternatively, you can disable the layout rendering by simply
    returning empty string (this is simply an specific case of
    "changelayout".

  *http_error_code*
    Returning numeric value, it will be interpreted as http error code
    and it will trigger different actions accordingly with the returned
    code.  For example, a 304 ("Not modified") will cause this header to
    be sent to the browser and no other output to be generated (even if
    echoed within UI).  404 will trigger a Not Found error page
    discarding output.  Also, a numeric 0 will be remapped to 404
    becouse it is the return code of a failed include() stament (this
    way, calling an unexisting UI will automatically generate a 404 Not
    Found error).


FRAMEWORK ARQUITECTURE:
=======================

FRAMEWORK STRUCTURE:
--------------------

   * lib/
   * doc/
   * appdemo/
   * appfw/
   * LICENSE
   * README.rst

/lib:
-----

   Cocomber framework and third party librarys.

   Contains:
      * cocomber/
        - Cocomber framework core librarys.
      * jquery/
        - Third party library jquery.


/doc:
-----

   Framework documentation.



appdemo/
--------

   Miscellaneous application demos.


appfw/
------

   Internal application pages.

   Proviede some internal default widgets and pages such as 404 and other error pages to make framework experience more confortable even before having your application setup fully completed.


LICENSE
-------

   Licensing info.

