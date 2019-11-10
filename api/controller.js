var express = require('express');
var router = express.Router();
const mysql = require('mysql');
var bodyParser = require('body-parser');router.use(bodyParser.urlencoded({ extended: true }));
router.use(bodyParser.json());
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
router.get('/',(req, res) => {
    let sql = "SELECT * FROM produits";
    let query = conn.query(sql, (err, results) => {
      if(err) throw err;
      res.send(JSON.stringify({"status": 200, "error": null, "response": results}));
    });
  });
   
  //show single product
  router.get('/:id',(req, res) => {
    let sql = "SELECT * FROM produits WHERE ID="+req.params.id;
    let query = conn.query(sql, (err, results) => {
      if(err) throw err;
      res.send(JSON.stringify({"status": 200, "error": null, "response": results}));
    });
  });
   
  //add new product
  router.post('/',(req, res) => {
    let data = {NOM: req.body.nom, DESCRIPTION: req.body.description, CATEGORIE: req.body.categorie, PRIX: req.body.prix, STOCK: req.body.stock};
    let sql = "INSERT INTO `produits`SET ?";
    let query = conn.query(sql, data,(err, results) => {
      if(err) throw err;
      res.send(JSON.stringify({"status": 200, "error": null, "response": results}));
    });
  });
   
  //update product
  router.put('/:id',(req, res) => {
    let sql = "UPDATE produits SET NOM='"+req.body.nom+"', DESCRIPTION='"+req.body.description+"', CATEGORIE='"+req.body.categorie+"', PRIX="+req.body.prix+", STOCK="+req.body.stock+" WHERE ID="+req.params.id;
    console.log(sql);
    let query = conn.query(sql, (err, results) => {
      if(err) throw err;
      res.send(JSON.stringify({"status": 200, "error": null, "response": results}));
    });
  });
   
  //Delete product
  router.delete('/:id',(req, res) => {
    let sql = "DELETE FROM produits WHERE ID="+req.params.id+"";
    let query = conn.query(sql, (err, results) => {
      if(err) throw err;
        res.send(JSON.stringify({"status": 200, "error": null, "response": results}));
    });
  });
module.exports = router;