
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
const Sequelize = require('sequelize');
const sequelize = require('../config/db.js');
 
const Filme = sequelize.define('filme', {
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
    preco: {
        type: Sequelize.DOUBLE
    },
    descricao: Sequelize.STRING
})
 
module.exports = Filme;