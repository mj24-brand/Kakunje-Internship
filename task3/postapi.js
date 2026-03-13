import express from 'express';
const app=express();
app.use(express.json());
app.post("/login",(req,res)=>{
    const {username, password}=req.body;

    if(username==="admin" && password==="1234"){
        res.send("Login successful");
    }else{
        res.send("Invalid credentials");
    }
});
app.listen(3000, ()=>{
    console.log("server is running");
});