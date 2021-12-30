from posixpath import dirname
import pip

# The required modules
modules = [
    'selenium',
    'validators',
]

def hyper_import(module: str) -> None:
    """
    Imports a module, and install it if not previously installed

    module : str
        The module to attempt to install

    returns None
    """

    try:
        __import__(module)
    except:
        pip.main([ 'install', module ])

[ hyper_import(module) for module in modules ]

import sys, time, os, uuid
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from urllib.parse import unquote

default_configuration = {
    'width': 1920,
    'height': 1080,
}

# Get all the args
args = sys.argv[1:]
# The working dir
basedir = os.path.join(os.getcwd(), '..')
# The chrome driver
CHROME_DRIVER = os.path.join(basedir, 'src', 'driver', 'chromedriver.exe')

def get_url() -> str:
    """
    Gets the url from the args

    returns str
    """
    if 0 < len(args): return args[0]

    return 'https://spotify.com'

def get_configuration() -> dict:
    """
    Get and parse the configuration from the args

    returns dict
    """

    configuration = {}

    # If found, parse it properly
    if 1 < len(args):
        raw_value = args[1]
        raw_value = unquote(raw_value)

        configuration = eval(raw_value)

    # If width is not given but height is, fill the missing value
    if (not 'width' in configuration) & ('height' in configuration):
        configuration['width'] = configuration['height']

    # If height is not given but width is, fill the missing value
    if (not 'height' in configuration) & ('width' in configuration):
        configuration['height'] = configuration['width']

    return configuration

def unique_id() -> str:
    """
    Generates a unique ID

    returns str
    """
    return uuid.uuid4()

def screenshot(url: str, configuration: dict = {}) -> str:
    """
    Screenshots a url website

    url : str
        The url from which to get a Screenshot
    configuration : dict
        The configuration object

    returns str
    """

    # Merge the two dicitionaries
    configuration = { **default_configuration, **configuration }

    # Generate the target path
    uniqueid = unique_id()
    taret_dir = os.path.join(basedir, 'screenshots')
    if not os.path.exists(taret_dir): os.mkdir(taret_dir)

    target_path = os.path.join(taret_dir, f'{uniqueid}.png')

    chrome_options = Options()
    chrome_options.add_argument("--headless")
    browser = webdriver.Chrome(CHROME_DRIVER, options=chrome_options)
    browser.get(url)

    # Set the size, if the dimensions are given
    if ('width' in configuration) & ('height' in  configuration):
        browser.set_window_size(configuration['width'], configuration['height'])

    # Wether it could be saved or not
    screenshot = browser.save_screenshot(target_path)
    browser.quit()

    return target_path

url = get_url()
configuration = get_configuration()

# Execute the code
try:
    image = screenshot(url, configuration)

    print(f'screenshot={image}')
except:
    type, value, traceback = sys.exc_info()
    print('Error opening %s: %s' % (value.filename, value.strerror))

# TODO: implement mobile and desktop resolutions here, all screenshot related details goes here