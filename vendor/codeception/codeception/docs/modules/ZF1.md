# ZF1 Module

**For additional reference, please review the [source](https://github.com/Codeception/Codeception/tree/2.0/src/Codeception/Module/ZF1.php)**


This module allows you to run tests inside Zend Framework.
It acts just like ControllerTestCase, but with usage of Codeception syntax.

It assumes, you have standard structure with __APPLICATION_PATH__ set to './application'
and LIBRARY_PATH set to './library'. If it's not then set the appropriate path in the Config.

[Tutorial](http://codeception.com/01-27-2012/bdd-with-zend-framework.html)

## Status

* Maintainer: **davert**
* Stability: **stable**
* Contact: codecept@davert.mail.ua

## Config

* env  - environment used for testing ('testing' by default).
* config - relative path to your application config ('application/configs/application.ini' by default).
* app_path - relative path to your application folder ('application' by default).
* lib_path - relative path to your library folder ('library' by default).

## API

* client - BrowserKit client
* db - current instance of Zend_Db_Adapter
* bootstrap - current bootstrap file.

## Cleaning up

For Doctrine1 and Doctrine2 all queries are put inside rollback transaction. If you are using one of this ORMs connect their modules to speed up testing.

Unfortunately Zend_Db doesn't support nested transactions, thus, for cleaning your database you should either use standard Db module or
[implement nested transactions yourself](http://blog.ekini.net/2010/03/05/zend-framework-how-to-use-nested-transactions-with-zend_db-and-mysql/).

If your database supports nested transactions (MySQL doesn't) or you implemented them you can put all your code inside a transaction.
Use a generated helper TestHelper. Use this code inside of it.

``` php
<?php
namespace Codeception\Module;
class TestHelper extends \Codeception\Module {
     function _before($test) {
         $this->getModule('ZF1')->db->beginTransaction();
     }

     function _after($test) {
         $this->getModule('ZF1')->db->rollback();
     }
}
?>
```

This will make your functional tests run super-fast.
































### amHttpAuthenticated
 
Authenticates user for HTTP_AUTH

 * `param` $username
 * `param` $password


### amOnPage
 
Opens the page.
Requires relative uri as parameter

Example:

``` php
<?php
// opens front page
$I->amOnPage('/');
// opens /register page
$I->amOnPage('/register');
?>
```

 * `param` $page


























### attachFile
 
Attaches file from Codeception data directory to upload field.

Example:

``` php
<?php
// file is stored in 'tests/_data/prices.xls'
$I->attachFile('input[@type="file"]', 'prices.xls');
?>
```

 * `param` $field
 * `param` $filename


### checkOption
 
Ticks a checkbox.
For radio buttons use `selectOption` method.

Example:

``` php
<?php
$I->checkOption('#agree');
?>
```

 * `param` $option


### click
 
Perform a click on link or button.
Link or button are found by their names or CSS selector.
Submits a form if button is a submit type.

If link is an image it's found by alt attribute value of image.
If button is image button is found by it's value
If link or button can't be found by name they are searched by CSS selector.

The second parameter is a context: CSS or XPath locator to narrow the search.

Examples:

``` php
<?php
// simple link
$I->click('Logout');
// button of form
$I->click('Submit');
// CSS button
$I->click('#form input[type=submit]');
// XPath
$I->click('//form/*[@type=submit]');
// link in context
$I->click('Logout', '#nav');
// using strict locator
$I->click(['link' => 'Login']);
?>
```

 * `param` $link
 * `param` $context






### dontSee
 
Check if current page doesn't contain the text specified.
Specify the css selector to match only specific region.

Examples:

```php
<?php
$I->dontSee('Login'); // I can suppose user is already logged in
$I->dontSee('Sign Up','h1'); // I can suppose it's not a signup page
$I->dontSee('Sign Up','//body/h1'); // with XPath
?>
```

 * `param`      $text
 * `param null` $selector


### dontSeeCheckboxIsChecked
 
Assert if the specified checkbox is unchecked.
Use css selector or xpath to match.

Example:

``` php
<?php
$I->dontSeeCheckboxIsChecked('#agree'); // I suppose user didn't agree to terms
$I->seeCheckboxIsChecked('#signup_form input[type=checkbox]'); // I suppose user didn't check the first checkbox in form.
?>
```

 * `param` $checkbox


### dontSeeCookie
 
Checks that cookie doesn't exist

 * `param` $cookie



### dontSeeCurrentUrlEquals
 
Checks that current url is not equal to value.
Unlike `dontSeeInCurrentUrl` performs a strict check.

``` php
<?php
// current url is not root
$I->dontSeeCurrentUrlEquals('/');
?>
```

 * `param` $uri


### dontSeeCurrentUrlMatches
 
Checks that current url does not match a RegEx value

``` php
<?php
// to match root url
$I->dontSeeCurrentUrlMatches('~$/users/(\d+)~');
?>
```

 * `param` $uri


### dontSeeElement
 
Checks if element does not exist (or is visible) on a page, matching it by CSS or XPath
You can also specify expected attributes of this element.

Example:

``` php
<?php
$I->dontSeeElement('.error');
$I->dontSeeElement('//form/input[1]');
$I->dontSeeElement('input', ['name' => 'login']);
$I->dontSeeElement('input', ['value' => '123456']);
?>
```

 * `param` $selector


### dontSeeInCurrentUrl
 
Checks that current uri does not contain a value

``` php
<?php
$I->dontSeeInCurrentUrl('/users/');
?>
```

 * `param` $uri


### dontSeeInField
 
Checks that an input field or textarea doesn't contain value.
Field is matched either by label or CSS or Xpath
Example:

``` php
<?php
$I->dontSeeInField('Body','Type your comment here');
$I->dontSeeInField('form textarea[name=body]','Type your comment here');
$I->dontSeeInField('form input[type=hidden]','hidden_value');
$I->dontSeeInField('#searchform input','Search');
$I->dontSeeInField('//form/*[@name=search]','Search');
$I->seeInField(['name' => 'search'], 'Search');
?>
```

 * `param` $field
 * `param` $value


### dontSeeInTitle
 
Checks that page title does not contain text.

 * `param` $title



### dontSeeLink
 
Checks if page doesn't contain the link with text specified.
Specify url to narrow the results.

Examples:

``` php
<?php
$I->dontSeeLink('Logout'); // I suppose user is not logged in
?>
```

 * `param`      $text
 * `param null` $url


### dontSeeOptionIsSelected
 
Checks if option is not selected in select field.

``` php
<?php
$I->dontSeeOptionIsSelected('#form input[name=payment]', 'Visa');
?>
```

 * `param` $selector
 * `param` $optionText




### fillField
 
Fills a text field or textarea with value.

Example:

``` php
<?php
$I->fillField("//input[@type='text']", "Hello World!");
$I->fillField(['name' => 'email'], 'jon@mail.com');
?>
```

 * `param` $field
 * `param` $value










### grabAttributeFrom
 
Grabs attribute value from an element.
Fails if element is not found.

``` php
<?php
$I->grabAttributeFrom('#tooltip', 'title');
?>
```


 * `param` $cssOrXpath
 * `param` $attribute
 * `internal param` $element


### grabCookie
 
Grabs a cookie value.

 * `param` $cookie



### grabFromCurrentUrl
 
Takes a parameters from current URI by RegEx.
If no url provided returns full URI.

``` php
<?php
$user_id = $I->grabFromCurrentUrl('~$/user/(\d+)/~');
$uri = $I->grabFromCurrentUrl();
?>
```

 * `param null` $uri

 * `internal param` $url


### grabTextFrom
 
Finds and returns text contents of element.
Element is searched by CSS selector, XPath or matcher by regex.

Example:

``` php
<?php
$heading = $I->grabTextFrom('h1');
$heading = $I->grabTextFrom('descendant-or-self::h1');
$value = $I->grabTextFrom('~<input value=(.*?)]~sgi');
?>
```

 * `param` $cssOrXPathOrRegex



### grabValueFrom
 
 * `param` $field

@return array|mixed|null|string








### resetCookie
 
Unsets cookie

 * `param` $cookie




### see
 
Check if current page contains the text specified.
Specify the css selector to match only specific region.

Examples:

``` php
<?php
$I->see('Logout'); // I can suppose user is logged in
$I->see('Sign Up','h1'); // I can suppose it's a signup page
$I->see('Sign Up','//body/h1'); // with XPath
?>
```

 * `param`      $text
 * `param null` $selector


### seeCheckboxIsChecked
 
Assert if the specified checkbox is checked.
Use css selector or xpath to match.

Example:

``` php
<?php
$I->seeCheckboxIsChecked('#agree'); // I suppose user agreed to terms
$I->seeCheckboxIsChecked('#signup_form input[type=checkbox]'); // I suppose user agreed to terms, If there is only one checkbox in form.
$I->seeCheckboxIsChecked('//form/input[@type=checkbox and @name=agree]');
?>
```

 * `param` $checkbox


### seeCookie
 
Checks that cookie is set.

 * `param` $cookie



### seeCurrentUrlEquals
 
Checks that current url is equal to value.
Unlike `seeInCurrentUrl` performs a strict check.

``` php
<?php
// to match root url
$I->seeCurrentUrlEquals('/');
?>
```

 * `param` $uri


### seeCurrentUrlMatches
 
Checks that current url is matches a RegEx value

``` php
<?php
// to match root url
$I->seeCurrentUrlMatches('~$/users/(\d+)~');
?>
```

 * `param` $uri


### seeElement
 
Checks if element exists on a page, matching it by CSS or XPath.
You can also specify expected attributes of this element.

``` php
<?php
$I->seeElement('.error');
$I->seeElement('//form/input[1]');
$I->seeElement('input', ['name' => 'login']);
$I->seeElement('input', ['value' => '123456']);

// strict locator in first arg, attributes in second
$I->seeElement(['css' => 'form input'], ['name' => 'login']);
?>
```

 * `param` $selector
 * `param array` $attributes
@return


### seeInCurrentUrl
 
Checks that current uri contains a value

``` php
<?php
// to match: /home/dashboard
$I->seeInCurrentUrl('home');
// to match: /users/1
$I->seeInCurrentUrl('/users/');
?>
```

 * `param` $uri


### seeInField
 
Checks that an input field or textarea contains value.
Field is matched either by label or CSS or Xpath

Example:

``` php
<?php
$I->seeInField('Body','Type your comment here');
$I->seeInField('form textarea[name=body]','Type your comment here');
$I->seeInField('form input[type=hidden]','hidden_value');
$I->seeInField('#searchform input','Search');
$I->seeInField('//form/*[@name=search]','Search');
$I->seeInField(['name' => 'search'], 'Search');
?>
```

 * `param` $field
 * `param` $value


### seeInTitle
 
Checks that page title contains text.

``` php
<?php
$I->seeInTitle('Blog - Post #1');
?>
```

 * `param` $title



### seeLink
 
Checks if there is a link with text specified.
Specify url to match link with exact this url.

Examples:

``` php
<?php
$I->seeLink('Logout'); // matches <a href="#">Logout</a>
$I->seeLink('Logout','/logout'); // matches <a href="/logout">Logout</a>
?>
```

 * `param`      $text
 * `param null` $url


### seeNumberOfElements
 
Tests number of $elements on page

``` php
<?php
$I->seeNumberOfElements('tr', 10);
$I->seeNumberOfElements('tr', [0,10]); //between 0 and 10 elements
?>
```
 * `param` $selector
 * `param mixed` $expected:
- string: strict number
- array: range of numbers [0,10]  


### seeOptionIsSelected
 
Checks if option is selected in select field.

``` php
<?php
$I->seeOptionIsSelected('#form input[name=payment]', 'Visa');
?>
```

 * `param` $selector
 * `param` $optionText



### seePageNotFound
 
Asserts that current page has 404 response status code.


### seeResponseCodeIs
 
Checks that response code is equal to value provided.

 * `param` $code



### selectOption
 
Selects an option in select tag or in radio button group.

Example:

``` php
<?php
$I->selectOption('form select[name=account]', 'Premium');
$I->selectOption('form input[name=payment]', 'Monthly');
$I->selectOption('//form/select[@name=account]', 'Monthly');
?>
```

Can select multiple options if second argument is array:

``` php
<?php
$I->selectOption('Which OS do you use?', array('Windows','Linux'));
?>
```

 * `param` $select
 * `param` $option


### sendAjaxGetRequest
 
If your page triggers an ajax request, you can perform it manually.
This action sends a GET ajax request with specified params.

See ->sendAjaxPostRequest for examples.

 * `param` $uri
 * `param` $params


### sendAjaxPostRequest
 
If your page triggers an ajax request, you can perform it manually.
This action sends a POST ajax request with specified params.
Additional params can be passed as array.

Example:

Imagine that by clicking checkbox you trigger ajax request which updates user settings.
We emulate that click by running this ajax request manually.

``` php
<?php
$I->sendAjaxPostRequest('/updateSettings', array('notifications' => true)); // POST
$I->sendAjaxGetRequest('/updateSettings', array('notifications' => true)); // GET

```

 * `param` $uri
 * `param` $params


### sendAjaxRequest
 
If your page triggers an ajax request, you can perform it manually.
This action sends an ajax request with specified method and params.

Example:

You need to perform an ajax request specifying the HTTP method.

``` php
<?php
$I->sendAjaxRequest('PUT', /posts/7', array('title' => 'new title');

```

 * `param` $method
 * `param` $uri
 * `param` $params


### setCookie
 
Sets a cookie.

 * `param` $cookie
 * `param` $value




### submitForm
 
Submits a form located on page.
Specify the form by it's css or xpath selector.
Fill the form fields values as array.

Skipped fields will be filled by their values from page.
You don't need to click the 'Submit' button afterwards.
This command itself triggers the request to form's action.

You can optionally specify what button or buttons to include
in the request with the last parameter as an alternative to
explicitly setting its value in the second parameter, as
button values are not included otherwise included in the
request.

Examples:

``` php
<?php
$I->submitForm('#login', array('login' => 'davert', 'password' => '123456'), array('clickedButtonName', 'submitButtonName'));

```

For sample Sign Up form:

``` html
<form action="/sign_up">
    Login: <input type="text" name="user[login]" /><br/>
    Password: <input type="password" name="user[password]" /><br/>
    Do you agree to out terms? <input type="checkbox" name="user[agree]" /><br/>
    Select pricing plan <select name="plan"><option value="1">Free</option><option value="2" selected="selected">Paid</option></select>
    <input type="submit" name="submitButton" value="Submit" />
</form>
```
I can write this:

``` php
<?php
$I->submitForm('#userForm', array('user' => array('login' => 'Davert', 'password' => '123456', 'agree' => true)), 'submitButton');

```
Note, that pricing plan will be set to Paid, as it's selected on page.

 * `param` $selector
 * `param` $params

You can also emulate a JavaScript submission by not specifying any buttons in the third parameter to submitForm.

```php
<?php
$I->submitForm('#userForm', array('user' => array('login' => 'Davert', 'password' => '123456', 'agree' => true)));

```



### uncheckOption
 
Unticks a checkbox.

Example:

``` php
<?php
$I->uncheckOption('#notify');
?>
```

 * `param` $option

<p>&nbsp;</p><div class="alert alert-warning">Module reference is taken from the source code. <a href="https://github.com/Codeception/Codeception/tree/2.0/src/Codeception/Module/ZF1.php">Help us to improve documentation. Edit module reference</a></div>
