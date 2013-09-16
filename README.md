# Minecraft Avatar

PHP/GD creation of a Minecraft facial avatar or full skin preview based on a given username, constructed from their Minecraft skin.

If username is not found, then it uses the default skin: [http://www.minecraft.net/skin/char.png](http://www.minecraft.net/skin/char.png)

## Facial Avatar

```html
<img src='face.php?u={username}&s={size}' />
```
   
Where `{size}` can be between 8 and 250 pixels

<img src='http://jamiebicknell.github.io/Minecraft-Avatar/1379352360571.png' alt='Steve Avatar' />

## Skin Preview

```html
<img src='skin?u={username}&s={size}' />
```
   
Where `{size}` can be between 40 and 800 pixels

<img src='http://jamiebicknell.github.io/Minecraft-Avatar/1379352360572.png' alt='Steve Skin' />