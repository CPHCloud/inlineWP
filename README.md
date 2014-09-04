inlineWP
========

Easily enqueue javascript and styles inline and output them in the bottom of the document. Useful for keeping inline javascript and styles organised.

####Usage


#####Enqueing javascript
Without namespace:
```php
inlineWP()->enqueque_js("
  alert('I am enqueued')
")
```
With namespace:
```php
inlineWP('My namespace')->enqueque_js("
  alert('I am enqueued')
")
```

#####Enqueing javascript
Without namespace:
```php
inlineWP()->enqueque_css("
  alert('I am enqueued')
")
```
With namespace:
```php
inlineWP('My namespace')->enqueque_css("
  body {
    background: teal;
    color: red;
  }
")
```
