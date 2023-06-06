const Sequelize = require('sequelize');
const sequelize = require('../config/db.js');
const bcrypt = require("bcrypt");

const Usuario = sequelize.define('usuario', {
    id: {
        type: Sequelize.INTEGER,
        autoIncrement: true,
        allowNull: false,
        primaryKey: true
    },
    nome: { 
        type: Sequelize.STRING,
        allowNull: false
    },
    email: {
        type: Sequelize.STRING,
        allowNull: false
    },
    senha: {
        type: Sequelize.STRING,
        allowNull: false,
        set(senha) {
          this.setDataValue("senha", bcrypt.hashSync(senha, 10));
        }
    },
    cargo: {
        type: Sequelize.STRING,
        allowNull: false
    }
}, { tableName: 'usuario'})

Usuario.prototype.isPasswordValid = function (senha) {
    return bcrypt.compareSync(senha, this.senha);
};

Usuario.prototype.toJSON = function () {
    var values = Object.assign({}, this.get());
    delete values.senha;
    return values;
};


module.exports = Usuario;