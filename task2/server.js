import http from "http";
import dotenv from "dotenv";

dotenv.config();

const PORT=process.env.PORT;
const APP_NAME=process.env.APP_NAME;
const server=http.createServer((req,res)=>{
    res.write("server creation");
    res.end();
})
server.listen(PORT,()=>{
    console.log("App Name: ",APP_NAME);
    console.log("Server running on Port :",PORT);
})