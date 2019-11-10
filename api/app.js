const express = require('express');
const bodyParser = require('body-parser');
const app = express();
const mysql = require('mysql');
 
// parse application/json
app.use(bodyParser.json());
 
//create database connection
const conn = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'projet_web'
});
 
//connect to database
conn.connect((err) =>{
  if(err) throw err;
  console.log('Mysql Connected...');
});
 
//show all produits
app.get('/api/produits',(req, res) => {
  let sql = "SELECT * FROM produits";
  let query = conn.query(sql, (err, results) => {
    if(err) throw err;
    res.send(JSON.stringify({"status": 200, "error": null, "response": results}));
  });
});
 
//show single product
app.get('/api/produits/:id',(req, res) => {
  let sql = "SELECT * FROM produits WHERE ID="+req.params.id;
  let query = conn.query(sql, (err, results) => {
    if(err) throw err;
    res.send(JSON.stringify({"status": 200, "error": null, "response": results}));
  });
});
 
//add new product
app.post('/api/produits',(req, res) => {
  let data = {NOM: req.body.nom, DESCRIPTION: req.body.description, CATEGORIE: req.body.categorie, PRIX: req.body.prix, STOCK: req.body.stock};
  let sql = "INSERT INTO `produits`SET ?";
  let query = conn.query(sql, data,(err, results) => {
    if(err) throw err;
    res.send(JSON.stringify({"status": 200, "error": null, "response": results}));
  });
});
 
//update product
app.put('/api/produits/:id',(req, res) => {
  let sql = "UPDATE produits SET NOM='"+req.body.nom+"', DESCRIPTION='"+req.body.description+"', CATEGORIE='"+req.body.categorie+"', PRIX="+req.body.prix+", STOCK="+req.body.stock+" WHERE ID="+req.params.id;
  console.log(sql);
  let query = conn.query(sql, (err, results) => {
    if(err) throw err;
    res.send(JSON.stringify({"status": 200, "error": null, "response": results}));
  });
});
 
//Delete product
app.delete('/api/produits/:id',(req, res) => {
  let sql = "DELETE FROM produits WHERE ID="+req.params.id+"";
  let query = conn.query(sql, (err, results) => {
    if(err) throw err;
      res.send(JSON.stringify({"status": 200, "error": null, "response": results}));
  });
});
 
//Server listening
app.listen(3000,() =>{
  console.log('Server started on port 3000...');
});