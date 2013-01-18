define(['text!templates/teams.html', 'text!templates/_listTeams.html'], function (teamsTemplate, listTpl) {
	var teamsView = Backbone.View.extend({
		el: $('#content'),

		render: function () {
			var player = {
				name: "Bruno"
			};

			this.$el.html(teamsTemplate);
		}
	});
	return teamsView;
});