/**
 * Created with JetBrains PhpStorm.
 * User: christian.manalansan
 * Date: 9/26/13
 * Time: 1:40 AM
 * To change this template use File | Settings | File Templates.
 */

jQuery(document).ready(function() {
    jQuery(function ($) {
        function AuctionTeam(teamName, teamRecord, oppName, oppRecord, gameDay) {
            var self = this;
            self.teamName = ko.observable(teamName);
            self.teamRecord = ko.observable(teamRecord);
            self.oppName = ko.observable(oppName);
            self.oppRecord = ko.observable(oppRecord);
            self.gameDay = ko.observable(gameDay);

            self.summary = ko.computed(function() {
                return '(' + self.teamRecord() + ') ' + self.teamName() + ' ' + self.oppName() + ' (' + self.oppRecord() + ')';
            });
        }


        function FootballViewModel() {
            var self = this;
            self.screen = ko.observable(1);
            self.email = ko.observable();
            self.password = ko.observable();
            self.league = ko.observable();
            self.authKey = ko.observable(null);
            self.errorMesg = ko.observable(null);
            self.auctionTeams = ko.observableArray();

            self.leagueArray = ['Test1', 'Test2'];

            // Operations
            self.login = function() { // TODO: perform AJAX to actually authenticate
                if (self.password() != '123') {
                    self.errorMesg('Invalid password.');
                } else {
                    self.authKey('12345');
                    self.auctionTeams.push(new AuctionTeam('Cowboys', '3-0', 'vs. Bengals', '2-1', 'Sunday'));
                    self.auctionTeams.push(new AuctionTeam('Falcons', '2-1', '@ Lions', '2-1', 'Sunday'));
                    self.auctionTeams.push(new AuctionTeam('Packers', '0-3', 'vs. 49ers', '1-2', 'Monday'));
                    self.screen(2);
                }
                self.password(null);
            }
            self.confirmTeams = function() {
                self.screen(3);
            }
        }

        ko.applyBindings(new FootballViewModel());
    });
});

