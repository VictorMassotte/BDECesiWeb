const express = require("express");
const bodyparser = require("body-parser");
const port = process.env.PORT || 5000;

const app = express();

app.use(bodyparser.urlencoded({ extended: 1 }));
app.use(bodyparser.json());

require("./routes/produitsRoutes")(app);
var AuthController = require(__root + 'auth/AuthController');
app.use('/api/auth', AuthController);
app.listen(port, () => console.log(`Server started on ${port}`));