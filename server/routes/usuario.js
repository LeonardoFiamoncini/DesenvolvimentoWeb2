const router = require("express").Router();
const usuarioController = require("../controllers/usuario");


router.post("/cadastro", usuarioController.cadastrar);
router.get("/nome", usuarioController.getNome);

module.exports = router;