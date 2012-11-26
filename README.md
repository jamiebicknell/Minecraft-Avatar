# Minecraft Avatar

PHP/GD creation of a Minecraft facial avatar based on a given username, constructed from their Minecraft skin.

If username is not found, then it uses the default skin: [http://www.minecraft.net/skin/char.png](http://www.minecraft.net/skin/char.png)

## Example Usage

```html
<img src='minecraft.php?u={username}&s={size}' />
```
   
Where `{size}` can be between 8 and 250 pixels