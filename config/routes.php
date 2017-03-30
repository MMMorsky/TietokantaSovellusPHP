<?php

$routes->get('/', function () {
    HelloWorldController::index();
});

$routes->get('/kurssit', function () {
    KurssiController::index();
});

$routes->get('/kurssit/:id', function ($id) {
    KurssiController::esittely($id);
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

$routes->get('/uusikurssi', function(){
    KurssiController::luonti();
});

$routes->post('/esittely', function(){
    KurssiController::tallennus();
});