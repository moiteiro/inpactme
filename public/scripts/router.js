define([
	'views/clubs/club','views/clubs/clubs', 'views/clubs/addClub', 'views/clubs/editClub', 'models/Club', "models/ClubCollection",
	'views/players/player','views/players/players', 'views/players/addPlayer', 'views/players/editPlayer', 'models/Player', "models/PlayerCollection",
	'views/matches/match','views/matches/matches', 'views/matches/addMatch', 'views/matches/editMatch', 'models/Match', "models/MatchCollection",],

	function (
		      ClubView, ClubsView, AddClubView, EditClubView, Club, ClubCollection, 
		      PlayerView, PlayersView, AddPlayerView, EditPlayerView, Player, PlayerCollection,
		      MatchView, MatchesView, AddMatchView, EditMatchView, Match, MatchCollection) {

	var App = Backbone.Router.extend({
		currentView: null,
		routes: {
			"": "clubs",

			"clubs/new" : "addClub",
			"clubs/:id/edit" : "editClub",
			"clubs/:id/remove" : "removeClub",
			"clubs/:id": "club",
			"clubs": "clubs",

			"players/new" : "addPlayer",
			"players/:id/edit" : "editPlayer",
			"players/:id/remove" : "removePlayer",
			"players/:id": "player",
			"players": "players",

			"matches/new" : "addMatch",
			"matches/:id/edit" : "editMatch",
			"matches/:id/remove" : "removeMatch",
			"matches/:id": "match",
			"matches": "matches",
		},

		changeView: function (view) {
			if (this.currentView !== null) {
				this.currentView.undelegateEvents();
			}

			this.changeCurrentMenuItem();
			this.currentView = view;
			this.currentView.render();
		},

		changeCurrentMenuItem: function () {

			var location = window.location.hash;

			$('#menu-item-clubs').removeClass('current');
			$('#menu-item-matches').removeClass('current');
			$('#menu-item-players').removeClass('current');

			if (location.indexOf('#matches') > -1) {
				$('#menu-item-matches').addClass('current');

			} else if (location.indexOf('#clubs') > -1) {
				$('#menu-item-clubs').addClass('current');

			} else if (location.indexOf('#players') > -1) {
				$('#menu-item-players').addClass('current');
			}
		},

		index: function () {
			this.changeView(new IndexView());
		},

		/********************
			Clubs
		*********************/

		clubs: function () {
			var clubCollection = new ClubCollection();
			this.changeView(new ClubsView({collection: clubCollection}));
			clubCollection.fetch();
		},

		club: function (id) {
			var model = new Club();
			var playerCollection = new PlayerCollection();

			model.url = '/clubs/' + id;

			this.changeView(new ClubView({model: model, playerCollection: playerCollection}));
			
			model.fetch({success: function () {
				playerCollection.fetch();
			}});
		},

		addClub: function () {
			var model = new Club();
			var playerCollection = new PlayerCollection();
			this.changeView(new AddClubView({model: model, playerCollection: playerCollection}));
			playerCollection.fetch();
		},

		editClub: function (id) {
			var model = new Club();
			var playerCollection = new PlayerCollection();
			model.url = '/clubs/' + id;
			
			this.changeView(new EditClubView({model: model, playerCollection: playerCollection}));
			model.fetch({success: function () {
				playerCollection.fetch();
			}});
		},

		removeClub: function (id) {
			var model = new Club({});

			//model.url = '/players/' + id;
			//this.changeView(new EditPlayerView({model: model}));
			//model.fetch();
		},

		/********************
			Players
		*********************/

		players: function () {
			var playerCollection = new PlayerCollection();
			var clubCollection = new ClubCollection();

			this.changeView(new PlayersView({collection: playerCollection}));
			playerCollection.fetch();
		
		},

		player: function (id) {
			var model = new Player();
			model.url = '/players/' + id;
			this.changeView(new PlayerView({model: model}));
			model.fetch(); // busca todos os dados;
		},

		addPlayer: function () {
			var model = new Player();
			this.changeView(new AddPlayerView({model: model}));
		},

		editPlayer: function (id) {
			var model = new Player();
			model.url = '/players/' + id;
			this.changeView(new EditPlayerView({model: model}));
			model.fetch();
		},

		removePlayer: function (id) {
			var model = new Player({});
		},

		/********************
			Matches
		*********************/
		
		matches: function () {
			var matchCollection = new MatchCollection();
			this.changeView(new MatchesView({collection: matchCollection}));
			matchCollection.fetch();
		},

		match: function (id) {
			var model = new Match();
			model.url = '/matches/' + id;
			this.changeView(new MatchView({model: model}));
			model.fetch(); // busca todos os dados;
		},

		addMatch: function () {
			var clubCollection = new ClubCollection();
			this.changeView(new AddMatchView({clubCollection: clubCollection}));
			clubCollection.fetch();
		},

		editMatch: function (id) {
			var model = new Match();
			model.url = '/matches/' + id;
			this.changeView(new EditMatchView({model: model}));
			model.fetch();
		},

		removeMatch: function (id) {
			var model = new Match({});

			//model.url = '/players/' + id;
			//this.changeView(new EditPlayerView({model: model}));
			//model.fetch();
		},
	});

	return new App();
});