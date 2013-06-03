Cakephp_slug_component
======================

This is just a bit of a timesaving way of handling Slugs created by something like CakeDC's sluggable behaviour. The component works twofold. 

1) It returns an options array for the model that finds by slug<br />
2) If an ID is passed it redirects to the slug.

I use it in a couple of ways:

Editing Records
===============

For example when using baked controller methods - the edit function expects and ID to be passed into it, however if you are using slugs then most of the time the slug will be passed instead, I created this for that main reason.

```php
$options = $this->Slug->checkSlug("Post", $slug, "edit");

if(!is_numeric($slug)) {
    $id = $this->Slug->idFromSlug('Post', $slug);
} else {
    $id = $slug;
}
$this->Post->id = $id;
```

This ensures that the id is always passed to regardless of whether the slug was passed or the id.

Viewing Records
===============

We retrofitted this to a large system and I wasnt sure if there were any ID's in links hanging around so I figured I would use this to catch any stray ones which would cause a 404 if the sluggable behaviour was in use.

```php
$options = $this->Slug->checkSlug("Post", $slug);
``` 

And then you pass this $options into your model find.

