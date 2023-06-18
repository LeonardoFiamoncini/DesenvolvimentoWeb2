const router = require("express").Router();
const generoController = require("../controllers/genero");


router.get("/preencher_generos", generoController.preencher_generos);

module.exports = router;
