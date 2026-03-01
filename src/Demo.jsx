import React, { useState } from 'react'

const Demo = () => {
    const [count,setCount]=useState(0);
  return (
    <div>
      <h1 style={{color:"green",backgroundColor:"lightblue"}}>Count: {count}</h1>
      <button onClick={()=>setCount(count+1)}>Increase</button>
      <button onClick={()=>setCount(count-1)}>Decrease</button>
    </div>
  )
}

export default Demo
