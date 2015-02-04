# Minecraft Avatar

PHP/GD creation of a Minecraft facial avatar or full skin preview based on a given username, constructed from their Minecraft skin.

If username is not found, then it uses the default skin: [http://www.minecraft.net/skin/char.png](http://www.minecraft.net/skin/char.png)

## Facial Avatar

<img src='http://jamiebicknell.github.io/Minecraft-Avatar/steve-face.png' alt='Steve Avatar' /> <img src='http://jamiebicknell.github.io/Minecraft-Avatar/alex-face.png' alt='Alex Avatar' />

```html
<img src='face.php?u={username}&s={size}&v={view}' />
```

#### Query Parameters

<table>
    <tr>
        <th>Key</th>
        <th>Example Value</th>
        <th>Default</th>
        <th>Description</th>
    </tr>
    <tr>
        <td>u</td>
        <td>jamiebicknell</td>
        <td><a href='https://minecraft.net/images/steve.png'>steve</a></td>
        <td>Username of Minecraft player</td>
    </tr>
    <tr>
        <td>s</td>
        <td>8 - 250</td>
        <td>48</td>
        <td>Desired avatar width and height</td>
    </tr>
    <tr>
        <td>v</td>
        <td>f, l, r, b<br />front, left, right, back</td>
        <td>front</td>
        <td>View of facial avatar (optional)</td>
    </tr>
</table>

## Skin Preview

<img src='http://jamiebicknell.github.io/Minecraft-Avatar/steve-skin.png' alt='Steve Skin' />

<img src='http://jamiebicknell.github.io/Minecraft-Avatar/alex-skin.png' alt='Alex Skin' />

```html
<img src='skin.php?u={username}&s={size}' />
```

#### Query Parameters

<table>
    <tr>
        <th>Key</th>
        <th>Example Value</th>
        <th>Default</th>
        <th>Description</th>
    </tr>
    <tr>
        <td>u</td>
        <td>jamiebicknell</td>
        <td><a href='https://minecraft.net/images/steve.png'>steve</a></td>
        <td>Username of Minecraft player</td>
    </tr>
    <tr>
        <td>s</td>
        <td>40 - 800</td>
        <td>250</td>
        <td>Desired skin preview width</td>
    </tr>
</table>

## .Htaccess

If you have `mod_rewrite` enabled you can view the avatar via cleaner URLs.

#### Facial Avatar

```html
<img src='http://domain.com/avatar/{username}' />
```

```html
<img src='http://domain.com/avatar/{username}/{size}' />
```

```html
<img src='http://domain.com/avatar/{username}/{view}' />
```

```html
<img src='http://domain.com/avatar/{username}/{size}/{view}' />
```

#### Skin Preview

```html
<img src='http://domain.com/skin/{username}' />
```

```html
<img src='http://domain.com/skin/{username}/{size}' />
```

## Notes

* After changing your skin on [Minecraft.net](https://minecraft.net/profile) it can take up to 1 hour for the facial avatar or skin preview to show the new skin.
* The skin preview differenciates between the Steve (4 pixel arm width) and Alex skin (3 pixel arm width) by checking the alpha value on the pixel at 54, 20. Therefore, the preview assumes that the skin is well formed and that the unallocated areas are transparent.
* Default skins: [Steve](https://minecraft.net/images/steve.png) and [Alex](https://minecraft.net/images/alex.png)
* Skin templates: [Steve](https://minecraft.net/images/4px_reference.png) and [Alex](https://minecraft.net/images/3px_reference.png)

## License

Minecraft Avatar is licensed under the [MIT license](http://opensource.org/licenses/MIT), see [LICENSE.md](https://github.com/jamiebicknell/Minecraft-Avatar/blob/master/LICENSE.md) for details.