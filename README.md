# PHP Decorators
A hobby-project to see if one can implement Python-like decorators in PHP.

#### Features:
* Validates request-methods. (GET, POST, PUT, DELETE)
* Validates user from $_SESSION

It comes with a rough prototype of an init-file for authentication.
**Laravel has not been properly tested.**

#### Caveats:
Classes with this trait requires that their methods are **protected** to ba used.
