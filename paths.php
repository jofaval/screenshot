<?php

/**
 * The app root dir
 * 
 * @var string
 */
define('BASE_DIR', __DIR__);

/**
 * The src dir
 * 
 * @var string
 */
define('SRC_DIR', j(BASE_DIR, 'src'));

/**
 * The logs dir
 * 
 * @var string
 */
define('LOGS_DIR', j(BASE_DIR, 'logs'));

/**
 * The main log file
 * 
 * @var string
 */
define('LOG_FILE', j(LOGS_DIR, 'log.txt'));

/**
 * The screenshot python script
 * 
 * @var string
 */
define('SCREENSHOT_FILE', j(SRC_DIR, 'screenshot.py'));

/**
 * The endpoints dir
 * 
 * @var string
 */
define('ENDPOINTS_DIR', j(SRC_DIR, 'endpoints'));

/**
 * The libs dir
 * 
 * @var string
 */
define('LIBS_DIR', j(SRC_DIR, 'libs'));

/**
 * The config dir
 * 
 * @var string
 */
define('CONFIG_DIR', j(SRC_DIR, 'config'));

/**
 * The public dir
 * 
 * @var string
 */
define('PUBLIC_DIR', j(BASE_DIR, 'public'));