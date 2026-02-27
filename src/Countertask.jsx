import React, { useState } from 'react'

const Countertask = () => {
    const [count,setCount]=useState(0);

    const countstyle={
        backgroundColor: count > 5 ? "green" : "white",
        textAlign: "center",
        padding:"20px",
        minHeight:"250px"
    };
  return (
    <div style={countstyle}>
        <h2>Count : {count}</h2>
      <button onClick={()=>setCount(count+1)}>Increase</button>
      <button onClick={()=>setCount(count-1)}>Decrease</button>
    </div>
  )
};

export default Countertask;
