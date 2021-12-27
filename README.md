# Screenshot #
A project with the idea to provide a basic API for screenshotting pages dinamically.

## Description
As aforementioned it will try to provide a very basic API to get the page in an img format, it won't work with `CAPTCHA` nor `login forms`, not at least on the first versioning.

It's a `self-hosted` solution, while I do host it on my own server, and it could be used as some sort of PoC, the idea behind is to provide a self-hosted solution, not to offer my domain as the way-to-go.

### Ok, but why?
I was looking for a workaround to get screenshots from a page via PHP, it's a world of libraries and implementations that may or may not work, heavily dependant on your current system, that's a big flag.

And the alternative? Testing your page at Google's Page Insight Lighhouse, that may get deprecated over time because of versioning.

So by building my own system, I bring new errors and risky choices, but at least I get to work with a light system for screenshotting pages with a good quality/resolution.

## Production
The production enviroment is currently hosted at [screenshot.jofaval.com](https://screenshot.jofaval.com).

### Deploy
There's a `ci` folder in case you want to implement your own solution (my case).

If you have the means to actually implement a proper ci solution or use an existent one, you can ignore or use this folder at will. As it won't hold any logic.

## API
There's only one endpoint, at the start of the project

The root of the page: `/`, it may work without the separator, but it's a good practice to leave it untouched.

### The advanced documentaiton
All the details in a better manner are explain on the [API documentation](./docs/en/Api.md)

### Some examples

#### Get the page
It just gets the page with all the default parameters set in, follow the example below:

`{API_BASE_URL}/?url={$site}`

#### Get a screenshot on a specific device
Instead of specifying an array of possible devices, regsitering them, choose your own resolution and browser header.

Specified in `px`, maybe in a future implementation it can have a units system.

`{API_BASE_URL}/?url={$site}&width={$width}=height{$height}`

#### Get a screenshot on a browser
Different browsers bring different results. So at least for now it may just work with Chromium and/or Firefox.

*Header* is not **required** for a browser specification, it's completely **optional**.

`{API_BASE_URL}/?url={$site}&browser={'chrome' | 'chrome' | 'firefox'}&[header]={$header}`

#### Return format
Ok, now that we have an image screenshotting process complete, how do we store it, or recieve it?.

You can specify wether you want the raw base64 image or the visual image and you're the one de/en/coding it!

`{API_BASE_URL}/?url={$site}&format={'base64' | 'visual'}`

## Legal Notice
This is a sort of warning, and a heads up at some possible problems along the way.

### Security
I am, in no way, responsible for the securiy of the system, or the damage it may cause, wether directly or indirectly. Nor am I responsible for any sort of exploiting it may cause on other infraestructures.

### Illegal practices
You can get some very basic information, that information may be private, or not to be fetched through public means. Licenses still hold their own, if you screenshot, for example, Google Images, those images have licenses, you're not buying that license, and you will be responsible for a bad use, not me.

### Advice
This is a PoC, use at your own risky, highly recomended to use for your own resources from which you hold all the rights.