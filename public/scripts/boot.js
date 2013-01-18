require.config({
    baseUrl: '/public/scripts/',

    paths: {
        jQuery: 'libs/jquery',
        Underscore: 'libs/underscore',
        Backbone: 'libs/backbone',
        text: 'libs/text',
        templates: '../templates',
    },

    shim: {
        'Backbone': ['Underscore', 'jQuery'],
        'App' : ['Backbone']
    }
});

define(['App', 'Backbone', 'jQuery', 'Underscore' ], function (App) {
    App.initialize();
});