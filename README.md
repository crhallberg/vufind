VuFind MMO
==========

Introduction
------------

For April Fool's Day, I cooked up some simple fun in VuFind.

If you're on the same page/record/search as another user, this will show their mouse cursor on your screen. Movement and all!

Installation
------------
Switch to/Merge with this branch in VuFind, enable a Bootstrap theme.

You'll need Node.js to run the server: http://nodejs.org/

Create a folder on your server, with the server.js in it (found in the Bootstrap theme under js)

In that folder, run:

	npm install socket.io
	npm install forever
	forever start server.js

Enjoy. :)