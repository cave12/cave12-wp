<?php
/*
Template Name: iCal
*/
 
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename="ical.ics"');
 
/*

* infos about iCalendar file format:
* http://en.wikipedia.org/wiki/ICalendar

* RFC 5545 replaced RFC 2445 in September 2009 and now defines the standard.
* http://tools.ietf.org/html/rfc5545

*/

echo cave12_ical_output();

/*
 * end of file
*/