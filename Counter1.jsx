import React, { useState } from "react";

function Counter1(){
    const [count,setCount]=useState(0);
    return(
        <>
        <h1>{count}</h1>
        <button onClick={()=>setCount(count+1)}>Increase</button>
        </>
    )
}
export default Counter1