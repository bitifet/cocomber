========
COCOMBER
========

-----------------------------------------------------------------------------------------------
Easy to use and LightWeight PHP-JQuery based web framework.
-----------------------------------------------------------------------------------------------

DISCLAIMER
==========

   - This is ONLY a draft nowadays.
   - First alpha version with a few working features.
   - Not yet ready to production usage.
   - Not yet well documented or explained.
   - Too many things may change in the future. And sure some of them will do.
   - Too many ideas remaining in my head not yet implemented or written anywhere.


Abstract
========

This is an attempt to implement a (I think) new concept of web framework based on "meaningful" html widgets reducing the overhead usually involved in web application development.

It's hardly based on JQuery javascript framework and pretend to simplify the process of building web interfaces.


TODO: Improve/complete description.




A few provisional abstract.
---------------------------
    
Basic structure of the framework:

Root directory contains:
/framework   - "Real" framework infrastructure.
/app         - Applications directory (one directory per each).
(Some symlinks to front controllers*)
    
NOTES:
-----
   * /framework contains all the framework infrastructure.
   * /app contains (for now one) demostration application which
      can be entirely removed or copyed/renamed to be used as
      starter layout.
   * Each application must contain at least:
      - main.php: Front controller file.
      - routing.php: Routing policys which usually will be be a simpple
          symlink to the default framework's routing implementation (but
          can be easily replaced by customized implementation) if needed.
      - ui: Directory to store the user interfaces.
      - tpl: Directory to store the templates.
   * Front controllers:
      - Must be placed, each, at /app/{app_name}/main.php
      - Usually will only contain a few configuration data and and
          include() to the framework's default controller.
   * User interfaces (ui)s are simple html files whithout any document
     structure or headers. But can contain special elements (typically
     <DIV>s) identified by 'class="ui"' and referencyng other ui's by
     its id which will be automatically loaded. EXAMPLE:
      - <DIV class="ui" id="forms/users/permissions" will automatically
          load ui/forms/users/permissions.ui.php of the current
          application just after parent document's DOM get's loaded
   * In the future, ui's could be updated (reloaded) by events, etc...
   * Now is yet possible to make controls to dynamically load/change
     ui's with as simple anchor like this:
      - <a class="ui" href="report/pages/14" target="#container">
      (container doesn't need to be of 'ui' class).
   * And (I hope) much more in a near future...


TODO:
----

  * Change the project (and some files name). Yet 'YAWF' ('Yet Another Web Framework') to a better name (proposed 'Cocomber').
  * Review yawf.js (or cocomber.js ;-)): $(document).ready() must become new "general purpose" uisetup() (see code to understand).
  * Review anchor's operation (enable new html parameter (ex: mode="mouseover") making possible to select trigger event).
  * Add parametyzaton for http headers (new $fw_http_header similar to $fw_html_header) and parametyze most common ones (encoding...).
  * Make a good documentation.
  * Add support for much more widgets ;-)
    * Some ideas().
      * <select class="ui" id="my_select" GET="field1_id field2_id...">
         - Automatically will attach events to specified fields which will trigger select contents reload on each of its change events.
         - This reload will send this fields values by GET method.
         - There will be similar POST="..." to do the same via POST (more binary safe but not cacheable by browser).
      * ui forms could have another ui as target which will be reloaded on form submit (like anchors nowadays).




