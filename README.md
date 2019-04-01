# Camptix - Workshop Booking System

Adds a Workshop Booking System into Camptix, so that WordCamp attendees can book a seat.

## Features

* Compatible with multi-ticket sales.
* Set the number of seats each attendee can book.
* Booking confirmation before the event.

## Build Process

Requirements:

* [Node.js](https://nodejs.org) v8.9.1 or later.
* [npm](https://www.npmjs.com/get-npm) v5.5.1 or later.
* [Composer](https://getcomposer.org/) v1.8.1 or later.

To compile and generate the build files just execute the following command on your terminal:

```
npm run start
```

This will download the Node.js and PHP dependencies under `node_modules` and `vendor` folders respectively. Once executed, the previous command will continuously watch any change in JS/CSS files and re-build them.

The plugins also provides these additional commands:

* `npm run dev` Build files and watch for changes.
* `npm run build` Build files and minify JSS and CSS.
* `npm run lint-php` Run PHP_CodeSniffer on PHP files to detect errors.
* `npm run lint-php:fix` Run phpcbf to try to fix PHP errors.
* `npm run lint-css` Run `stylelint` on SCSS files to detect errors.
* `npm run lint-css:fix` Try to fix errors on SCSS files.
* `npm run lint-js` Run `eslint` on JS files to detect errors.
* `npm run lint-js:fix` Try to fix errors on JS files.
* `npm run lint` Run linting process on PHP, SCSS and JS files.
* `npm run update:packages` Update package dependencies in Node.js.

## License

Camptix - Workshop Booking System is licensed under the GPL v2 or later.

> This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License, version 2, as published by the Free Software Foundation.
>
> This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
>
> You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA

A copy of the license is included in the root of the plugin’s directory. The file is named `LICENSE`.

# Credits

Camptix - Workshop Booking System (`camptix-wbs`) was created in April 2019 by [David Aguilera](http://twitter.com/davilera/).

