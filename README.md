# Boar - Self-documenting PHP Form validation library

```php
$v = Boar::create()
$v->field("name")->isRequired()->alphabetic()->maxLen(50)
$v->fields(["email", "address"])->areRequired()->maxLen(50)

$res = $v->validate($post_values)

if($res->hasErrors())
{
    echo json_encode($res->errors);    
}

```

## Custom validation error message
```php
$v->field("name")->maxLength(10)->withMessage("name should be shorter than {{max_length}}");

```

## All validations should be explicitly declared

```php
$v->field("name")->maxLength(10)->alphabetic();

$res = $v->validate([]); //No Error. 

```
if name is a required field, should call isRequired() explicitly
```php
$v->field("name")->isRequired()->maxLength(10)->alphabetic();

$res = $v->validate([]); //Error. 

```

Similarly,
```php
$v->field("weight")->min(100);

$res = $v->validate(["weight"=>"not a number"]); //No Error. 

```
minimum validation will not validate for the data type. If the value is not number, it will silently ignore.

```php
$v->field("weight")->isNumber()->min(100);

$res = $v->validate(["weight"=>"not a number"]); //Error. 

```

Keeping the granularity of the validation helps in predictable behavior and reduces ambiguity.

