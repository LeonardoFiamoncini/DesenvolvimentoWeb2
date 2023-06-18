const router = require("express").Router();
const authController = require("../controllers/auth");


router.post("/login", authController.login);
router.get("/deslogar", authController.deslogar);


module.exports = router;