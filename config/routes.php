<?php

$routes->get('/', function () {
    HelloWorldController::index();
});

$routes->get('/kurssit', function () {
    HelloWorldController::kurssit();
});

$routes->get('/esittely', function () {
    HelloWorldController::esittely();
});

$routes->get('/muokkaus', function () {
    HelloWorldController::muokkaus();
});

$routes->get('/hiekkalaatikko', function () {
    HelloWorldController::sandbox();
});
