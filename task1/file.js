//importing and creating a new file
const fs=require("fs");
fs.writeFileSync("newfile.txt","Hello this is a new file");

//reading a file
const data = fs.readFileSync("newfile.txt","utf-8");
console.log(data);

//updating the file
fs.appendFileSync("newfile.txt","\nnodejs is a javascript runtime environment");

//renaming the file
fs.renameSync("newfile.txt","newtextfile.txt");

//creation of new folder
fs.mkdirSync("NewFolder");

//delete file
fs.unlinkSync("newtextfile.txt");