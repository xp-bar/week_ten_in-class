# week_ten_in-class
An in-class implementation of mixing PHP and MySQL to leverage our database in building multimedia applications!


## Notes

Three things we need to be concerned with:
1. How do we connect to the database?
2. How do we fetch the information from certain tables once we've connected?
3. How do we do it safely? (this has some tricks and caveats)


### mysql_ vs mysqli_

mysqli_ is more modern, has more features and is more on par with industry standard implementations of 
working with MySQL in a PHP context. It is easy to mix them up (because they both have a lot of the same
functions), for example:
- `mysqli_connect` VS `mysql_connect`

JUST REMEMBER: we always want to be IMPROVED (MySQL"Improved" = `mysqli`)
