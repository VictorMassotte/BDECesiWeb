var express = require('express');
var router = express.Router();
var bodyParser = require('body-parser');
router.use(bodyParser.urlencoded({ extended: false }));
router.use(bodyParser.json());
const User = require("../models").users;
var jwt = require('jsonwebtoken');
var bcrypt = require('bcryptjs');
var config = require('../config');
var VerifyToken = require('./VerifyToken');
router.post('/login', (req, res) =>{
    
    User.findOne({ where:{ MAIL: req.body.mail} }
    ).then(user => {  
        var passwordIsValid = bcrypt.compareSync(req.body.password, user.PASSWORD);
    if (!passwordIsValid) return res.status(401).send({ auth: false, token: null });

    // if user is found and password is valid
    // create a token
    var token = jwt.sign({ id: user.id, status: user.STATUS }, config.secret, {
      expiresIn: 86400 // expires in 24 hours
    });

    // return the information including token as JSON
    res.status(200).send({ auth: true, token: token }); 
     }     )
        .catch(err => res.status(500).send('Error on the server.'));
        
      
      
    }); 
      // check if the password is valid
    
     
   
  
  router.get('/logout', function(req, res) {
    res.status(200).send({ auth: false, token: null });
  });
  
  router.post('/register', (req, res) =>{
  
    var hashedPassword = bcrypt.hashSync(req.body.password, 10);
  
    User.create({
        NOM: req.body.name,
        PRENOM: req.body.firstname,
        LOCALISATION: req.body.localisation,
        MAIL: req.body.mail,
        PASSWORD: hashedPassword,
        STATUS: req.body.status
    }).then(user =>{
        var token = jwt.sign({ id: user.id,  status: user.STATUS }, config.secret, {
            expiresIn: 86400 // expires in 24 hours
          });
      
          res.status(200).send({ auth: true, token: token });
    }).catch(err => res.status(500).send("There was a problem registering the user`."));
    
  
  });
  
  router.get('/me',VerifyToken, (req, res, next) =>{
    //console.log(req.userStatus);
    User.findByPk(req.userId, { attributes: { exclude: ['PASSWORD'] }})
    .then(user =>{
        res.json(user);
    })
    .catch(err => res.json(err)); 
      
    
  });
  
  module.exports = router;