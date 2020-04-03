# registration-auth form
User registration and authorization form, MySQL, JS, PHP, AJAX.

<h3> File structure: </h3>
<b> css/ </b> - style files <br/>
<i>style.css</i> - the main file of the styles of the form and user page <br/>
<b> img/ico </b> - used icons <br/>
<b> js/</b> - javascript files <br/>
<i>main.js</i> - contains javascript for managing the registration form <br/>
<b> php/language/ </b> - files containing language configs <br/>
<i> en.php </i>, <i> ru.php </i> - English and Russian configs, respectively, consist of an associative array describing the displayed labels on the page. <br/>
<b> model/ </b> - data processing files <br/>
<i> validation.php </i> - the file contains a class that checks the data entered by the user in the registration form, and cocks error flags if something is entered incorrectly, also, the input data is processed here. <br/>
<i> Database.php </i> is an abstract class for working with a database. </br>
<i> MyDatabase.php </i> - the class inherited from Database contains methods for working with the mydb database <br/>
<b>view/ </b> - display files <br/>
<i> header.php </i> - header file, contains doctype, title, style connection. <br/>
<i> switch_lang.php </i> - the file contains the language switch. <br/>
<i> registration-form.php </i> - registration and authorization forms. <br/>
<i> user.php </i> - user page. <br/>
<i> footer.php </i> - site footer. <br/>
<b> uploads/img </b> - files with user images. <br/>
<hr />
<i> index.php </i> is the main file that displays the necessary information on the page. <br/>
<i> register.php </i> is the registration processing script. <br/>
<i> auth.php </i> - authorization script. <br/>

<br/> <b> test_db.sql </b> - dump of mysql database. <br/>