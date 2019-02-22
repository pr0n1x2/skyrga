const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
    'resources/assets/global/plugins/font-awesome/css/font-awesome.min.css',
    'resources/assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
    'resources/assets/global/plugins/bootstrap/css/bootstrap.min.css',
    'resources/assets/global/plugins/uniform/css/uniform.default.css',
    'resources/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
    'resources/assets/global/plugins/datatables/datatables.min.css',
    'resources/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',
    'resources/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
    'resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
    'resources/assets/global/plugins/bootstrap-toastr/toastr.min.css',
    'resources/assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css',
    'resources/assets/global/css/components.min.css',
    'resources/assets/global/css/plugins.min.css',
    'resources/assets/layouts/layout/css/layout.min.css',
    'resources/assets/layouts/layout/css/themes/darkblue.min.css',
    'resources/assets/apps/css/todo-2.min.css',
    'resources/assets/pages/css/login-2.min.css',
    'resources/assets/layouts/layout/css/custom.css'
], 'public/css/app.css');

mix.scripts([
    'resources/assets/global/plugins/jquery.min.js',
    'resources/assets/global/plugins/bootstrap/js/bootstrap.min.js',
    'resources/assets/global/plugins/js.cookie.min.js',
    'resources/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
    'resources/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
    'resources/assets/global/plugins/jquery.blockui.min.js',
    'resources/assets/global/plugins/uniform/jquery.uniform.min.js',
    'resources/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
    'resources/assets/global/scripts/datatable.js',
    'resources/assets/global/plugins/datatables/datatables.min.js',
    'resources/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js',
    'resources/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
    'resources/assets/global/plugins/jquery-validation/js/jquery.validate.min.js',
    'resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
    'resources/assets/global/plugins/bootstrap-toastr/toastr.min.js',
    'resources/assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js',
    'resources/assets/global/scripts/app.min.js',
    'resources/assets/layouts/layout/scripts/layout.min.js',
], 'public/js/app.js');

mix.copy('resources/assets/global/plugins/respond.min.js', 'public/js/respond.min.js');
mix.copy('resources/assets/global/plugins/excanvas.min.js', 'public/js/excanvas.min.js');

mix.copy('resources/assets/global/plugins/font-awesome/fonts', 'public/fonts');
mix.copy('resources/assets/global/plugins/simple-line-icons/fonts', 'public/fonts');

mix.copy('resources/assets/global/plugins/datatables/images', 'public/img/datatables');
mix.copy('resources/assets/global/plugins/uniform/images', 'public/img/uniform');
mix.copy('resources/assets/global/plugins/bootstrap-editable/bootstrap-editable/img', 'public/img/editable');
mix.copy('resources/assets/global/img', 'public/img');
mix.copy('resources/assets/layouts/layout/img/sidebar_toggler_icon_darkblue.png', 'public/img/sidebar_toggler_icon_darkblue.png');
mix.copy('resources/assets/layouts/layout/img/avatar3_small.jpg', 'public/img/avatar.png');
mix.copy('resources/assets/pages/img/logo-big-white.png', 'public/img/logo-big-white.png');
mix.copy('resources/assets/global/img/user-icon.png', 'public/img/user-icon.png');