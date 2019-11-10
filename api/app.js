const express = require('express');
const bodyParser = require('body-parser');
const app = express();

 

 
//create database connection

 
var controller = require('./controller');
app.use('/produits', controller);

module.exports = app;
 
