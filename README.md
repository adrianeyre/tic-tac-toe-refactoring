# TicTacToe Refactoring Technical Task

### Index
* [Task](#task)
* [Original PHP file](#original)
* [Setup](#setup)
  * [Prerequisite](#prerequisite)
  * [Setting up the application](#setupapp)
  * [Running the applicaio](#runapp)
  * [Running the tests](#runtest)
* [First Steps](#first)
* [Refactoring Steps](#refactor)
* [Considerations and Improvement](#considerations)

## <a name="task">Task</a>
We have provided an implementation of a game of TicTacToe, the game as it stands works. 

That being said there are a couple of bugs/improvements that need addressing:

- The game sometimes crashes or skips a turn when given invalid input.
- In its current form, which is supposed to be at a difficulty level of “hard” (meaning the computer cannot be beaten), it actually can be beaten in certain situations. This is more like a “medium” difficulty level.
- The game play leaves a lot to be desired. The user messages are lacking. They’re unclear. It’s confusing to see the spot that’s selected and the board all on the screen. It’s easy to get lost in what’s happening. It’s weird the way the computer picks its spot without notifying the user.

We would like you to address as many of these issues as you can. However we'd like your primary focus to be fixing the bug that causes the game to crash or skip a turn while refactoring the game in a *safe* way, getting the code under test and applying SOLID design principles as you go.

Feel free to pick the version of the game that is in a language that you are comfortable with, this isn't a test of syntax knowledge.
 
There is no time limit on this task and you are free to use whatever IDE's or tools you feel appropriate.

## <a name="original">Original PHP file</a>
:page_facing_up: [File](original.php)

## <a name="setup">Setup</a>
### <a name="prerequisite">Prerequisite</a>
* [PHP](http://php.net/downloads.php) >= 5.0.0
* [Composer](https://getcomposer.org/download/) >= 1.6.0

### <a name="setupapp">Setting up the applicaion</a>
* Navigate to the root of the application
* Make sure the extension `extension=mbstring` is enabled in `php.ini`
* Run the command `composer install` to install the dependancies

### <a name="runapp">Running the applicaion</a>
* Navigate to the `/app` folder
* Run the command `php run.php`

### <a name="runtest">Running the tests</a>
* Navigate to the root of the application
* Run the command `./vendor/bin/phpunit`

## <a name="first">First Steps</a>
- Read over the code at a high level.
- As the code was already working I created tests for all the functions, that way I knew if any further changes I did wouldn't break the code.
- Made sure the tests had edge cases.
- Wrote down all the different responsibilities of the whole application.
- Understood how each responsibility connected with the application.

## <a name="refactor">Refactoring Steps</a>
- Split the code into different Classes so that each class had a single responsibility.
- Used the Open/Close principle with the Player Class.
- Made sure classes could be decoupled from each other.
- Exposed only interfaces that were needed for each Class.
- Injected dependencies so it would be easy to swap in the future.
- Refactored code to make it easily readable and DRY.

## <a name="considerations">Considerations and Improvements</a>
- The board spaces could be a object not an array.
- More end to end tests
