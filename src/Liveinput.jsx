import React, { useState } from 'react'

const Liveinput = () => {
    const [name,setName]=useState("");
  return (
    <div>
      <input type='text' onChange={(e)=>setName(e.target.value)}/>
      <h2 style={{color:"blueviolet"}}>Hello,{name}</h2>
    </div>
  )
}

export default Liveinput
