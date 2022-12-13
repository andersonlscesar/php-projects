# Generate TXT File

I've been reviewing some concepts about php and i came across to a subject "how to manipulate files and directories".
Then, i've been deciding put these concepts in practice.

---

## Structure
- app
    - GenerateFile.php
- analyzer.php
- autoload.php
- index.html

### What's the point here

So, i created the autoload function in order to load the classes by their namespaces.
In the HTML file, all the inputs are validated by the php.

At this little and simple project i've learn that there's a difference between a function fwrite and file_put_contents.

- The write function overwrites an existing file if you try to insert a new value.
- The file_put_contents gives to you more options, like: 
    - If you pass a filename as value at the first param and it's file doesnt exists, it will create a new file with that name.
    - If you pass a new value to an existing file and make explicit the thirdth function's param using the "FILE_APPEND", this file won't be overwrote and
    as the older values as the newer values will be merged / appended. But, if you don't allow that option, the file will be overwrote.