## GTAMS - COP 4710

###This file will list what we have down and what needs to be done.

### 2.1 User Interface for Applicants
  * Ussama pretty muched completed this one. As long as the emails aren't repeated then everything works out.

### 2.2 User Interface for Advisors
  * This one hit us pretty hard. We spent a good chunk of the night and morning trying to figure out how to get this done to no avail.
  * Basically, the emails are sent out to the advisors with a generated link but we couldn't figure out how to get the pdf or text into the Database.
  * Also need the header code that checks the deadline and either warns the advisor or sets an application as not finished/terminated.

### 2.3 User Interface for GC Members
 * If a gc member logs in they are automatically sent here.
 * Dynamic table has been set up, but needs:
            * A dropdown menu or something that allows for the session to be picked so that we can grab the id to find the gc_members for that session.
            * Code that allows each row to bring up the pop up menu.
 * We also weren't able to get to the popup menu so that needs to be done.

### 2.4 User Interface for System Admin
 * If the login email belongs to an Admin it takes them to Admin page.
 * Emails are sent to the gc_member email addresses as they are submitted for the semester session.
 * All data is stored into the DB with no problem.


### General
 * Need code to keep some users from accessing some parts of the site. Example: GC Members shouldn't be able to access the Admin Dashboard.
 * Need to implement Password and Username changes for gc_members.
 * Probably more but it's 7:30 and I can't think of whatever might be left.
