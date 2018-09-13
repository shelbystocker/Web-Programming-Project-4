# Web-Programming-Project-4

Course:     CS316 - Spring 2018
Assignment: Project 4 - PHP
Due:        Monday, April 16th, 23:59:59


Description:
    You will write a very basic web application in PHP that will create
    a dynamic search form.  The PHP script will take user input from the
    form and perform basic searches on files local to the web server.
    Searches will involve JSON objects stored in those files.

Requirements:
    - You must submit your assignment as a ZIP file (even if just 
      one file) to Canvas by the due date/time.
    - You can work in teams of two.  Only one team member should 
      turn in the assignment.  I will grade the latest version 
      submitted by any team member.
    - Your name(s) should be at the top of the source code and in 
      any documentation files.
    - Your PHP can use the modules included in the basic system.
    - You cannot use any external modules.  You cannot install any 
      extra modules.  The assignment shall be completed with the 
      modules listed in the requirements.  
    - The application shall execute and run properly on the 
      CS.UKY.EDU systems.
    - You shall adhere to the guide Dr. Finkel wrote on good 
      programming practices.  I will grade more strictly on these 
      guidelines for this assignment!

-------------------------------------------------------------------------
Part 1:
    - Your project will create an HTML form with five (required) fields:
        - category
        - keyToMatch 
        - matchValue
        - infoToProcess
        - sumOrAvg


    - category should be a <SELECT> field dynamically populated by
      your program.

      The valid values should be read from a file in the directory
      your PHP script resides named Media.json.  An example will be
      provided.  This file will contain a JSON object with three 
      nested objects: "categories", "find", and "info".

      "categories" will contain pairs of values in the form:
            "descriptor": "filename.json"

      Example:   "2017 Movies": "2017_movies.json"

      "descriptor" will be the label you will present to the user as
      the <SELECT> labels for the category field.

      From there you have (2) options - you can make the VALUE for that
      SELECT the second field of the pairs ("filename.json") or simply
      send the descriptor.  If you send the descriptor your PHP script
      will need to look at the second value to get the filename.  If
      you send the filename, you will need to sanitize it for security
      reasons, or at least verify it is a valid choice.

    - keyToMatch will be the second <SELECT> field, also dynamically
      populated via the Media.json object.  The second nested object
      will contain pairs of values in the form:
              "key": "value"

      Example: "F2": "Platform"

      NOTE: This needs to be completely dynamic, not hard-coded.
      Your program will fill in these values from the JSON object.

    - the third field will map to matchValue and it will be a user
      entered string.  You do not need to do any pre-processing
      (with JavaScript, etc) on this string.  Your form processing
      (PHP code) will handle that.  For example, if the user selects
      "Genre" in "keyToMatch" and they type "2.20:1" in this
      field, your program will simply return "no results found"
      because no genre field will have that match.

    - infoToProcess will be the third <SELECT> field (fourth overall field), 
      also dynamically populated via the Media.json object.  The third 
      nested object, "info", will contain pairs of values in the form:
            "key": "value"

      Example:  "I0": "Runtime"

      You should make the VALUE for this SELECT the value from this
      JSON object key/value pair.

      NOTE:  You should NOT have any hard-coded "info" fields 
      anywhere in your code.  You should expect that the JSON 
      files/objects given are non-exhaustive examples only.  
      keyToMatch should be completely dynamic to your program!  
      See example/hint below on how to do this.

      The last field is sumOrAvg.  This should be presented to 
      the user however you want (SELECT field, TEXT field, etc.)  
      The field itself has to be named somOrAvg and expected values 
      are "sum" or "avg".  
      

--------------------------------------------------------------------------
Part 2:

    - Your PHP script shall accept GET requests to search the files
      discovered from Media.json.  You should take the (5) fields:
      category, keytoMatch, matchValue, infoToProcess, sumOrAvg
      and search the JSON objects accordingly.

    Steps:
      Verify/validate the category - return appropriate error messages
      if this field is invalid in any way!

      Determine the filename to search based on category value.

      Read the JSON entries from that file.  Decode them to either
      objects or arrays.

      Produce a report (in HTML format) with the "comments" from the
      JSON file listed at the top of each report.  Do not assume
      the comments will be at the top of the JSON file!  Do not
      assume the number of comments!

CHANGE CHANGE CHANGE CHANGE

      Output ALL key/value pairs for the "works" in the file.
      If a user selected "keytoMatch" and "matchValue" match
      a "works" entry, then use HTML to BOLD all key/value pairs
	  for that work.

CHANGE CHANGE CHANGE CHANGE
.
      Note that multiple entries can match and also maybe NO
      entries will match.


      After all "works" are output, produce the required "sum"
      or "avg" requested.

      If your program receives any other value for sumOrAvg, it 
      shall display an appropriate error and NOT process the 
      request.

      If the user sends "sum", then your output shall keep a 
      running total of the field chosen in "infoToProcess".

      If the user sends "avg", then your output shall keep a 
      running total of the field chosen and then print the 
      average.  If a particular JSON entry does not contain 
      the field chosen, it shall not be included in the 
      average!!!

    For example:
    - Given this input you shall determine what the user wants.  
      For example:

      If they selected :
      category: 2017 Movies
      keytoMatch: Platform
      matchValue: theater
      infoToProcess: Runtime
      sumOrAvg: sum

      Your program would open the file "2017_movies.json" (pointed
      to by Media.json).  Output all the comments at the top of the
      report.  Then iterate over all the works outputting the key/value
      pairs.  If the Platform == "theater" then this key/value pair
      is BOLD.

      Lastly, output the total number of minutes for all the works.

--------------------------------------------------------------------------
PHP Functions Needed/Suggested


    $_GET[] is an array populated by the PHP interpreter.  It will contain
    the form values (if they exist).  You can use it to determine if your
    script is executing initially (draw the form) or is being submitted
    with search values (process the form).

    isset() will tell you if a variable is set:  
        isset($_GET['category'])
        isset($_GET['keyToMatch'])
        isset($_GET['matchValue'])
        isset($_GET['infoToProcess'])
        isset($_GET['sumOrAvg'])

    I would strongly suggest you write a function that takes a filename
    and reads the contents into a string and returns the contents either
    as a string or as a JSON object/array.

    file_get_contents() will read in a file and return its contents in
    a string.

    strlen() will return the length of a string.

    json_decode() will take a string and produce a JSON object.  Note the
    object might (probably will!) be made up of multiple objects.

    NOTE NOTE:   json_decode()'s second parameter is a boolean.  If set to
    true it will produce an array of JSON objects.  If false (default) it
    will produce a stdObject type, which will contain other nested objects.

    json_last_error() should be called after json_decode() to make sure
    the JSON object was valid.  For non-zero values there was a error!

    var_dump() will output a representation of a variable - use this for
    debug!

    array_keys() will produce just the indices/keys of an array (helpful
    if they are non-numeric.  This isn't necessarily needed.  See examples.


    foreach() - a looping conditional that will enumerate a object (or array)
    splitting it apart as you direct.  See examples.

    ========================================================
    The -> (arrow) syntax is used to reference sub-Objects.

    If you use json_decode() to produce a JSON object from the Media.json
    string, for example, you could access the three objects 'categories',
    'find', and 'info' via the following syntax:

    // pre-condition:  $filesJSON is a string of JSON objects

    $stuff = json_decode($filesJSON);

    $enumMedia = $stuff->categories;
    $enumFields = $stuff->find;
    $enumInfo = $stuff->info;

    //  NOTE that the => operator is different from the -> operator!
    foreach($enumFields as $key => $value) {
          // do something with $key and/or $value
    }

    If you have a sub-Object (say, Platform) that you could access via:
    $awork->Platform

    And, you have a variable $looking = "Platform" then you could
    access the above entry like:

    $awork->$looking

    ========================================================

    The arrow syntax is not supported in strings.

    You can do the following:

    echo "The answer is $answer";

    You cannot do the following:

    echo "The answer is $the->answer";

    You must do:

    echo "The answer is ", $the->answer;

=====================================================================
DO THIS:

   Create your program to process searches via the command-line!  Do not
   attempt to do this via the browser.  You will lose error messages!

   Run your program via "php ./project4.php", working on the searching
   part (manually setting the search parameters).  Once this is working
   then add the HTML form and such and begin testing via the browser!!!



0) You shall submit your PHP file to Canvas named as 
    "Lastname_p4.zip", or "Lastname1Lastname2_p4.zip" if you
    work in a team.  Yes, just put the PHP file in a ZIP file
    by itself.
1) You shall properly comment your code including putting your
    name(s) at the top.
2) You shall follow Dr. Finkel's checklist for good programming:
    http://www.cs.uky.edu/~raphael/checklist.html.
