import React, { useState } from 'react'

function Ternary(){
    const [isLoggedIn,setIsLoggedIn]=useState(false);
return(
    <div>
        <h2>
            {isLoggedIn? "Welcome user":"Please Login"}
        </h2>
        <button onClick={()=>setIsLoggedIn(!isLoggedIn)}>Toggle Login</button>
    </div>
)
}
export default Ternary;
