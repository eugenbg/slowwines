var moment = require("../../moment");

exports.week_year = {
    "iso weekday": function (test) {
        var i;
        test.expect(7 * 7);

        for (i = 0; i < 7; ++i) {
            moment.lang('dow:' + i + ',doy: 6', {week: {dow: i, doy: 6}});
            test.equal(moment([1985, 1,  4]).isoWeekday(), 1, "Feb  4 1985 is Monday    -- 1st day");
            test.equal(moment([2029, 8, 18]).isoWeekday(), 2, "Sep 18 2029 is Tuesday   -- 2nd day");
            test.equal(moment([2013, 3, 24]).isoWeekday(), 3, "Apr 24 2013 is Wednesday -- 3rd day");
            test.equal(moment([2015, 2,  5]).isoWeekday(), 4, "Mar  5 2015 is Thursday  -- 4th day");
            test.equal(moment([1970, 0,  2]).isoWeekday(), 5, "Jan  2 1970 is Friday    -- 5th day");
            test.equal(moment([2001, 4, 12]).isoWeekday(), 6, "May 12 2001 is Saturday  -- 6th day");
            test.equal(moment([2000, 0,  2]).isoWeekday(), 7, "Jan  2 2000 is Sunday    -- 7th day");
        }
        test.done();
    },

    "iso weekday setter" : function (test) {
        test.expect(27);

        var a = moment([2011, 0, 10]);
        test.equal(moment(a).isoWeekday(1).date(),  10, 'set from mon to mon');
        test.equal(moment(a).isoWeekday(4).date(),  13, 'set from mon to thu');
        test.equal(moment(a).isoWeekday(7).date(),  16, 'set from mon to sun');
        test.equal(moment(a).isoWeekday(-6).date(),  3, 'set from mon to last mon');
        test.equal(moment(a).isoWeekday(-3).date(),  6, 'set from mon to last thu');
        test.equal(moment(a).isoWeekday(0).date(),   9, 'set from mon to last sun');
        test.equal(moment(a).isoWeekday(8).date(),  17, 'set from mon to next mon');
        test.equal(moment(a).isoWeekday(11).date(), 20, 'set from mon to next thu');
        test.equal(moment(a).isoWeekday(14).date(), 23, 'set from mon to next sun');

        a = moment([2011, 0, 13]);
        test.equal(moment(a).isoWeekday(1).date(), 10, 'set from thu to mon');
        test.equal(moment(a).isoWeekday(4).date(), 13, 'set from thu to thu');
        test.equal(moment(a).isoWeekday(7).date(), 16, 'set from thu to sun');
        test.equal(moment(a).isoWeekday(-6).date(),  3, 'set from thu to last mon');
        test.equal(moment(a).isoWeekday(-3).date(),  6, 'set from thu to last thu');
        test.equal(moment(a).isoWeekday(0).date(),   9, 'set from thu to last sun');
        test.equal(moment(a).isoWeekday(8).date(),  17, 'set from thu to next mon');
        test.equal(moment(a).isoWeekday(11).date(), 20, 'set from thu to next thu');
        test.equal(moment(a).isoWeekday(14).date(), 23, 'set from thu to next sun');

        a = moment([2011, 0, 16]);
        test.equal(moment(a).isoWeekday(1).date(), 10, 'set from sun to mon');
        test.equal(moment(a).isoWeekday(4).date(), 13, 'set from sun to thu');
        test.equal(moment(a).isoWeekday(7).date(), 16, 'set from sun to sun');
        test.equal(moment(a).isoWeekday(-6).date(),  3, 'set from sun to last mon');
        test.equal(moment(a).isoWeekday(-3).date(),  6, 'set from sun to last thu');
        test.equal(moment(a).isoWeekday(0).date(),   9, 'set from sun to last sun');
        test.equal(moment(a).isoWeekday(8).date(),  17, 'set from sun to next mon');
        test.equal(moment(a).isoWeekday(11).date(), 20, 'set from sun to next thu');
        test.equal(moment(a).isoWeekday(14).date(), 23, 'set from sun to next sun');

        test.done();
    },

    "weekday first day of week Sunday (dow 0)": function (test) {
        test.expect(7);

        moment.lang('dow: 0,doy: 6', {week: {dow: 0, doy: 6}});
        test.equal(moment([1985, 1,  3]).weekday(), 0, "Feb  3 1985 is Sunday    -- 0th day");
        test.equal(moment([2029, 8, 17]).weekday(), 1, "Sep 17 2029 is Monday    -- 1st day");
        test.equal(moment([2013, 3, 23]).weekday(), 2, "Apr 23 2013 is Tuesday   -- 2nd day");
        test.equal(moment([2015, 2,  4]).weekday(), 3, "Mar  4 2015 is Wednesday -- 3nd day");
        test.equal(moment([1970, 0,  1]).weekday(), 4, "Jan  1 1970 is Thursday  -- 4th day");
        test.equal(moment([2001, 4, 11]).weekday(), 5, "May 11 2001 is Friday    -- 5th day");
        test.equal(moment([2000, 0,  1]).weekday(), 6, "Jan  1 2000 is Saturday  -- 6th day");
        test.done();
    },

    "weekday first day of week Monday (dow 1)": function (test) {
        test.expect(7);

        moment.lang('dow: 1,doy: 6', {week: {dow: 1, doy: 6}});
        test.equal(moment([1985, 1,  4]).weekday(), 0, "Feb  4 1985 is Monday    -- 0th day");
        test.equal(moment([2029, 8, 18]).weekday(), 1, "Sep 18 2029 is Tuesday   -- 1st day");
        test.equal(moment([2013, 3, 24]).weekday(), 2, "Apr 24 2013 is Wednesday -- 2nd day");
        test.equal(moment([2015, 2,  5]).weekday(), 3, "Mar  5 2015 is Thursday  -- 3nd day");
        test.equal(moment([1970, 0,  2]).weekday(), 4, "Jan  2 1970 is Friday    -- 4th day");
        test.