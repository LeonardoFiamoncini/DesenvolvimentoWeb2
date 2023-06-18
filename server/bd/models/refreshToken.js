const Sequelize = require('sequelize');
const sequelize = require('../config/db.js');

const Usuario = require('./usuario.js');

const RefreshToken = sequelize.define('refreshToken', {
    id: {
        type: Sequelize.INTEGER,
        primaryKey: true,
        autoIncrement: true,
        allowNull: false

      },
      token: {
        type: Sequelize.STRING,
        allowNull: false,
        unique: true
      },
      expiresIn: {
        type: Sequelize.BIGINT,
        allowNull: false
      }
    }, {
        tableName: 'refresh_token',
    });

RefreshToken.belongsTo(Usuario, { foreignKey: "id", as: "usuario", constraint:true });

module.exports = RefreshToken;