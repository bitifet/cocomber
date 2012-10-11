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

   All you need to do to get started with cocomber framework is to follow next simple steps:

   1. Create your new project directory in whatever directory reachable from your web server.

   2. Download Cocomber framework and put into /cocomber in your new project root directory.

   3. Create new /app directory to store your application's there.

   4. Copy any of the provided demo applications (you can find them at /cocomber/appdemo) to your /app directory.

   5. Symlink /app/<your_new_app>/controller.php as /<your_new_app>.php

   6. Play.


OVERVIEW:
========

   * /app/<your_app>/controller.php is your application controller. That is: The entry point for all of your application pages and http requests.
   * /app/<your_app>/routing.php is your routing controler.


FRAMEWORK STRUCTURE:
====================

Root directory:
---------------
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



APPLICATION STRUCTURE:
----------------------

  * ui/
  * tpl/
  * layout/
  * routing.php







/app
/app/demo
/app/demo/tpl
/app/demo/tpl/default.tpl.php
/app/demo/ui
/app/demo/ui/pages
/app/demo/ui/pages/default.ui.php
/app/demo/ui/widgets
/app/demo/ui/widgets/contents.ui.php
/app/demo/ui/widgets/menu.ui.php
/app/demo/ui/widgets/pages
/app/demo/ui/widgets/pages/page1.ui.php
/app/demo/ui/widgets/pages/page2.ui.php
/app/demo/ui/widgets/pages/page3.ui.php
/app/demo/ui/widgets/pages/page4.ui.php
/app/demo/ui/widgets/pages/page5.ui.php
/app/demo/routing.php
/app/demo/css
/app/demo/css/default
/app/demo/css/default/index.css
/app/demo/css/default/styles.css
/app/demo/main.php
/framework
/framework/internal
/framework/internal/ui
/framework/internal/ui/error.ui.php
/framework/internal/tpl
/framework/internal/tpl/default.tpl.php
/framework/internal/routing.php
/framework/internal/.routing.php.swp
/framework/lib
/framework/lib/jquery
/framework/lib/jquery/jquery-1.8.2.min.js
/framework/lib/jquery/jquery.js
/framework/lib/yawf
/framework/lib/yawf/yawf.js
/framework/controller.php
/framework/.controller.php.swp
/framework/LICENSE
/.git
/.git/refs
/.git/refs/heads
/.git/refs/heads/master
/.git/refs/tags
/.git/refs/remotes
/.git/refs/remotes/origin
/.git/refs/remotes/origin/master
/.git/hooks
/.git/hooks/pre-commit.sample
/.git/hooks/update.sample
/.git/hooks/applypatch-msg.sample
/.git/hooks/prepare-commit-msg.sample
/.git/hooks/pre-rebase.sample
/.git/hooks/post-update.sample
/.git/hooks/commit-msg.sample
/.git/hooks/pre-applypatch.sample
/.git/branches
/.git/description
/.git/info
/.git/info/exclude
/.git/HEAD
/.git/config
/.git/objects
/.git/objects/pack
/.git/objects/info
/.git/objects/8c
/.git/objects/8c/5df9b72235d7d00db54ec92e7987d11d8e2ed4
/.git/objects/8c/f6e98547819f47abf3f9dafeecc97fd3aef813
/.git/objects/9b
/.git/objects/9b/5de0d434cdeebcbcb043b34bda5d732381fa08
/.git/objects/56
/.git/objects/56/0b883da70cb3c9a1909b6e0631785eaf4ec2c6
/.git/objects/27
/.git/objects/27/e248c1d7f0f578577f4832ebf966c41aa13975
/.git/objects/fe
/.git/objects/fe/41dbe825d0797593329ae6d36fc24f547f1ad8
/.git/objects/bd
/.git/objects/bd/9b0ae072a2008fb641c9f50d4ca2bdc112a45a
/.git/objects/86
/.git/objects/86/7fd3c9fafc3b0139a4108e50426d5e31562ab4
/.git/objects/86/79e2136b2d465912c4a8723c8d1f3cd5a168bb
/.git/objects/7e
/.git/objects/7e/cbedf45b220803fad4ae1e4af2b275a793bf40
/.git/objects/e4
/.git/objects/e4/92b4b3d4d41c1be98a131c0a32605aa6d93ae0
/.git/objects/00
/.git/objects/00/3b3c0d96f53ec1ef59839132b0762f1f902aec
/.git/objects/48
/.git/objects/48/05ad681f50c0137187d076b37ce914a9e02590
/.git/objects/48/f4149563ceff025f616ead221fa95da34f20e9
/.git/objects/66
/.git/objects/66/39b074ae6078fd9b997948eb5cb3cfb421650b
/.git/objects/66/e74df7d35957d3d6377a816472458936fca5fc
/.git/objects/c4
/.git/objects/c4/23d7a521c0dbf7e6db83612db0d0a5382cfba5
/.git/objects/10
/.git/objects/10/5ff8729874fb63c741e97b7400278550753de5
/.git/objects/6b
/.git/objects/6b/48af299721c6e5e5001883d306518547954369
/.git/objects/cd
/.git/objects/cd/badb1561862198b3eb2d23223c7a9b5e59a07a
/.git/objects/cd/bdbc2282aec7a1d1371290938de1394801ff81
/.git/objects/c3
/.git/objects/c3/ac9a4ef44043ef2ae7e48e43f893b2c1eb50fd
/.git/objects/50
/.git/objects/50/3e74069fb3fabf772c35e415e80959c001b525
/.git/objects/38
/.git/objects/38/7419774e563603da1685415fde7ed6aacfc59f
/.git/objects/81
/.git/objects/81/cf524c8b6d2f0253656a6182de4ff0980e04aa
/.git/objects/f6
/.git/objects/f6/5cf1dc4573c51e54d7cf3772d06caf96726616
/.git/objects/91
/.git/objects/91/81aa01675c6b2e264e9430d47712beb7f6c639
/.git/objects/d8
/.git/objects/d8/987797f1373ff6fd96fe0499fd4236a2115bae
/.git/objects/77
/.git/objects/77/1196e4fbe4e276bdf7a984cd881e5a466a1a37
/.git/objects/85
/.git/objects/85/62098229fa99a139d68f854f5793d2bc02850a
/.git/objects/6f
/.git/objects/6f/2343c9d7eab8947b7e3c38a8f3368439790ece
/.git/objects/c9
/.git/objects/c9/b814c647dabb0e65ac64de633f468f30a1e596
/.git/objects/b0
/.git/objects/b0/089bf2d23860ccfa75ba246f6f44c6f1162980
/.git/objects/0a
/.git/objects/0a/e302638917290590dfae18f8170aca099b0c6f
/.git/objects/28
/.git/objects/28/fa9d229909247f6693cea3a3c43ea522b84a14
/.git/objects/ad
/.git/objects/ad/ffff7f9080b5981c3835e0e169d011dc9ea5f7
/.git/objects/b9
/.git/objects/b9/219b09c4afc860aa683b01c10c7e2b9dd47be3
/.git/objects/41
/.git/objects/41/791f1925603adeb1fe5d04e8a5fa593987ca03
/.git/objects/40
/.git/objects/40/39accc4543658ff06cc87cb3c70a6fabeb1d72
/.git/objects/b8
/.git/objects/b8/68a69c50d246e7de168e318c30e23082844f36
/.git/objects/74
/.git/objects/74/685685f2eca5fc9f1ce2e5decec88fd6972ea5
/.git/objects/ba
/.git/objects/ba/51ec9a98b2af48dd4458cf5be8c4fd18344200
/.git/objects/82
/.git/objects/82/5a5df43a4274e92f54cec2c2fe4c39c06b54a6
/.git/objects/44
/.git/objects/44/0740778f5572ea074fda18c5c8be934f351a9a
/.git/objects/a4
/.git/objects/a4/817fc7ed5a9cabe9113b08b7f39fb22c82c7f1
/.git/objects/a4/e15d604387ffc82de00304dbedbc3413732ace
/.git/objects/e6
/.git/objects/e6/9f194033416cfe1514aa20accd5057a5f8fe79
/.git/objects/a3
/.git/objects/a3/ef5c13511fddb157fddd7ba2c4b31ec45a23de
/.git/objects/55
/.git/objects/55/06e6d65e3adaf8eded195e97e7f6aa6e1e9dee
/.git/objects/a7
/.git/objects/a7/233b3519051132acf628d69d7908c78717e60d
/.git/objects/94
/.git/objects/94/a9ed024d3859793618152ea559a168bbcbb5e2
/.git/objects/af
/.git/objects/af/231d29eac85307a5859cf4916e004d58c33e78
/.git/objects/fb
/.git/objects/fb/5366df284cb611a3c405475f7cda22635f7e22
/.git/objects/0e
/.git/objects/0e/cec078e169af6b9ac8867dc16f7931df05b012
/.git/objects/89
/.git/objects/89/6fbb0fdcaa3cbca63e48f7e69b444bc118cf0a
/.git/objects/d5
/.git/objects/d5/23c016b04dbc86c5eaef2a2fc4cd8b4f04aa83
/.git/objects/4f
/.git/objects/4f/81be496c6bd74e25b13941954177e3f7d1de45
/.git/objects/49
/.git/objects/49/00ce53b1bada9596fa7b61da0407402a620d84
/.git/index
/.git/logs
/.git/logs/refs
/.git/logs/refs/heads
/.git/logs/refs/heads/master
/.git/logs/refs/remotes
/.git/logs/refs/remotes/origin
/.git/logs/refs/remotes/origin/master
/.git/logs/HEAD
/.git/COMMIT_EDITMSG
/.git/FETCH_HEAD
/.git/ORIG_HEAD
/demo.php
/README.rst
/.notes.otl.swp
/doc
/doc/.GettingStarted.rst.swp





BASIC CONCEPTS:
===============

   User Interface (UI)
   Template
   Layout

