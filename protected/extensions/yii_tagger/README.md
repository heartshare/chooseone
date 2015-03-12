ETagInputWidget v.0.0.1
==================================
ETagInputWidget - is input widget for input where you need to place multiple tags for model instance.

### Additions:

I made it for my own purposes, I know it not pretty good, and I want to improve it in future.
For now it only send the strings with tags names. In future I want to make it work with objects(or with Tag id`s)

### Basic usage:
1) Download the extension and place it in `extensions` directory;

2) In your form view place this piece of code:

```php
$this->widget('ext.yii_tagger.ETagInputWidget',
    array(
        'model'     => Genres::model(),
        'attribute' => 'name',
    )
);
```
3) Then in controller:

```php
$tags = explode(',', $_POST['tags_submit_field']);
```
And you able to save it in some attribute.
