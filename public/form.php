<?php

// TODO: implement form data validation, before redirecting that is

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take a Screenshot!</title>

    <!-- STYLES -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- TITLE -->
    <h1 class="h1 text-center">Take a screenshot</h1>
    <h2 class="h4 text-center">Through this form or using the <a href="./api">API</a>. Here's the <a href="https://github.com/jofaval/screenshot/wiki/Api">guide</a></h2>

    <div class="container-md">
        <!-- EXTRA INFORMATION -->
        <p class="float-md-end text-muted">
            Go check the API for yourself,
            <a href="./api">here</a>.
        </p>

        <!-- LEGAL NOTICE -->
        <p>
            Take into account the <a href="./legal.php">legal notice</a>.
        </p>

        <!-- FORM -->
        <form action="./api.php" class="form m-sm-3 p-2 p-sm-4 shadow rounded" method="get">
            <!-- SITE DETAILS -->
            <fieldset class="fieldset border p-2 p-sm-3 mb-3 rounded shadow-sm">
                <legend>Site Details</legend>
                
                <!-- URL -->
                <div class="mb-3">
                    <label for="url" class="form-label">URL (<span class="">required</span>)</label>
                    <input type="text" class="form-control" name="url" id="url" placeholder="https://example.com" value="https://" required aria-describedby="urlHelp">
                    <div id="urlHelp" class="form-text">The website from which you want to take a screenshot.</div>
                </div>
            </fieldset>

            <!-- BROWSER DETAILS -->
            <fieldset class="fieldset border p-2 p-sm-3 mb-3 rounded shadow-sm">
                <legend>Browser Details</legend>

                <!-- WIDTH & HEIGHT -->
                <div class="row mb-3">
                    <div class="col-md">
                        <label for="width" class="form-label">Width</label>
                        <input type="number" class="form-control" onkeypress="onlyNumbers(event)" name="width" id="width" placeholder="360" aria-describedby="widthHelp">
                        <div id="widthHelp" class="form-text">The width of the browser/screenshot.</div>
                    </div>
                    <div class="col-md">
                        <label for="height" class="form-label">Height</label>
                        <input type="number" class="form-control" onkeypress="onlyNumbers(event)" name="height" id="height" placeholder="640" aria-describedby="heightHelp">
                        <div id="heightHelp" class="form-text">The height of the browser/screenshot.</div>
                    </div>
                </div>
                <!-- BROWSER AGENT -->
                <div class="mb-3">
                    <label for="browser" class="form-label">Browser agent</label>

                    <select name="browser" class="form-select" id="browser" aria-describedby="browserHelp">
                        <optgroup label="Recommended">
                            <option value="firefox">Firefox</option>
                        </optgroup>

                        <option value="chrome">Chrome</option>
                        <option value="chrome">Chromium</option>
                    </select>

                    <div id="browserHelp" class="form-text">The browser agent for the screenshot.</div>
                </div>
                <!-- HEADER -->
                <div class="mb-3">
                    <label for="header" class="form-label">Header</label>
                    <input type="text" class="form-control" name="header" id="header"
                    placeholder="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36"
                    aria-describedby="headerHelp">
                    <div id="headerHelp" class="form-text">The headers for the browser agent.</div>
                </div>
            </fieldset>

            <!-- OUTPUT DETAILS -->
            <fieldset class="fieldset border p-2 p-sm-3 mb-3 rounded shadow-sm">
                <legend>Output Details</legend>

                <!-- OUTPUT FORMAT -->
                <div class="mb-3">
                    <label for="format" class="form-label">Format</label>

                    <select name="format" class="form-select" id="format" aria-describedby="formatHelp">
                        <optgroup label="Recommended">
                            <option value="base64">Base 64</option>
                        </optgroup>

                        <option value="visual">Visualize</option>
                    </select>

                    <div id="formatHelp" class="form-text">The output format of the screenshot.</div>
                </div>
            </fieldset>

            <!-- DESCRIPTION -->
            <small class="text-muted d-block mb-3">
                Only the URL is truly required.
            </small>
            <!-- SUBMITS -->
            <div class="submit-container">
                <input type="submit" name="takeScreeshot" value="Take a screenshot!" class="btn btn-outline-primary w-100">
            </div>
        </form>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- MAIN -->
    <script type="text/javascript">
        /**
         * Gets the data from the input
         * 
         * @param theEvent The event used
         * 
         * @returns {String} The key value
         */
        const getData = (theEvent) => {
            let key;

            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else { // Handle key press
                key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }

            return key;
        }

        // The numeric regex, tests for numbers
        const regex = /[0-9]|\./;

        /**
         * Validates a numeric input
         * 
         * @param {Event} evt The HTML event
         * 
         * @returns {void}
         */
        const onlyNumbers = (evt) => {
            var theEvent = evt || window.event;

            // Handle paste
            let key = getData(theEvent);

            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>
</body>

</html>