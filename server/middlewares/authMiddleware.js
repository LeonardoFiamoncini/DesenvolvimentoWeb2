const jwt = require('jsonwebtoken');

module.exports = (permissions) => {
    return (req, res, next) => {
        const authToken = req.headers.authorization || '';
        console.log(authToken);
        if (!authToken){
            
            return res.status(401).send('Ir login');
        }

        const [, token] = authToken.split(' ');

        try {
            const payload = jwt.verify(token, process.env.REFRESH_TOKEN_SECRET);

        
            res.locals.user = payload.sub;
            next();
        } catch (error) {
            return res.status(401).json({ error: 'Token inválido' });
        }
    }
}