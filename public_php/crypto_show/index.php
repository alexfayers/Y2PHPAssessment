<?php
/**
 * index.php
 *
 * Partially written web application for ctec2907 - Web Application Development
 * Formative Assignment - Cryptographic machine show.
 *
 * The application registers a new user, logs in and logs out.  
 * Other use cases need to be implemented in preparation for the phase test,
 * as per the coursework specification.
 *
 * NB $make_trace enables/disables the creation of xdebug trace files
 *
 * @author CF Ingrams - cfi@dmu.ac.uk
 * @copyright De Montfort University
 *
 * @package crypto-show
 */

$make_trace = false;

ini_set('display_errors', 'On');
ini_set('html_errors', 'On');
ini_set('xdebug.trace_output_name', 'crypto_show.%t');

if ($make_trace == true && function_exists(xdebug_start_trace()))
{
	xdebug_start_trace();
}

include 'crypto_show/bootstrap.php';

if ($make_trace == true && function_exists(xdebug_stop_trace()))
{
	xdebug_stop_trace();
}

