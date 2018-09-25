# CAT a.k.a Casual Authenticaiton Token

## About it

CAT is create temporary token securely and easily.

## How it works?

When you create token, the string will be look like this

`ewogICJ1c2VybmFtZSI6ICJsaWxsNzQiLAogICJhY2wiOiAibG9naW4iLAogICJpcGFkciIgOiAiMTI3LjAuMC4xIiwKICAiZXhwaXJlIiA6ICIxNTM3ODg4NjY4Igp9.210939ec8da100a52e41861bcf7393de6ca86f6357a3c5078f5410bb14c82111`

It just contain payload and hmac sha256 for verifying.

That means you should set salt variable randomly and you must manage your salt variable.

## API Document

Functions

| Type               | Name        | Args                            | Function           |
| ------------------ | ----------- | ------------------------------- | ------------------ |
| Object Constructor | __construct | $defsalt (null)                 | Object Constructor |
| String             | CreateToken | $payload, $salt (null)          | Creating Token     |
| Bool               | VerifyToken | $data, $acl, $ref, $salt (null) | Verifying Token    |



You might be confused, Let me explain.



Example



Creating Token

```php
$cat = new CAT("Salt!");

$arr = array(

                    'username' => $username,

                    'acl' => $acl,

                    'ipadr' => $_SERVER["REMOTE_ADDR"],

                    'expire' => time() + 600

);

$data = $cat -> CreateToken(json_encode($arr));

setcookie($coookie_name, $data, time() + 600, "/", "", null, true);
```



Verifying Token

```php
$cat = new CAT(getProperty("salt"));

if($cat -> VerifyToken($_COOKIE["token"], $acl, $ref)) {

​	return true;

}

return false;
```



## Security Tips

When you save token into cookie, you must be save as http only cookie. 

Otherwise, Attackers can try XSS.
