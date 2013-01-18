define(['text!templates/index.html', 'text!templates/_listTeams.html'], function (indexTemplate, listTpl) {
	var indexView = Backbone.View.extend({
		el: $('#content'),

		render: function () {
			//this.$el.html(_.template(listTpl, context));
			
			this.$el.html(indexTemplate);
		}
	});
	return indexView;
});