//asynchronous - executes each task simultaneously
//console.log("hello this is node.js");

//setTimeout(()=>{
  //  console.log("process");
//},2000);

//console.log("end");


//creating file 
const fs = require("fs");
fs.writeFileSync("data.txt","heloo world!");//filename,data


//reading a file
//const data = fs.readFileSync("data.txt","utf-8");
//console.log(data);

//append data to the file
fs.appendFileSync("data.txt","\nnodejs is javascript runtime environment");

//delete file
fs.unlinkSync("data.txt");

fs.writeFileSync("data.txt","heloo world!");//filename,data


//rename file
fs.renameSync("data.txt","newfile.txt");

//check if file exists
if(fs.existsSync("newfile.txt")){
  console.log("file exist")
}else{
  console.log("file not found");
}



