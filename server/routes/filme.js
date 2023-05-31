const router = require("express").Router();
const filmeController = require("../controllers/filme");


router.get("/listar", filmeController.listar);

router.post("/cadastrar", filmeController.cadastrar);


module.exports = router;