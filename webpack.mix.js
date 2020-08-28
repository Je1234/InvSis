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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');


    mix.styles([
        'resources/assets/css/material-dashboard.css',
        'resources/assets/css/bootstrap-select.min.css',
        'resources/assets/css/bootstrap-select.css.map',
        'resources/assets/css/bootstrap-select.css',
        
        
        ], 'public/css/all.css');

        mix.styles([
            'resources/assets/js/core/jquery.min.js',
            'resources/assets/js/core/popper.min.js',
            'resources/assets/js/core/bootstrap-material-design.min.js',
            'resources/assets/js/plugins/perfect-scrollbar.jquery.min.js',
            'resources/assets/js/plugins/moment.min.js',
            'resources/assets/js/plugins/jquery.validate.min.js',
            'resources/assets/js/plugins/jquery.bootstrap-wizard.js',
            'resources/assets/js/plugins/bootstrap-selectpicker.js',
            'resources/assets/js/plugins/bootstrap-datetimepicker.min.js',
            'resources/assets/js/plugins/jquery.dataTables.min.js',
            'resources/assets/js/plugins/bootstrap-tagsinput.js',
            'resources/assets/js/plugins/jasny-bootstrap.min.js',
            'resources/assets/js/plugins/jquery-jvectormap.js',
            'resources/assets/js/plugins/fullcalendar.min.js',
            'resources/assets/js/plugins/arrive.min.js',
            'resources/assets/js/plugins/chartist.min.js',
            'resources/assets/js/plugins/bootstrap-notify.js',
            'resources/assets/js/material-dashboard.js',
            'resources/assets/js/producto.js',
            'resources/assets/js/categoria.js',
            'resources/assets/js/proveedor.js',
            'resources/assets/js/venta.js',
            'resources/assets/js/compras.js',
            
            ], 'public/js/all.js');