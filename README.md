# Web-Programming-Project-4

Course:     CS316 - Spring 2018
Assignment: Project 4 - PHP

A very basic web application in PHP that will create
    a dynamic search form.  The PHP script will take user input from the
    form and perform basic searches on files local to the web server.
    Searches will involve JSON objects stored in those files.


    - The project creates an HTML form with five (required) fields:
        - category
        - keyToMatch 
        - matchValue
        - infoToProcess
        - sumOrAvg


    - category is a <SELECT> field dynamically populated by
      the program.

      The valid values are read from a file in the directory
      the PHP script resides named Media.json. This file contains a JSON object with three 
      nested objects: "categories", "find", and "info".

      "categories" will contain pairs of values in the form:
            "descriptor": "filename.json"

      Example:   "2017 Movies": "2017_movies.json"

      "descriptor" is the label presented to the user as
      the <SELECT> labels for the category field.

    - keyToMatch is the second <SELECT> field, also dynamically
      populated via the Media.json object.  The second nested object
     contains pairs of values in the form:
              "key": "value"

      Example: "F2": "Platform"

      This is completely dynamic, not hard-coded.

    - the third field will map to matchValue and it will be a user
      entered string. For example, if the user selects
      "Genre" in "keyToMatch" and they type "2.20:1" in this
      field, your program will simply return "no results found"
      because no genre field will have that match.

    - infoToProcess is the third <SELECT> field (fourth overall field), 
      also dynamically populated via the Media.json object.  The third 
      nested object, "info", contains pairs of values in the form:
            "key": "value"

      Example:  "I0": "Runtime"

      The last field is sumOrAvg.  
      



    - The PHP script accepts GET requests to search the files
      discovered from Media.json. 

    For example:


      If they selected :
      category: 2017 Movies
      keytoMatch: Platform
      matchValue: theater
      infoToProcess: Runtime
      sumOrAvg: sum

      The program would open the file "2017_movies.json" (pointed
      to by Media.json).  Output all the comments at the top of the
      report.  Then iterate over all the works outputting the key/value
      pairs.  If the Platform == "theater" then this key/value pair
      is BOLD.

      Lastly, the program outputs the total number of minutes for all the works.
