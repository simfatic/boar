# Boar - Self-documenting PHP Form validation library

```
$v = Boar::create()
$v->field("name")->isRequired()->alphabetic()->maxLen(50)
$v->fields(["email", "address"])->areRequired()->maxLen(50)

if(!$v->validate($post_values))
{
    $error_map = $v->getErrors()
    
}

```
