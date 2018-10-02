Development Exercise

  The following code is poorly designed and error prone. Refactor the objects below to follow a more SOLID design.
  Keep in mind the fundamentals of MVVM/MVC and Single-responsibility when refactoring.

  Further, the refactored code should be flexible enough to easily allow the addition of different display
    methods, as well as additional read and write methods.

  Feel free to add as many additional classes and interfaces as you see fit.

  Note: Please create a fork of the https://github.com/BrandonLegault/exercise repository and commit your changes
    to your fork. The goal here is not 100% correctness, but instead a glimpse into how you
    approach refactoring/redesigning bad code. Commit often to your fork.

### Refactoring thought process
  The thought process I had behind my refactor of the code was to firstly break-up the PlayersObject class into individual components, this would immediantly clean up the look of the code, it would also allow for easier addition of new features in the future.

  After the inital seperation of the code (implimenting "S" Single Responsibility Principle) I started to think about how I could impliment MVC and the remaining SOLID principles into this project. I approached this project with the mentality of "small wins" I worked in small progressive steps refactoring the code to meet SOLID and MVC principles. I started with "I" Interface segregation, seperating interfaces allowed for thin classes that were singely focused on one task. I then applied the "O" Open-Close principle, from base project both the JSON and Array methods had hard coded data which would require me to open the file and make changes directly in the code, I wasn't sure if I was allowed to change the hard coded data, so I added optional parameters that accepted JSON and array data respectivly in thier methods, I also added some very niave data validation checks. Lastly I added the "D" Dependency Inversion, as I was learning the SOLID principles I stumbled upon the term "New is glue", declaring new instances of objects in functions essentially binded them and would cause major headache if I had to add more features or change stuff around, I instead opt'd to pass instances of Read, Write and Display classes to my Controller's constructor so that if in the future the design of some of the classes were to change I wouldn't need to completly rewrite my Controller class.
