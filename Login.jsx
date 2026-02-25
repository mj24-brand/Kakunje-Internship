import React from "react";

function Login(){
    const isLoggedIn = true;

    if(isLoggedIn){
        return <h2>Welcome </h2>
    }else{
        return <h2>Please login</h2>
    }
}
export default Login;