require.config({
    baseUrl: '/public/scripts/',

    paths: {
        jQuery: 'libs/jquery',
        Underscore: 'libs/underscore',
        Backbone: 'libs/backbone',
        Chosen: 'libs/chosen',
        text: 'libs/text',
        templates: '../templates',
    },

    shim: {
        'Backbone': ['Underscore', 'jQuery'],
        'Chosen': ['jQuery'],
        'App' : ['Backbone']
    }
});

define(['App', 'Backbone', 'jQuery', 'Underscore', 'Chosen' ], function (App) {
    App.initialize();
});