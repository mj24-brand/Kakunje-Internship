import React from 'react'
import { useState } from 'react'

const Hooks1 = () => {
    const [color,setColor]=useState("red");
  return (
    
      <div style={{padding:"20px"}}>
        <h1>The color is {color}</h1>
        <button onClick={()=>setColor("blue")}>Change color to blue</button>
        <button onClick={()=>setColor("green")}>Change color to green</button>

      </div>
  )
}

export default Hooks1
