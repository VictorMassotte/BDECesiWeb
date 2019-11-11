'use strict';
module.exports = (sequelize, DataTypes) => {
  const users = sequelize.define('users', {
    NOM: DataTypes.STRING,
    PRENOM: DataTypes.STRING,
    LOCALISATION: DataTypes.STRING,
    MAIL: DataTypes.STRING,
    PASSWORD: DataTypes.STRING,
    STATUS: DataTypes.STRING
  }, {timestamps: false});
  users.associate = function(models) {
    // associations can be defined here
  };
  return users;
};