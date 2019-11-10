'use strict';
module.exports = (sequelize, DataTypes) => {
  const produits = sequelize.define('produits', {
    NOM: DataTypes.STRING,
    DESCRIPTION: DataTypes.STRING,
    CATEGORIE: DataTypes.STRING,
    PRIX: DataTypes.INTEGER,
    STOCK: DataTypes.INTEGER
  }, {timestamps: false});
  produits.associate = function(models) {
    // associations can be defined here
  };
  return produits;
};