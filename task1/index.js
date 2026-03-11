//Node.js server using http module
const http=require("http");

const server=http.createServer((req,res)=>{
    res.write("Hello this is Node.js page");
    res.end();
})
server.listen(3000,()=>{
    console.log("Server is running at http://localhost:3000");
})