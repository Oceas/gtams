## GTAMS - COP 4710

### Build wth Vagrant for development:
```sh
$ vagrant up # boots headless VM (first boot boostraps VM)
$ vagrant ssh # ssh into VM
$ cd /srv/gtams/app # inside VM
$ php -S 0.0.0.0:8000 # starts server at http://33.33.11.30:8000/
```

### Project specs:

### Models

#### Users
* GTA Applicants
  * ID - Integer - used for generated link
  * Name - String
  * PID - Unique Integer
  * Email - Unique String
  * ~~Password - Encrypted String~~
  * Phone Number - Integer Length of 10, parsed by client
  * PhD of CS - Boolean
  * Number of semesters as student - Integer
  * Passed SPEAK Test - String with set values
  * Number of semesters as employee - Integer
  * Completed Grad Courses - has_many association
  * GPA - Calcualted Integer
  * Publications - has_many association
  * PhD Advisors - has_many association restraint max of 2 (current and previous)
  * Reference Letters - has_many association
  * timestamps - on form submission

* Completed Grad Courses
  * Name - String
  * Grade - Integer Enumeration (A, B, C, D, F)

* Publications
  * Citation info - Text

* PhD Advisor
  * Name - String
  * Email - String
  * ~~Password - Encrypted String~~
  * Reference Letters - has_many association

* Reference Letter
  * Body - text
  * File - PDF
  * Applicant - belongs_to association (applicant_id)
  * Advisor - belongs_to association (advisor_id)

* Graduate Committee Member
  * Email
  * Password - Encrypted String
