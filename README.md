# Modular Demo App

A demo application to illustrate some concepts of a Modular App.

<p align="center" style="margin: 24px;">
    <a href="https://docs.ismodular.com" target="_blank">
    <img src="art/modular-demo-screen-black.jpg" alt="Modular Demo App" style="width: 100%; max-width: 800px;"></a>
</p>

<center>

[![Vue v3.x](https://img.shields.io/badge/Vue.js-v3.x-2f4053?style=for-the-badge&logo=vue.js&logoColor=39af78)](https://vuejs.org/)
[![Inertia.js v2.x](https://img.shields.io/badge/Inertia.js-v2.x-6765ea?style=for-the-badge&logo=inertia&logoColor=ffffff)](https://inertiajs.com/)
[![Laravel v12.x](https://img.shields.io/badge/Laravel-v12.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![Tailwind CSS v4.x](https://img.shields.io/badge/Tailwind%20CSS-v4.x-31b5f7?style=for-the-badge&logo=tailwind-css&logoColor=ffffff)](https://tailwindcss.com/)
[![Tests passing](https://img.shields.io/badge/Tests-passing-green?style=for-the-badge&logo=github)](https://github.com/daniel-cintra/modular/actions)

</center>

## The Demo App will provide you with examples of:

- The ACL (Access Control List) System.
- Some of the Custom Vue 3 Components, provided by Modular (Templates, Sidebar, Data Table, Form Components, Integrated Text Editor, Flash Messages, etc).
- How Laravel, Vue and Inertia.js communicate with each other.
- A possible way to organize the file structure of a Modular Project.
- Smooth transitions between pages.
- The GitHub repository for this demo app includes examples of workflows (GitHub Actions) to standardize the styles of the PHP files using Laravel Pint, and the Vue and JavaScript files using Prettier. There is also a workflow to handle tests. Feel free to check it out!

## Visit the Demo App

You can visit the Modular Panel Demo App (CMS) at [https://demo.ismodular.com](https://demo.ismodular.com).

And the Blog Demo PreviewApp at [https://demo.ismodular.com/blog](https://demo.ismodular.com/blog).

## Installation

Clone the repo locally:

```sh
git clone https://github.com/daniel-cintra/modular-demo.git modular-demo && cd modular-demo
```

Install PHP dependencies:

```sh
composer install
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Configure the database settings in your .env file according to your choice of database (MySQL, PostgreSQL, SQLite, etc.). If you want to use SQLite, create the database file:

```sh
touch database/database.sqlite
```

Run database migrations and seeder:

```sh
php artisan migrate:fresh --seed
```

Create a symlink to the storage:

```sh
php artisan storage:link
```

Copy the blog example images from `resources/images/blog` to `storage/app/public/blog`:

```
cp -r resources/images/blog storage/app/public/blog
```

Install NPM dependencies:

```sh
npm install
```

Build the assets:

```sh
npm run build
```

You're ready to go! Simply visit the URL configured in your `.env` file in your browser; the login form will appear with the fields automatically filled in.

## Hot Reloading

If you want to use hot reloading, to see the changes in the browser without having to refresh the page, run the following command (instead of `npm run build`):

```sh
npm run dev
```

## Tests

The tests provided by this Demo Application can be found in the `{moduleName}/Tests` directory. After installing the application, you can run the tests executing the following command from the project root directory in the terminal:

```sh
php artisan test
```

## Modular Documentation

You can find the full Modular documentation at [https://docs.ismodular.com](https://docs.ismodular.com).

## License

The Modular Project is open-source software licensed under the [MIT license](LICENSE.md).
