const Produit = require("../models").produits;
var VerifyToken = require("../auth/VerifyToken");

module.exports = function(router) {
  router.get("/produits",VerifyToken, (req, res) => {
    Produit.findAll()
      .then(Produits => {
        res.json(Produits);
      })
      .catch(err => res.json(err));
  });

  router.get("/produits/:id",VerifyToken, (req, res) => {
    Produit.findAll({
      where: { ID: req.params.id }
    })
      .then(Produit => {
        res.json(Produit[0]);
      })
      .catch(err => res.json(err));
  });

  router.post("/produits",VerifyToken, (req, res) => {
    if (req.userStatus == "membreBDE"){
    Produit.create({
    NOM: req.body.name, DESCRIPTION: req.body.description, CATEGORIE: req.body.categorie, PRIX: req.body.price, STOCK: req.body.stock
    })
      .then(res => {
        res.json(res);
      })
      .catch(err => res.json(err));
  }
  else{
    res.status(500).send({ permission: false, message: "You don't have the permissions." });
  }
  });

  router.put("/produits/:id",VerifyToken, (req, res) => {   
    if (req.userStatus == "membreBDE"){
    Produit.update({ NOM: req.body.name, DESCRIPTION: req.body.description,
         CATEGORIE: req.body.categorie, PRIX: req.body.price, STOCK: req.body.stock }, { where: { ID: req.params.id } })
      .then(updateProduit => {
        res.json(updateProduit);
      })
      .catch(err => res.json(err));
    }
    else{
      res.status(500).send({ permission: false, message: "You don't have the permissions." });
    }
  });

  router.delete("/produits/:id",VerifyToken,(req, res) => {
    if (req.userStatus == "membreBDE"){
    Produit.destroy({
      where: { ID: req.params.id }
    })
      .then(Produit => {
        res.json(Produit);
      })
      .catch(err => res.json(err));
    }
    else{
      res.status(500).send({ permission: false, message: "You don't have the permissions." });
    }
  });
};