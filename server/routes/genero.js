const router = require("express").Router();
const generoController = require("../controllers/genero");


router.get("/preencher_generos", generoController.preencher_generos);
router.get("/listar", generoController.listar);
router.put("/editar/:id", generoController.editar_genero);

module.exports = router;
