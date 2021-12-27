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