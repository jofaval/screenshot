# API #
All the documentation of the API

Check the parameters [here](#parameters).

## Mindset
The idea behind the logic, to get yourself understanding some of my flaws.

It's just meant to take as few parameters as possible and imply the needs, it may be because it's a solo project. It may be getting updated with more and more, who knows.

Everything will be lowercased, just in case, to avoid any sort of problems.

## Security
There's none, each system has it's own security, that's what will be used. Use at your own risk.

## Endpoints
There's just one, the main at the root of the `domain`, or `APP_URL`, whatever you specified.

All specified methods will work, at least for now, ONLY on the HTTP `GET` method. As it's only fetching data

*The resolution and quality will be hardcoded, they will try to be the highest it can.*

### Examples
Take into account various things while analyzing the examples:
- `[name]=...` represents an **optional** parameter for the specified action.
- `...={value}` represents a constant.
- `...={$value}` represents a variable, it's the same as a constant (representation-wise).
- `...={'option1' | 'option2'}` represents an enum, or array of options.

#### Get the page
It just gets the page with all the default parameters set in, follow the example below:

`{API_BASE_URL}/?url={$site}`

#### Get a screenshot on a specific device
Instead of specifying an array of possible devices, regsitering them, choose your own resolution and browser header.

Specified in `px`, maybe in a future implementation it can have a units system. If only one of them is given, it will fill the missing one (`1:1 aspect ratio`)

`{API_BASE_URL}/?url={$site}&width={$width}&height={$height}`

#### Get a screenshot on a browser
Different browsers bring different results. So at least for now it may just work with Chromium and/or Firefox.

*Header* is not **required** for a browser specification, it's completely **optional**.

`{API_BASE_URL}/?url={$site}&browser={'chrome' | 'chrome' | 'firefox'}&[header]={$header}`

#### Return format
Ok, now that we have an image screenshotting process complete, how do we store it, or recieve it?.

You can specify wether you want the raw base64 image or the visual image and you're the one de/en/coding it!

`{API_BASE_URL}/?url={$site}&format={'base64' | 'visual'}`

## Parameters
All the required parameters for the endpoints.

Since right now there's only one endpoint, there's just one big table. Maybe later on down the line there's new endpoints created as shortcuts for some specified options, i.e. `/chrome/desktop?url={$site}`, `/chrome/mobile?url={$site}` or `/chrome/4k?url={$site}`

### Screenshot
|     name    | required |   type   |                   description                   |   default   |
|-------------|:--------:|:--------:|-------------------------------------------------|:-----------:|
| **url**     |  **yes** | `string` | The site location in the web.                   |    `null`   |
| **width**   |    no    |   `int`  | The width of the browser agent and screenshot.  |    `null`   |
| **height**  |    no    |   `int`  | The height of the browser agent and screenshot. |    `null`   |
| **browser** |    no    | `string` | The browser to be used                          | `'firefox'` |
| **header**  |    no    | `string` | The user agents header, string format           |    `null`   |
| **format**  |    no    | `string` | The return value format                         |  `'base64'` |