const express = require('express');
const app = express();
const port = 4000;

app.get('/external-data', (req, res) => {
  res.setHeader('Content-Type', 'application/json; charset=utf-8');
  res.send(JSON.stringify({ message: "Olá do microsserviço Node.js!" }));
});

app.listen(port, () => {
  console.log(`Microsserviço Node rodando em http://localhost:${port}`);
});
