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

$routes->post('/tallennakurssi', function(){
    KurssiController::tallennus();
});

$routes->post('/tallennakayttaja', function(){
KayttajaController::tallennus();
});

$routes->get('/uusikayttaja', function(){
    KayttajaController::luonti();
});

$routes->get('/kurssit/:id/edit', function ($id) {
    KurssiController::muokkaus($id);
});

$routes->get('/kayttajat/:id/edit', function ($id) {
    KayttajaController::muokkaus($id);
});

$routes->post('/kayttajat/:id/edit', function ($id)  {
   KayttajaController::paivitys($id);
});

$routes->post('/kurssit/:id/edit', function ($id)  {
    KurssiController::paivitys($id);
});

$routes->post('/kurssit/:id/tuhoa', function ($id) {
    KurssiController::tuhoa($id);
});

$routes->post('/kayttajat/:id/tuhoa', function ($id) {
    KayttajaController::tuhoa($id);
});

$routes->get('/kirjaudu', function () {
    KayttajaController::login();
});

$routes->post('/kirjaudu', function () {
   KayttajaController::kasittele_kirjautuminen();
});

$routes->get('/arvostelu/:id', function ($id) {
    ArvosteluController::arvostelu($id);
});

$routes->post('/arvostelu/:id', function ($id) {
    ArvosteluController::tallennus($id);
});

$routes->post('/kirjauduulos', function(){
    KayttajaController::kirjauduulos();
});

$routes->get('/kayttajat', function(){
    KayttajaController::naytaKaikki();
});