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

$routes->get('/kurssit/:id/edit', function ($id) {
    KurssiController::muokkaus($id);
});

$routes->post('/kurssit/:id/edit', function ($id)  {
    KurssiController::paivitys($id);
});

$routes->post('/kurssit/:id/tuhoa', function ($id) {
    KurssiController::tuhoa($id);
});

$routes->get('/kirjaudu', function () {
    KayttajaController::login();
});

$routes->post('/kirjaudu', function () {
   KayttajaController::kasittele_kirjautuminen();
});