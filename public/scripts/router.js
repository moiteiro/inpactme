define(['views/index', 'views/teams', 'views/matchs', 'views/player', 'models/Player', "models/PlayerCollection"],
	function (IndexView, TeamsView, MatchsView, PlayerView, Player, PlayerCollection) {

	var App = Backbone.Router.extend({
		currentView: null,
		routes: {
			"index": "index",
			"player/:id": "player",
			"players": "players",
			"teams" : "teams",
			"matchs" : "matchs",
		},

		changeView: function (view) {
			if (this.currentView !== null) {
				this.currentView.undelegateEvents();
			}
			this.currentView = view;
			this.currentView.render();
		},

		index: function () {
			this.changeView(new IndexView());
		},

		players: function () {
			var playerCollection = new PlayerCollection();
			playerCollection.fetch();
			//playerCollection.add({name: {first: "bruno", last: "moiteiro"}});
			this.changeView(new PlayerView({collection: playerCollection}));
		},

		player: function (id) {
			var model = new Player({id: 1, name: {first: "bruno", last: "moiteiro"}});
			//var model = new Player();
			//model.save(); // cria ou atualiza uma entrada. Vai depender se o id foi passado ou nao
			//model.fetch(); // busca todos os dados;
			//model.fetch({id: 1}); // busca um id em especifico;
			//model.destroy({id: 1}); // remove uma entrada do banco.
			//var playerCollection = new PlayerCollection();
			//playerCollection.fetch();
			//var model = new Player();
			this.changeView(new PlayerView({model: model}));
		},

		teams: function () {
			this.changeView(new TeamsView());
		},

		matchs: function () {
			this.changeView(new MatchsView());
		}
	});

	return new App();
});