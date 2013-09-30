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
            self.locker1 = ko.observable();
            self.locker2 = ko.observable();
            self.locker3 = ko.observable();
            self.league = ko.observable();
            self.gameData = ko.observable(null);
            self.errorMesg = ko.observable(null);
            self.auctionTeams = ko.observableArray();

            self.leagueArray = ['Test1', 'Test2'];

            // Operations
            self.login = function() { // TODO: perform AJAX to actually authenticate
                $.post(
                    '/api/login.php',
                    {
                        email: self.email(),
                        locker: self.locker1() + '-' + self.locker2() + '-' + self.locker3(),
                        league: self.league()
                    },
                    function(result) {
                        if (result.status == 'success') {
                            self.gameData(result.gameData);
                            self.screen(self.gameData.screen);
self.screen(2);
                        } else {
                            self.errorMesg('Invalid password.');        
                        }
                        self.locker1(null);
                        self.locker2(null);
                        self.locker3(null);
                    }
                );

                self.locker1(null);
                self.locker2(null);
                self.locker3(null);
            }
            self.confirmTeams = function() {
                self.screen(3);
            }
        }

        ko.applyBindings(new FootballViewModel());
    });
});

