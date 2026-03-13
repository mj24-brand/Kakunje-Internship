import express from 'express';
const app = express();
app.get("/", (req, res) => {
    res.send("Welcome");
    res.end();
});
app.use((req, res) => {
    res.status(404).send("404 Page Not Found");
    res.end();
});
app.listen(3000, () => {
    console.log("server is running")
});

