# Minecraft Avatar

PHP/GD creation of a Minecraft facial avatar or full skin preview based on a given username, constructed from their Minecraft skin.

If username is not found, then it uses the default skin: [http://www.minecraft.net/skin/char.png](http://www.minecraft.net/skin/char.png)

## Facial Avatar

<img src='http://jamiebicknell.github.io/Minecraft-Avatar/1379352360571.png' alt='Steve Avatar' />

```html
<img src='face.php?u={username}&s={size}' />
```
   
Where `{size}` can be between 8 and 250 pixels

## Skin Preview

<img src='http://jamiebicknell.github.io/Minecraft-Avatar/1379352360572.png' alt='Steve Skin' />

```html
<img src='skin.php?u={username}&s={size}' />
```
   
Where `{size}` can be between 40 and 800 pixels

## .Htaccess

If you have `mod_rewrite` enabled you can view the avatar via cleaner URLs.

For an avatar without a size:

```html
<img src='http://domain.com/avatar/{username}' />
```

For an avatar with a size:

```html
<img src='http://domain.com/avatar/{username}/{size}' />
```

For a skin without a size:

```html
<img src='http://domain.com/skin/{username}' />
```
    
For a skin with a size:

```html
<img src='http://domain.com/skin/{username}/{size}' />
```